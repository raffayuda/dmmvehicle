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

    <!--
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Dashboard 1</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard 1</li>
                            </ol>
                            <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
                        </div>
                    </div>
                </div>
                -->
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Info box -->
    <!-- ============================================================== -->
    <div class="card-group">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="fa fa-car"></i></h3>
                                <p class="text-muted">VEHICLE</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-info">{{$vehicle}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%; height: 6px;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="fa fa-forward"></i></h3>
                                <p class="text-muted">IN OPERATION</p>
                            </div>
                            <div class="ml-auto">
                            <h2 class="counter text-cyan">{{$inoperation}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-cyan" role="progressbar" style="width: {{$inoperation/$vehicle*100}}%; height: 6px;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="fa fa-wrench"></i></h3>
                                <p class="text-muted">MAINTENANCE</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-warning">{{$inporgress}} </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    
                    <div class="col-md-4">
                        <div class="col-12">
                            
                            <span data-toggle="modal" data-target="#yellowModalmain">
                                <button type="button" class="btn waves-effect waves-light btn-warning btn-block" data-placement="top" data-toggle="tooltip" title="> 1 Hari" data-html="true">{{$yellowmain}}</button>
                            </span>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-4">
                        <div class="col-12">
                            <span data-toggle="modal" data-target="#orangeModalmain">
                                <button type="button" class="btn waves-effect waves-light btn-primary btn-block" data-placement="top" data-toggle="tooltip" title="> 1 Minggu" data-html="true">{{$orangemain}}</button>
                            </span>
                            
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-4">
                        <div class="col-12">
                            <span data-toggle="modal" data-target="#redModalmain">
                                <button type="button" class="btn waves-effect waves-light btn-danger btn-block" data-placement="top" data-toggle="tooltip" title="> 2 Minggu" data-html="true">{{$redmain}}</button>
                            </span>
                            
                        </div>
                    </div>
                    <!--/span-->
                </div>
                    {{-- <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{$inporgress/$vehicle*100}}%; height: 6px;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="fa fa-gavel"></i></h3>
                                <p class="text-muted">BREAKDOWN</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-danger">{{$breakdown}} </h2>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    
                    <div class="col-md-4">
                        <div class="col-12">
                            
                            <span data-toggle="modal" data-target="#yellowModal">
                                <button type="button" class="btn waves-effect waves-light btn-warning btn-block" data-placement="top" data-toggle="tooltip" title="> 1 Hari" data-html="true">{{$yellow}}</button>
                            </span>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-4">
                        <div class="col-12">
                            <span data-toggle="modal" data-target="#orangeModal">
                                <button type="button" class="btn waves-effect waves-light btn-primary btn-block" data-placement="top" data-toggle="tooltip" title="> 1 Minggu" data-html="true">{{$orange}}</button>
                            </span>
                            
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-4">
                        <div class="col-12">
                            <span data-toggle="modal" data-target="#redModal">
                                <button type="button" class="btn waves-effect waves-light btn-danger btn-block" data-placement="top" data-toggle="tooltip" title="> 2 Minggu" data-html="true">{{$red}}</button>
                            </span>
                            
                        </div>
                    </div>
                    <!--/span-->
                </div>
                

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="fa fa-cogs"></i></h3>
                                <p class="text-muted">STOCK ALERT</p>
                            </div>
                            <div class="ml-auto col-md-6">
                            {{-- <label class="red active">Last Name</label> --}}
                            
                            <span data-toggle="modal" data-target="#alertModal">
                                <button type="button" class="btn waves-effect waves-light btn-danger btn-block"><h2>{{$alert}}</h2> </button>
                            </button>
                                {{-- <button type="button" class="btn waves-effect waves-light btn-danger btn-block" data-placement="top" data-toggle="tooltip" title="2 Minggu" data-html="true">{{$alert}}</button> --}}
                            </span>
                                </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%; height: 6px;"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</div>




<div class="row">
    <!-- ============================================================== -->
    <!-- Comment widgets -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Table -->
    <!-- ============================================================== -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div>
                        <h5 class="card-title">Maintenance Progress </h5>
                        <h6 class="card-subtitle">Check maintenance progress </h6>
                    </div>
                   
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover no-wrap">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>VEHICLE</th>
                            <th>TASK</th>
                            <th>STATUS</th>
                            <th>FINISHED TARGET</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maintenances as $maintenance)
                            <tr>
                                <td> {{$noo++}} </td>
                                <td> {{$maintenance->nomor_lambung}} </td>
                                <td> {{$maintenance->packages_name}} </td>
                                <td> {{$maintenance->status}} </td>
                                <td> {{$maintenance->schedule_date}} </td>

                            </tr>    

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- End Comment - chats -->
<!-- ============================================================== -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Right sidebar -->
<!-- ============================================================== -->
<!-- .right-sidebar -->

<!-- ============================================================== -->
<!-- End Right sidebar -->
<!-- ============================================================== -->
@include('dashboard.viewalert')
@include('dashboard.yellow')
@include('dashboard.orange')
@include('dashboard.red')

@include('dashboard.yellowmain')
@include('dashboard.orangemain')
@include('dashboard.redmain')


@endsection

@section('script')

<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelalert').DataTable({
            "processing": true,
            "serverside": true,
            "paging":   false,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listalert')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        // Menampilkan data dengan Datatables
        table = $('#tabelyellow').DataTable({
            "processing": true,
            "serverside": true,
            "paging":   false,
            "searching": false,
            "ajax": {
                "url": "{{route('listyellow')}}",
                "type": "GET",
            }
        });
        table = $('#tabelyellowmain').DataTable({
            "processing": true,
            "serverside": true,
            "paging":   false,
            "searching": false,
            "ajax": {
                "url": "{{route('listyellowmain')}}",
                "type": "GET",
            }
        });

        // Menampilkan data dengan Datatables
        table = $('#tabelorange').DataTable({
            "processing": true,
            "serverside": true,
            "paging":   false,
            "searching": false,
            "ajax": {
                "url": "{{route('listorange')}}",
                "type": "GET",
            }
        });

        table = $('#tabelorangemain').DataTable({
            "processing": true,
            "serverside": true,
            "paging":   false,
            "searching": false,
            "ajax": {
                "url": "{{route('listorangemain')}}",
                "type": "GET",
            }
        });

        table = $('#tabelred').DataTable({
            "processing": true,
            "serverside": true,
            "paging":   false,
            "searching": false,
            "ajax": {
                "url": "{{route('listred')}}",
                "type": "GET",
            }
        });


        table = $('#tabelredmain').DataTable({
            "processing": true,
            "serverside": true,
            "paging":   false,
            "searching": false,
            "ajax": {
                "url": "{{route('listredmain')}}",
                "type": "GET",
            }
        });

        //Menyimpan data 
        $('#grnModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('grn.store') }}";
                else url = "grn/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#grnModal form').serialize(),
                    success : function(data){
                        $('#grnModal').modal('hide');
                        table.ajax.reload();
                    },
                    error : function(){
                        alert("Cannot Save Data");
                    }
                });
                return false;
            }
        });
    });

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
