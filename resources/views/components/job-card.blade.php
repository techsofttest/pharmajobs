@foreach($jobs as $job)

<div class="col-lg-6 col-md-6 col-sm-12 d-flex">
    <div class="job-sec">

        <div class="d-flex cc-jjjo"> 
            @php
              $companyName = $job->company->name ?? 'Company';
              $firstLetter = strtoupper(substr($companyName, 0, 1));
              $colors = ['#4285F4', '#EA4335', '#FBBC05', '#34A853', '#8E24AA', '#F06292', '#0097A7', '#5C6BC0'];
              $colorIndex = ord($firstLetter) % count($colors);
              $avatarColor = $colors[$colorIndex];
            @endphp

            <div class="cc-jjjo-img" style="{{ !$job->company->logo ? 'background-color: '.$avatarColor.'; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 800; border: none;' : '' }}"> 
                @if($job->company->logo)
                    <img src="{{ asset('storage/'.$job->company->logo) }}" alt="{{ $companyName }}" width="100%">
                @else
                    <span style="font-size: 20px;">{{ $firstLetter }}</span>
                @endif
            </div>

            <div class="cc-jjjo-content"> 
                <h3>
                    <a href="{{route('job.detail',$job->id)}}">
                        {{ $job->designation->name }}
                    </a>
                </h3>
            </div>
        </div>

        <ul>

            <li>
                <i class="fa fa-briefcase"></i>
                <b>Position:</b> {{ $job->designation->name }}
            </li>

            <li>
                <i class="fa fa-location-dot"></i>
                <b>Locations:</b> 
                
                @if($job->locations->count() > 0)
                    {{ $job->locations->pluck('name')->implode(', ') }}
                @endif

            </li>


            {{--
            <li>
                <i class="fa fa-building"></i> 
                <b>Company:</b>  
                <a href="javascript:void(0)">
                    {{ $job->company->name }}
                </a>
            </li>
            --}}


            <li>
                <i class="fa fa-clock"></i>
                <b>Posted on:</b> 
                {{ $job->created_at->format('F d, Y') }}
            </li>

        </ul>

        <a class="carrer-btn" href="{{route('job.detail',$job->id)}}">
            View Details 
            <i class="fa fa-angle-right"></i>
        </a>

    </div>
</div>  

@endforeach