@extends('layouts.main')
@section('title')
    <title>VMM - inventory</title>
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
                        <h4 class="text-themecolor">Daftar inventory</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">inventory</a></li>
                                <li class="breadcrumb-item active">Daftar inventory</li>
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

                <form id="form-produk" method="post">
                    @csrf
                    <input type="hidden" id="id" name="id">

                </form>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data inventory</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabelinventory" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>VEHICLEMODELS ID</th>
                                                <th>MANUFACTURERS ID</th>
                                                <th>PART NUMBER GROUP</th>
                                                <th>PART NUMBER</th>
                                                <th>PART NAME</th>
                                                <th>PART TYPE</th>
                                                <th>UOM</th>
                                                <th>STOCK</th>
                                                <th>MIN STOCK</th>
                                                <th>MAX STOCK</th>
                                                <th>RESERVED</th>
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
                @include('inventory.addinventory')
@endsection
@section('script')

<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelinventory').DataTable({
            "processing": true,
            "serverside": true,
            "scrollY": 1000,
            "scrollX": true,
            "pageLength": 50,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel','pageLength'
        ],
            "ajax": {
                "url": "{{route('listinventory')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        //Menyimpan data 
        $('#inventoryModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('inventory.store') }}";
                else url = "inventory/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#inventoryModal form').serialize(),
                    success : function(data){
                        $('#inventoryModal').modal('hide');
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
        $('#inventoryModal').modal('show');
        $('#inventoryModal form')[0].reset();
        $('.modal-title').text('Tambah inventory');
    }
    //Menampilkan data form Edit
    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#inventoryModal form')[0].reset();
        $.ajax({
            url : "inventory/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#inventoryModal').modal('show');
                $('.modal-title').text('Edit inventory');

                $('#id').val(data.inventories_id);
                $('#inventories_name').val(data.inventories_name);
                $('#vehiclemodels_id').val(data.vehiclemodels_id);
                $('#manufacturers_id').val(data.manufacturers_id);
                $('#part_number').val(data.part_number);
                $('#part_name').val(data.part_name);
                $('#part_type').val(data.part_type);
                $('#uom').val(data.uom);
                $('#part_price').val(data.part_price);
                $('#price_update').val(data.price_update);
                $('#stock').val(data.stock);
                $('#min_stock').val(data.min_stock);
                $('#max_stock').val(data.max_stock);
                $('#reserved').val(data.reserved);


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
                url : "inventory/"+id,
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
    function printWo(id){
            
                $('#form-produk').attr('target','blank').attr('action',"printwo/'.id.'/printwo").submit();
        }
</script>

@endsection
