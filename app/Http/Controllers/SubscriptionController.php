<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function subscribe()
    {
        if (!auth()->guard('employee')->check() && !auth()->guard('employer')->check()) {
            session(['intended_url' => route('packages')]);
            return redirect()->route('login');
        }
        return redirect()->route('packages');
    }

    public function packages()
    {
        $user = auth()->user() ?? auth()->guard('employee')->user() ?? auth()->guard('employer')->user();
        
        if (!$user) {
            session(['intended_url' => route('packages')]);
            return redirect()->route('login');
        }

        $categoryId = null;
        if (auth()->guard('employee')->check()) {
            $categoryId = $user->employee->category_id ?? null;
        } elseif (auth()->guard('employer')->check()) {
            // For employers, maybe they don't have categories, or we show all packages
            // Or see if there's a specific logic. For now, show all packages if no category.
            $categoryId = null; 
        }

        $query = Package::where('is_active', true);
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        $packages = $query->with('category.designations')->get();

        return view('packages.index', compact('packages'));
    }

    public function checkout(Package $package)
    {
        $user = auth()->user() ?? auth()->guard('employee')->user() ?? auth()->guard('employer')->user();
        
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Please login to continue'], 401);
        }

        // Verify category linkage (Designation locking)
        $categoryId = null;
        if (auth()->guard('employee')->check()) {
            $categoryId = $user->employee->category_id ?? null;
        }

        if ($categoryId && $package->category_id != $categoryId) {
            return response()->json(['success' => false, 'message' => 'This package is not applicable for your designation.'], 403);
        }

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        try {
            $razorpayOrder = $api->order->create([
                'receipt'         => 'order_' . time(),
                'amount'          => $package->price * 100, // amount in paisa
                'currency'        => 'INR',
                'payment_capture' => 1
            ]);

            Order::create([
                'profile_id' => $user->id,
                'package_id' => $package->id,
                'amount' => $package->price,
                'razorpay_order_id' => $razorpayOrder['id'],
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'amount' => $package->price * 100,
                'key' => config('services.razorpay.key'),
                'name' => config('app.name'),
                'description' => $package->name . ' Subscription',
                'user' => [
                    'name' => $user->first_name . ' ' . $user->last_name,
                    'email' => $user->email,
                    'contact' => $user->phone
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Razorpay Error: ' . $e->getMessage()], 400);
        }
    }

    public function paymentCallback(Request $request)
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $order = Order::where('razorpay_order_id', $request->razorpay_order_id)->first();
            
            if ($order) {
                DB::transaction(function() use ($order, $request) {
                    $order->update([
                        'razorpay_payment_id' => $request->razorpay_payment_id,
                        'status' => 'success'
                    ]);

                    $package = $order->package;
                    $profile = $order->profile;

                    $startsAt = Carbon::now();
                    $endsAt = (clone $startsAt);
                    
                    $unit = strtolower(trim($package->duration_unit));
                    if (str_contains($unit, 'month')) {
                        $endsAt->addMonths($package->duration_value);
                    } elseif (str_contains($unit, 'year')) {
                        $endsAt->addYears($package->duration_value);
                    } else {
                        $endsAt->addDays($package->duration_value);
                    }

                    Subscription::create([
                        'profile_id' => $profile->id,
                        'package_id' => $package->id,
                        'order_id'   => $order->id,
                        'price' => $package->price,
                        'starts_at' => $startsAt,
                        'ends_at' => $endsAt,
                        'status' => 'active',
                    ]);
                });

                return response()->json(['success' => true, 'message' => 'Payment successful! Plan activated.']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Payment verification failed: ' . $e->getMessage()], 400);
        }

        return response()->json(['success' => false, 'message' => 'Order not found'], 404);
    }
}
