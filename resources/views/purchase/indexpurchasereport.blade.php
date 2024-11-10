@extends('layouts.main')
@section('title')
    <title>VMM - purchasereport</title>
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
                        <h4 class="text-themecolor">Daftar Purchase Report</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Purchase Reprot</a></li>
                                <li class="breadcrumb-item active">Daftar Purchase Reprot</li>
                            </ol>
                    {{-- <a href="requisition/create" class="btn btn-info"><i class="fa fa-plus-circle">Create New</i></a> --}}

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
                                <h4 class="card-title">Purchase Reprot</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabelrequisition" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>SPR NO</th>
                                                <th>CREATED</th>
                                                <th>APPROVED</th>
                                                <th>PART NUMBER</th>
                                                <th>PART NAME</th>
                                                <th>QTY</th>
                                                <th>UOM</th>
                                                <th>PO NUMBER</th>
                                                <th>VENDOR</th>
                                                <th>PRICE</th>
                                                <th>TOTAL</th>
                                                <th>GRN QTY</th>
                                                <th>OUTSTANDING QTY</th>
                                                
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
        table = $('#tabelrequisition').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listpurchasereport')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        //Menyimpan data 
        $('#requisitionModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('requisition.store') }}";
                else url = "requisition/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#requisitionModal form').serialize(),
                    success : function(data){
                        $('#requisitionModal').modal('hide');
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
        $('#requisitionModal').modal('show');
        $('#requisitionModal form')[0].reset();
        $('.modal-title').text('Tambah requisition');
    }
    //Menampilkan data form Edit
    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#requisitionModal form')[0].reset();
        $.ajax({
            url : "requisition/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#requisitionModal').modal('show');
                $('.modal-title').text('Edit requisition');

                $('#id').val(data.requisitions_id);
                $('#requisitions_id').val(data.requisitions_id);
                $('#spareparts_id').val(data.spareparts_id);
                $('#spareparts_name').val(data.spareparts_name);
                $('#qty').val(data.qty);
                $('#po_number').val(data.po_number);
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
                url : "requisition/"+id,
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
                        dropdownParent: $("#requestedModal"),
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
