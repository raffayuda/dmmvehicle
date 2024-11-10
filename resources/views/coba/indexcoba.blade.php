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
                                    <table id="tabelcoba" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>COBA</th>

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
                <form action="/home">
                    <button type="submit" class="btn btn-primary">Submit</button>
                 <a onCLick="editFormCoba('1')" class="btn btn-info"><i class="fa fa-edit"></i></a>
                <a onclick="addFormcoba()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Create New
                            </a>
                            {{-- {{ csrf_field() }} --}}
                </form>
                 <a onCLick="editFormCoba('1')" class="btn btn-info"><i class="fa fa-edit"></i></a>

                @include('coba.addcoba')
                @include('coba.addcobalagi')
@endsection
@section('script')

<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelcoba').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listcoba')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        //Menyimpan data 
        $('#cobaModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('coba.store') }}";
                else url = "coba/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#cobaModal form').serialize(),
                    success : function(data){
                        $('#cobaModal').modal('hide');
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
        $('#cobaModal').modal('show');
        $('#cobaModal form')[0].reset();
        $('.modal-title').text('Tambah Coba');
    }
    //Menampilkan data form Edit
    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#cobaModal form')[0].reset();
        $.ajax({
            url : "coba/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#cobaModal').modal('show');
                $('.modal-title').text('Edit Good Receipt Note');

                $('#id').val(data.id);
                $('#coba').val(data.coba);
            },
            error : function(){
                alert("Cannot Show Data");
            }
        });
    }
    function editFormCoba(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#cobalagiModal form')[0].reset();
        $.ajax({
            url : "coba/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#cobalagiModal').modal('show');
                $('.modal-title').text('Edit COBA lagi');

                $('#ida').val(data.id);
                $('#cobaa').val(data.coba);
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
                url : "coba/"+id,
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
{{-- //cobalagi --}}

<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelcoba').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listcoba')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        //Menyimpan data 
        $('#cobalagiModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('coba.store') }}";
                else url = "coba/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#cobalagiModal form').serialize(),
                    success : function(data){
                        $('#cobalagiModal').modal('hide');
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
    function addFormcoba(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#cobalagiModal').modal('show');
        $('#cobalagiModal form')[0].reset();
        $('.modal-title').text('Tambah Coba Lagi');
    }
    //Menampilkan data form Edit
    
    //Menghapus data
    function deleteData(id){
        if(confirm("Are you Sure?")){
            $.ajax({
                url : "coba/"+id,
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
                        dropdownParent: $("#cobaModal"),
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
