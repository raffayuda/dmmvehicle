@extends('layouts.main')
@section('title')
    <title>VMM - requisition</title>
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
                        <h4 class="text-themecolor">Daftar PO</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">PO</a></li>
                                <li class="breadcrumb-item active">Daftar PO</li>
                            </ol>
                    {{-- <a href="requisition/create" class="btn btn-info"><i class="fa fa-plus-circle">Create New</i></a> --}}

                            {{-- <button onclick="addForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Create New
                            </button>
                            {{ csrf_field() }} --}}


                            {{-- <a href="{{action('PrController@create')}}" class="btn btn-info"><i class="fa fa-plus-circle"></i>Create New</a><br>
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
                                <h4 class="card-title">PROCUREMENT STATUS</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabelpo" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>SPR NO</th>
                                                <th>CREATED</th>
                                                <th>APPROVED</th>
                                                <th>PART NUMBER</th>
                                                <th>PART NAME</th>
                                                <th>PR QTY</th>
                                                <th>UOM</th>
                                                <th>PO NUMBER</th>
                                                <th>PO DATE</th>
                                                <th>COST CODE</th>
                                                <th>VENDOR</th>
                                                <th>PRICE</th>
                                                <th>TOTAL</th>
                                                <th>GR NUMBER</th>
                                                <th>GRN QTY</th>
                                                <th>OUTSTANDING</th>

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
        table = $('#tabelpo').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('liststatusnewpo')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    });
        
    </script>
@endsection