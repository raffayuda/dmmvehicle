@extends('layouts.main')
@section('title')
    <title>VMM - Sparepart</title>
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
                        <h4 class="text-themecolor">Daftar Sparepart</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Sparepart</a></li>
                                <li class="breadcrumb-item active">Daftar Sparepart</li>
                            </ol>
                            {{-- <button onclick="addForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Create New
                            </button>
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
                                <h4 class="card-title">Data Sparepart</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabelsparepart" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>SPAREPARTS NAME</th>
                                                <th>PART NUMBER</th>
                                                <th>LAST STOCK</th>
                                                <th>NEW STOCK</th>
                                                <th>UOM</th>
                                                <th>NOTE</th>
                                                <th>CREATED BY</th>
                                                <th>UPDATED AT</th>
                                                

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
                {{-- @include('stockopname.addsparepartupdate') --}}
@endsection
@section('script')

<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        // var id = $('#id').val();
        table = $('#tabelsparepart').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listadjustment',$id)}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        //Menyimpan data 
        $('#sparepartModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('stockopname.store') }}";
                else url = "stockopname/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#sparepartModal form').serialize(),
                    success : function(data){
                        $('#sparepartModal').modal('hide');
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
        $('#sparepartModal').modal('show');
        $('#sparepartModal form')[0].reset();
        $('.modal-title').text('Tambah Sparepart');
    }
    //Menampilkan data form Edit
    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#sparepartModal form')[0].reset();
        $.ajax({
            url : "sparepart/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#sparepartModal').modal('show');
                $('.modal-title').text('Sparepart Adjusment');
                $('#id').val(data.spareparts_id);
                $('#spareparts_name').val(data.spareparts_name);
                $('#part_number_group').val(data.part_number_group);
                $('#part_number').val(data.part_number);
                $('#last_stock').val(data.stock);
                $('#new_stock').val(data.stock);
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
                url : "sparepart/"+id,
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
 function CustomInitSelect2(element, options) {
            if (options.url) {
                $.ajax({
                    type: 'GET',
                    url: options.url,
                    dataType: 'json'
                }).then(function (data) {
                    element.select2({
                        dropdownParent: $("#sparepartModal"),
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