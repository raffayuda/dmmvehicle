@extends('layouts.main')
@section('title')
    <title>VMM - GR</title>
@endsection
@section('style')
    
@endsection
@section('head')
    
@endsection


@section('content')
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">Daftar GR</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Purchase</a></li>
                                <li class="breadcrumb-item active">Daftar GR</li>
                            </ol>
                    {{-- <a href="requisition/create" class="btn btn-info"><i class="fa fa-plus-circle">Create New</i></a> --}}

                            <button onclick="addForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Create GR
                            </button>
                            {{ csrf_field() }}
                            &nbsp;

                            {{-- <a href="{{action('NewpoController@create')}}" class="btn btn-info"><i class="fa fa-plus-circle"></i>Create PO</a><br>
                            {{ csrf_field() }} --}}


                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daftar GR</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabelgr" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>GR DATE</th>
                                                <th>GR NUMBER</th>
                                                <th>DOCUMENT</th>
                                                <th>DOCUMENT NUMBER</th>
                                                <th>RECEIVE FROM</th>
                                                <th>STOREMAN</th>
                                                <th>GR STATUS</th>
                                                <th>ACTION</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            
                                        </tfoot>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('newgr.addgr')
@endsection
@section('script')
<script>

var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelgr').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('newgrdata')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    });

    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabeladdgr').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('addgrdata')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    });

    //Menampilkan form tambah
    function addForm(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#addgrModal').modal('show');
        $('#addgrModal form')[0].reset();
        $('.modal-title').text('Tambah GR');
    }
        
    </script>
    
@endsection