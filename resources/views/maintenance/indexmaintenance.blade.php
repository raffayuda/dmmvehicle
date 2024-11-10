@extends('layouts.main')
@section('title')
    <title>VMM - maintenance</title>
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
                        <h4 class="text-themecolor">Daftar maintenance</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">maintenance</a></li>
                                <li class="breadcrumb-item active">Daftar maintenance</li>
                            </ol>
                            {{-- <button onclick="addForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Create New
                            </button> --}}
                        {{-- <a href="{{ route('robbing.index') }}" class="btn btn-info">Robbing Part</a> --}}

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
                                <h4 class="card-title">Data maintenance</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabelmaintenance" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>VEHICLE TYPE</th>
                                                <th>NOMOR LAMBUNG</th>
                                                <th>REPORT DATE</th>
                                                <th>LAST KM</th>
                                                <th>NEXT KM</th>
                                                <th>MAINTENANCE PACKAGE</th>
                                                <th>PROBLEM</th>

                                                <th>TYPE</th>
                                                <th>LAST DATE</th>
                                                <th>DUE DATE</th>
                                                <th>SCHEDULED DATE</th>
                                                <th>STATUS</th>


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
                @include('maintenance.addmaintenance')
@endsection
@section('script')

<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelmaintenance').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listmaintenance')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        //Menyimpan data 
        $('#maintenanceModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('maintenance.store') }}";
                else url = "maintenance/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#maintenanceModal form').serialize(),
                    success : function(data){
                        $('#maintenanceModal').modal('hide');
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
    //Menampilkan form tambah
    function addForm(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#maintenanceModal').modal('show');
        $('#maintenanceModal form')[0].reset();
        $('.modal-title').text('Tambah maintenance');
    }
    //Menampilkan data form Edit
    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#maintenanceModal form')[0].reset();
        $.ajax({
            url : "maintenance/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#maintenanceModal').modal('show');
                $('.modal-title').text('Schedule Creation');

                $('#id').val(data.maintenances_id);
                $('#vehicles_ids').val(data.vehicles_id);
                $('#packages_ids').val(data.packages_id);
                $('#vehicles_id').val(data.nomor_lambung);
                $('#packages_id').val(data.packages_name);
                $('#report_date').val(data.report_date);
                $('#last_km').val(data.last_km);
                $('#next_km').val(data.next_km);
                $('#due_date').val(data.due_date);
                $('#schedule_date').val(data.schedule_date);
                $('#problem').val(data.problem);
                $('#status').val(data.status);


            },
            error : function(){
                alert("Cannot Show Data");
            }
        });
    }
    //Menghapus data
    function deleteData(id){
        if(confirm("Are you Sure?")){
            $.ajax({
                url : "maintenance/"+id,
                type : "DELETE",
                data : {
                    'method' : 'DELETE',
                    "_token": "{{ csrf_token() }}"

                    },
                    success : function(data){
                         table.ajax.reload();
                    },
                    error : function(){
                        alert("Cannot Delete Data");
                    }
            });
        }
    }
</script>
<script>
    $(function () {
        $('.mydatepicker, #datepicker').datepicker({
                autoclose: true,
                showTime: false,
                format: 'yyyy-mm-dd',
                todayHighlight: true
            })
            
        //Money Euro
        // $('[autocomplete="off"]').inputmask();

    });
</script>

@endsection
