@extends('layouts.main')
@section('title')
    <title>VMM - Supplier</title>
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
                        <h4 class="text-themecolor">Daftar Supplier</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Supplier</a></li>
                                <li class="breadcrumb-item active">Daftar Supplier</li>
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
                                <h4 class="card-title">Data Supplier</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabelsupplier" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>SUPPLIERS NAME</th>
                                                <th>ADDRESS</th>
                                                <th>OWNER</th>
                                                <th>BANK ACCOUNT</th>
                                                <th>CONTACT PERSON</th>
                                                <th>PHONE</th>
                                                <th>FAX</th>
                                                <th>EMAIL</th>
                                                <th>VENDOR OF</th>
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
                @include('supplier.addsupplier')
@endsection
@section('script')

<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelsupplier').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listsupplier')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        //Menyimpan data 
        $('#supplierModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('supplier.store') }}";
                else url = "supplier/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#supplierModal form').serialize(),
                    success : function(data){
                        $('#supplierModal').modal('hide');
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
        $('#supplierModal').modal('show');
        $('#supplierModal form')[0].reset();
        $('.modal-title').text('Tambah supplier');
    }
    //Menampilkan data form Edit
    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#supplierModal form')[0].reset();
        $.ajax({
            url : "supplier/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#supplierModal').modal('show');
                $('.modal-title').text('Edit supplier');

                $('#id').val(data.suppliers_id);
                $('#suppliers_name').val(data.suppliers_name);
                $('#address').val(data.address);
                $('#owner').val(data.owner);
                $('#bank_account').val(data.bank_account);
                $('#contact_person').val(data.contact_person);
                $('#phone').val(data.phone);
                $('#fax').val(data.fax);
                $('#email').val(data.email);
                $('#vendor_of').val(data.vendor_of);
                $('#created_by').val(data.created_by);


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
                url : "supplier/"+id,
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

@endsection
