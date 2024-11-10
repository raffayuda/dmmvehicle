@extends('layouts.main')
@section('title')
    <title>VMM - history</title>
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
                        <h4 class="text-themecolor">Daftar history</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">history</a></li>
                                <li class="breadcrumb-item active">Daftar history</li>
                            </ol>
                            <button onclick="addForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Create New
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
                                <h4 class="card-title">Data history</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabelhistory" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>WO DATE</th>
                                                <th>WO NUMBER</th>
                                                <th>NOMOR LAMBUNG</th>
                                                <th>NOMOR POLISI</th>
                                                <th>SERVICE PACKAGE</th>
                                                <th>ODO</th>
                                                <th>START</th>
                                                <th>END</th>
                                                <th>DETAIL BROKEN</th>
                                                <th>DETAIL SERVICE</th>
                                                <th>CHANGE PART</th>
                                                <th>BACK LOG</th>
                                                <th>MEKANIK</th>
                                                <th>STATUS</th>

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
                {{-- @include('history.addhistory') --}}
@endsection
@section('script')

<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelhistory').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listhistory')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        //Menyimpan data 
        // $('#historyModal form').on('submit',function(e){
        //     if(!e.isDefaultPrevented()){
        //         var id = $('#id').val();
        //         if(save_method == "add") url = "";
        //         else url = "history/"+id;
        //         $.ajax({
        //             url : url,
        //             type : "POST",
        //             data : $('#historyModal form').serialize(),
        //             success : function(data){
        //                 $('#historyModal').modal('hide');
        //                 table.ajax.reload();
        //             },
        //             error : function(){
        //                 alert("Cannot Save Data");
        //             }
        //         });
        //         return false;
        //     }
        // });
    });
    //Menampilkan form tambah
    // function addForm(){
    //     save_method = "add";
    //     $('input[name=_method]').val('POST');
    //     $('#historyModal').modal('show');
    //     $('#historyModal form')[0].reset();
    //     $('.modal-title').text('Tambah history');
    // }
    //Menampilkan data form Edit
    // function editForm(id){
    //     save_method = "edit";
    //     $('input[name=_method]').val('PATCH');
    //     $('#historyModal form')[0].reset();
    //     $.ajax({
    //         url : "history/"+id+"/edit",
    //         type : "GET",
    //         dataType : "JSON",
    //         success : function(data){
    //             $('#historyModal').modal('show');
    //             $('.modal-title').text('Edit history');

    //             $('#id').val(data.historys_id);
    //             $('#historymodels_id').val(data.historymodels_id).trigger('change');
    //             $('#manufacturers_id').val(data.manufacturers_id).trigger('change');
    //             $('#nomor_lambung').val(data.nomor_lambung);
    //             $('#nomor_polisi').val(data.nomor_polisi);
    //             $('#tahun_pembuatan').val(data.tahun_pembuatan);
    //             $('#nomor_rangka').val(data.nomor_rangka);
    //             $('#nomor_mesin').val(data.nomor_mesin);
    //             $('#nomor_polis').val(data.nomor_polis);

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
    //             url : "history/"+id,
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
                        dropdownParent: $("#historyModal"),
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
</script>

@endsection
