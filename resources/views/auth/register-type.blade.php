@extends('layouts.app')

@section('head_metas')

@endsection



@section('head_extras')

<style>


    :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --secondary-color: #06b6d4;
            --secondary-hover: #0891b2;
    }


    .selection-container {
            max-width: 900px;
            width: 100%;
            padding: 20px;
        }

        .card-selection {
            background: white;
            border-radius: 20px;
            padding: 3rem 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .header-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .header-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .header-section p {
            color: #6b7280;
            font-size: 1.1rem;
        }

        .account-type-card {
            border: 3px solid #e5e7eb;
            border-radius: 16px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
            background: white;
        }

        .account-type-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .account-type-card:hover {
            border-color: var(--theme-color2);
            box-shadow: 0 12px 40px rgba(79, 70, 229, 0.2);
        }

        .account-type-card:hover::before {
        }

        .account-type-card.selected {
            border-color: var(--theme-color2);
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            box-shadow: 0 8px 30px rgba(79, 70, 229, 0.25);
        }

        .account-type-card.selected::before {
            transform: scaleX(1);
        }

        .icon-wrapper {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 5px;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .employee-card .icon-wrapper {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: var(--theme-color);
        }

        .employer-card .icon-wrapper {
            background: linear-gradient(135deg, #cffafe 0%, #a5f3fc 100%);
            color: var(--theme-color);
        }

        .account-type-card:hover .icon-wrapper {
            transform: scale(1.1) rotate(5deg);
        }

        .account-type-card h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
            text-align: center;
        }

        .account-type-card p {
            color: #6b7280;
            font-size: 1rem;
            text-align: center;
            margin-bottom: 5px;
            line-height: 1.6;
        }

        .features-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .features-list li {
            padding: 0.5rem 0;
            color: #4b5563;
            display: flex;
            align-items: center;
        }

        .features-list li i {
            color: var(--theme-color);
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }

        .select-button {
            text-align: center;
            display: block;
            width: 100%;
            padding: 0.875rem 2rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1.5rem;
        }

        .employee-card .select-button {
            background: var(--theme-color);
            color: white;
        }

        .employee-card .select-button:hover {
            background: var(--theme-color2);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }

        .employer-card .select-button {
            background: var(--theme-color);
            color: white;
        }

        .employer-card .select-button:hover {
            background: var(--theme-color2);
            box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4);
        }

        .selected-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--theme-color2);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            display: none;
        }

        .account-type-card.selected .selected-badge {
            display: block;
            animation: slideInRight 0.3s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-selection {
                padding: 2rem 1.5rem;
            }

            .header-section h1 {
                font-size: 2rem;
            }

            .header-section p {
                font-size: 1rem;
            }

            .account-type-card {
                padding: 2rem 1.5rem;
                margin-bottom: 1.5rem;
            }

            .icon-wrapper {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }

            .account-type-card h3 {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .header-section h1 {
                font-size: 1.75rem;
            }

            .account-type-card {
                padding: 1.5rem 1rem;
            }

            .features-list li {
                font-size: 0.9rem;
            }
        }

    </style>





@endsection




@section('content')



<div class="container">

        <div class="card-selection1">

            <div class="header-section my-4">
                <h1>Join Pharma Healthcare Jobs</h1>
                <p>Choose how you want to get started</p>
            </div>

            <div class="row g-4 mx-lg-5 mb-lg-5">

                <!-- Employee Card -->

                <div class="col-md-6">

                    <div class="account-type-card employee-card" data-type="employee">
                        <span class="selected-badge">
                            <i class="bi bi-check-circle-fill me-1"></i>Selected
                        </span>
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <h3>I'm an Employee / Candidate</h3>
                        <p>Looking for exciting career opportunities</p>
                        
                        <ul class="features-list">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Browse thousands of jobs</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Apply with one click</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Build your career profile</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Get job recommendations</span>
                            </li>
                        </ul>

                        <a class="select-button" href="{{route('employee.register')}}">
                            Continue as Employee
                        </a>

                    </div>
                </div>

                <!-- Employer Card -->
                <div class="col-md-6">
                    <div class="account-type-card employer-card" data-type="employer">
                        <span class="selected-badge">
                            <i class="bi bi-check-circle-fill me-1"></i>Selected
                        </span>
                        <div class="icon-wrapper">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <h3>I'm an Employer</h3>
                        <p>Ready to find the perfect candidates</p>
                        
                        <ul class="features-list">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Post unlimited jobs</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Access talent pool</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Manage applications</span>
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Company branding tools</span>
                            </li>
                        </ul>

                        <a class="select-button" href="{{route('employer.register')}}">
                            Continue as Employer
                        </a>
                    </div>
                </div>






            </div>
        </div>
    </div>








@endsection