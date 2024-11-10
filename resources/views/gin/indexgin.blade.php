@extends('layouts.main')
@section('title')
    <title>VMM - Goods Issue</title>
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
                        <h4 class="text-themecolor">Daftar Goods Issue</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Goods Issue Note</a></li>
                                <li class="breadcrumb-item active">Daftar Goods Issue</li>
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
                                <h4 class="card-title">Data Goods Issue</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabelgin" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>GINS DATE</th>
                                                <th>PART NUMBER</th>
                                                <th>PART NAME</th>
                                                <th>NOMOR LAMBUNG</th>
                                                <th>MANUFACTURE</th>
                                                <th>DOCUMENT</th>
                                                <th>DOCUMENT NUMBER</th>
                                                <th>CONDITION</th>
                                                <th>QTY</th>
                                                <th>UOM</th>
                                                <th>REMARKS</th>
                                                <th>TAKEN BY</th>
                                                <th>STORE MAN</th>
                                                <th>APPROVED BY</th>

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
                @include('gin.addgin')
@endsection
@section('script')

<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelgin').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listgin')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        table = $('#tabeladdgin').DataTable({
            "processing": true,
            "serverside": true,
            "searching": true,
            "paging":   false,
            
            "ajax": {
                "url": "{{route('listrequestedgin')}}",
                "type": "GET",
            }
        });
        //Menyimpan data 
        $('#ginModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('gin.store') }}";
                else url = "gin/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#ginModal form').serialize(),
                    success : function(data){
                        $('#ginModal').modal('hide');
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
        $('#ginModal').modal('show');
        $('#ginModal form')[0].reset();
        $('.modal-title').text('Tambah Good Issue Note');
    }
    //Menampilkan data form Edit
    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#ginModal form')[0].reset();
        $.ajax({
            url : "gin/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#ginModal').modal('show');
                $('.modal-title').text('Edit gin');

                $('#id').val(data.gins_id);
                $('#gins_date').val(data.gins_date);
                $('#spareparts_id').val(data.spareparts_id).trigger('change');
                $('#part_number').val(data.part_number);
                $('#part_name').val(data.part_name);
                $('#manufacture').val(data.manufacture).trigger('change');
                $('#document').val(data.document);
                $('#document_number').val(data.document_number);
                $('#used_for').val(data.used_for);
                $('#condition').val(data.condition);
                $('#qty').val(data.qty);
                $('#uom').val(data.uom);
                $('#remarks').val(data.remarks);
                $('#taken_by').val(data.taken_by).trigger('change');
                $('#store_man').val(data.store_man).trigger('change');
                $('#approved_by').val(data.approved_by).trigger('change');


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
                url : "gin/"+id,
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
            
    });
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
                        dropdownParent: $("#ginModal"),
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
