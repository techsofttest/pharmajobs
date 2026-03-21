@foreach($jobs as $job)

<div class="col-lg-6 col-md-6 col-sm-12 d-flex">
    <div class="job-sec">

        <div class="d-flex cc-jjjo"> 
            <div class="cc-jjjo-img"> 
                <img src="{{ $job->company->logo 
                        ? asset('storage/'.$job->company->logo) 
                        : asset('assets/img/job/default.jpg') }}" 
                     alt="{{ $job->company->name }}" 
                     width="100%">
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

            <li>
                <i class="fa fa-building"></i> 
                <b>Company:</b>  
                <a href="#">
                    {{ $job->company->name }}
                </a>
            </li>

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