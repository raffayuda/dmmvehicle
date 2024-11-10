@extends('layouts.main')
@section('title')
    <title>VMM - PR</title>
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
                        <h4 class="text-themecolor">Daftar PR</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Requisition</a></li>
                                <li class="breadcrumb-item active">Daftar PR</li>
                            </ol>
                    {{-- <a href="requisition/create" class="btn btn-info"><i class="fa fa-plus-circle">Create New</i></a> --}}

                            {{-- <button onclick="addForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Create New
                            </button>
                            {{ csrf_field() }} --}}
                            &nbsp;

                            <a href="{{action('NewprController@create')}}" class="btn btn-info"><i class="fa fa-plus-circle"></i>Create PR</a><br>
                            {{ csrf_field() }}


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
                                <h4 class="card-title">Daftar PR</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabelpr" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>PR NUMBER</th>
                                                <th>CREATE DATE</th>
                                                <th>AKNOWLEDGE DATE</th>
                                                <th>APPROVE DATE</th>
                                                <th>NUMBER OF ITEMS</th>
                                                <th>PR STATUS</th>
                                                <th>PO STATUS</th>
                                                {{-- <th>PR QTY</th> --}}
                                                {{-- <th>PO QTY</th> --}}
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
                {{-- @include('requisition.addrequisition') --}}
@endsection
@section('script')
<script>

var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelpr').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('newprdata')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    });
        
    </script>
@endsection