@foreach($packages as $package)

<div class="col-lg-4 col-md-6 col-sm-6 d-flex aos-init aos-animate" 
     data-aos="zoom-in" data-aos-duration="800">

<div class="sposorships-bb bbo-1">

<div class="sposorships-head">
    <div class="sposorships-head-sub">
        <h3>{{ $package->name }}</h3>
    </div>
</div>

<div class="sposorships-title">
    <h4>
        Rs {{ number_format($package->price, 2) }} (Incl. GST)
    </h4>
</div>

<h5>
    {{ $package->category->name }}
</h5>

<div class="sposorships-body">

    @php
        $validityDays = 0;
        $unit = strtolower(trim($package->duration_unit));
        if (in_array($unit, ['day', 'days'])) {
            $validityDays = $package->duration_value;
        } elseif (in_array($unit, ['month', 'months'])) {
            $validityDays = $package->duration_value * 30;
        } elseif (in_array($unit, ['year', 'years'])) {
            $validityDays = $package->duration_value * 365;
        }
    @endphp
    <h6>
        Subscription Valid for {{ $validityDays }} Days ({{ $package->duration_value }} {{ ucfirst($package->duration_unit) }})
    </h6>

    <span class="dd-err">Designations</span>

    <ul>
        @foreach($package->category->designations as $designation)
            <li>{{ $designation->name }}</li>
        @endforeach
    </ul>

    <a href="" class="th-btn">
        Subscribe Now
        <svg aria-hidden="true" class="e-font-icon-svg e-fas-chevron-circle-right"
             viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
            <path d="M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm113.9 231L234.4 103.5c-9.4-9.4-24.6-9.4-33.9 0l-17 17c-9.4 9.4-9.4 24.6 0 33.9L285.1 256 183.5 357.6c-9.4 9.4-24.6 0-33.9l17 17c9.4 9.4 24.6 9.4 33.9 0L369.9 273c9.4-9.4 9.4-24.6 0-34z"></path>
        </svg>
    </a>

</div>
</div>
</div>

@endforeach