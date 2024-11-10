@extends('layouts.main')
@section('title')
    <title>VMM - lisence</title>
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
                        <h4 class="text-themecolor">Daftar lisence</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">lisence</a></li>
                                <li class="breadcrumb-item active">Daftar lisence</li>
                            </ol>
                            {{-- <button onclick="addForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Create New
                            </button> --}}
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
                                <h4 class="card-title">Data lisence</h4>
                                
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabellisence" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NOMOR LAMBUNG</th>
                                                <th>STNK</th>
                                                <th>STATUS</th>
                                                <th>PAJAK TAHUNAN</th>
                                                <th>STATUS</th>
                                                <th>IZIN LAPOR</th>
                                                <th>STATUS</th>
                                                <th>KIR</th>
                                                <th>STATUS</th>
                                                <th>COMMISIONING</th>
                                                <th>STATUS</th>
                                                <th>FUEL ISSUE</th>
                                                <th>STATUS</th>
                                                <th>ROAD I</th>
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
                @include('lisence.addlisence')
@endsection
@section('script')

<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabellisence').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listlisence')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        //Menyimpan data 
        $('#lisenceModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('lisence.store') }}";
                else url = "lisence/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#lisenceModal form').serialize(),
                    success : function(data){
                        $('#lisenceModal').modal('hide');
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
        $('#lisenceModal').modal('show');
        $('#lisenceModal form')[0].reset();
        $('.modal-title').text('Tambah lisence');
    }
    //Menampilkan data form Edit
    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#lisenceModal form')[0].reset();
        $.ajax({
            url : "lisence/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#lisenceModal').modal('show');
                $('.modal-title').text('Edit lisence');

                $('#id').val(data.lisences_id);
                $('#vehicles_id').val(data.nomor_lambung);
                $('#stnk').val(data.stnk);
                $('#pajak_tahunan').val(data.pajak_tahunan);
                $('#izin_lapor').val(data.izin_lapor);
                $('#kir').val(data.kir);
                $('#commisioning').val(data.commisioning);
                $('#fuel_issue').val(data.fuel_issue);
                $('#road_i').val(data.road_i);


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
                url : "lisence/"+id,
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
