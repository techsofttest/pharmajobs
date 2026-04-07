@extends('layouts.app')

@section('head_metas')

@endsection


@section('content')


 <div class="Service-innersec3 background-image" id="about-sec" style="background-image: url({{asset('img/abb.jpg')}});">
    <div class="container">


      <div class="row ">

        <div class="col-lg-12 col-md-12 "> 

        <h2 class="sec-title style2 ">{{$content->name}}</h2>

        {!! $content->content !!}


        </div>

      </div>



    </div>


  </div>


@endsection