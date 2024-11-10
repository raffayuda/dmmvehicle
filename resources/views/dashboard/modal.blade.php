@extends('layouts.main')

@section('style')

@endsection
@section('head')

@endsection
@section('content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- Large modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cobainModal">Large
        modal</button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cobainlagiModal">Small
        modal</button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cobainajaModal">Small
        modal</button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Small
        modal</button>

    @include('dashboard.cobain')
    @include('dashboard.cobainlagi')
    @include('dashboard.cobainaja')

    <!-- Small modal -->
    

    

    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
    {{-- @include('dashboard.viewalert'); --}}
    {{-- @include('dashboard.yellow'); --}}


    @endsection

    @section('script')
    <script>
        $('#myModal').modal('show')

    </script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="{{asset('public/assets/node_modules/raphael/raphael-min.js')}}"></script>
    {{-- <script src="{{asset('public/assets/node_modules/morrisjs/morris.min.js')}}"></script> --}}
    <script src="{{asset('public/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- Popup message jquery -->
    <script src="{{asset('public/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
    <!-- Chart JS -->
    {{-- <script src="{{asset('public/assets/dist/js/dashboard1.js')}}"></script> --}}
    <script src="{{asset('public/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>



    @endsection
