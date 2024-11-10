@extends('layouts.main')
@section('title')
    <title>VMM - Work Order</title>
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
                        <h4 class="text-themecolor">Daftar Work Order</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Work Order</a></li>
                                <li class="breadcrumb-item active">Daftar Work Order</li>
                            </ol>
                            <button onclick="addForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> WO Robbing Part
                            </button>
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
                                <h4 class="card-title">Data workorder</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabelworkorder" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>SCHEDULED DATE</th>
                                                <th>TIME</th>
                                                <th>WO DATE</th>
                                                <th>WO NUMBER</th>
                                                <th>PACKAGES NAME</th>
                                                <th>ODO METER   </th>
                                                <th>NO LAMBUNG</th>
                                                <th>LOCATION</th>
                                                <th>NOTE</th>
                                                <th>PROBLEM</th>
                                                <th>MECHANIC</th>
                                                <th>LEADING HEAD</th>
                                                <th>COORDINATOR</th>
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
                @include('workorder.addworkorder')
@endsection
@section('script')

<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelworkorder').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listworkorder')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        //Menyimpan data 
        $('#workorderModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('workorder.store') }}";
                else url = "workorder/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#workorderModal form').serialize(),
                    success : function(data){
                        $('#workorderModal').modal('hide');
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
        $('#workorderModal').modal('show');
        $('#workorderModal form')[0].reset();
        $('.modal-title').text('Tambah WO Cannibal');
    }
    // //Menampilkan data form Edit
    // function editForm(id){
    //     save_method = "edit";
    //     $('input[name=_method]').val('PATCH');
    //     $('#workorderModal form')[0].reset();
    //     $.ajax({
    //         url : "workorder/"+id+"/edit",
    //         type : "GET",
    //         dataType : "JSON",
    //         success : function(data){
    //             $('#workorderModal').modal('show');
    //             $('.modal-title').text('Edit workorder');

    //             $('#id').val(data.workorders_id);
    //             $('#workorders_name').val(data.workorders_name);
    //             $('#workorders_address').val(data.workorders_address);
    //             $('#contact_person').val(data.contact_person);
    //             $('#phone').val(data.phone);
    //             $('#email').val(data.email);

    //         },
    //         error : function(){
    //             alert("Cannot Show Data");
    //         }
    //     });
    // }
    // //Menghapus data
    // function deleteData(id){
    //     if(confirm("Are you Sure?")){
    //         $.ajax({
    //             url : "workorder/"+id,
    //             type : "DELETE",
    //             data : {
    //                 'method' : 'DELETE',
    //                 "_token": "{{ csrf_token() }}"

    //                 },
    //                 success : function(data){
    //                      table.ajax.reload();
    //                 },
    //                 error : function(){
    //                     alert("Cannot Delete Data");
    //                 }
    //         });
    //     }
    // }
</script>
<script>
 function CustomInitSelect2(element, options) {
            if (options.url) {
                $.ajax({
                    type: 'GET',
                    url: options.url,
                    dataType: 'json'
                }).then(function (data) {
                    element.select2({
                        dropdownParent: $("#workorderModal"),
                        data: data
                    });
                    if (options.initialValue) {
                        element.val(options.initialValue).trigger('change');
                    }
                });
            }
        }

        $('.select2').each(function (index, element) {
            var item = $(element);
            if (item.data('url')) {
                CustomInitSelect2(item, {
                    url: item.data('url'),
                    initialValue: item.data('value')
                });
            }
            else {
                item.select2();
            }
        });
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
