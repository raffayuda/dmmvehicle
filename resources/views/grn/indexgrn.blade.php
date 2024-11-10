@extends('layouts.main')
@section('title')
    <title>VMM - Goods Receipt Note</title>
@endsection
@section('style')
        <style>
            .select-in-modal+.select2-form-control {
            width: 100% !important;
            padding: 0;
            z-index:10000;
            }

            .select2-form-control--open {
                z-index:10000;
            }
    </style>
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
                        <h4 class="text-themecolor">Daftar Goods Receipt Note</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Goods Receipt Note</a></li>
                                <li class="breadcrumb-item active">Daftar Goods Receipt Note</li>
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
                                <h4 class="card-title">Data Goods Receipt Note</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabelgrn" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>GR DATE</th>
                                                <th>GR NUMBER</th>
                                                <th>SPAREPARTS ID</th>
                                                <th>MANUFACTURE</th>
                                                <th>DOCUMENT</th>
                                                <th>DOCUMENT NUMBER</th>
                                                <th>RECEIPT FROM</th>
                                                <th>CONDITION</th>
                                                <th>QTY</th>
                                                <th>UOM</th>
                                                <th>REMARKS</th>
                                                <th>STORE MAN</th>

                                                {{-- <th>ACTION</th> --}}

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
@include('grn.addgrn')
@endsection
@section('script')

<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelgrn').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listgrn')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        table = $('#tabeladdgrn').DataTable({
            "processing": true,
            "serverside": true,
            "searching": true,
            "paging":   false,
            
            "ajax": {
                "url": "{{route('listrequestedgrn')}}",
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
                        // console.log(data);
                        $('#grnModal').modal('hide');
                        // window.location.href = "{{route('requisition.show',1)}}"
                        // window.location.href = "{{URL::to('restaurants/20')}}"
                // url : "grn/"+id,

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
        $('#grnModal').modal('show');
        $('#grnModal form')[0].reset();
        $('.modal-title').text('Goods Receive Notes');
    }
    //Menampilkan data form Edit
    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#grnModal form')[0].reset();
        $.ajax({
            url : "grn/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#grnModal').modal('show');
                $('.modal-title').text('Edit Good Receipt Note');

                $('#id').val(data.grns_id);
                $('#grns_date').val(data.grns_date);
                $('#spareparts_id').val(data.spareparts_id).trigger('change');
                $('#manufacture').val(data.manufacture).trigger('change');
                $('#document').val(data.document).trigger('change');
                $('#document_number').val(data.document_number);
                $('#receipt_from').val(data.receipt_from).trigger('change');
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
                url : "grn/"+id,
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
{{-- //Add GRN --}}

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
                        dropdownParent: $("#grnModal"),
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
        $.fn.modal.Constructor.prototype.enforceFocus=function(){};
</script>
@endsection
