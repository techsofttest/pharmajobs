@extends('layouts.app')

@section('head_metas')


@endsection


@section('head_extras')

<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />

<style>

    .select2-container--default .select2-search--inline .select2-search__field
    {
    min-height: unset;
    height: 0;
    }

</style>

@endsection


@section('content')


        <!-- Dashboard -->

    <div class="container py-4">
    <div class="row">
                

    @include('employer.sidebar')

    <div class="page-content" id="page-dashboard">




    @yield('dashboard-content')
    


    </div><!-- /page-dashboard -->



    </div>
    </div>




@endsection



@section('footer_extras')



@endsection