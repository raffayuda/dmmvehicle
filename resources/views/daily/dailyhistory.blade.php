@extends('layouts.main')
@section('title')
    <title>VMM - Daily Log History</title>
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
                        <h4 class="text-themecolor">History Daily</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Daily</a></li>
                                <li class="breadcrumb-item active">Histiry Daily</li>
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
                                <h4 class="card-title">Data Daily History</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <div class="table-responsive m-t-40">
                                    <table id="tabeldailyhistory" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>VEHICLES ID</th>
                                                <th>LOG DATE</th>
                                                <th>LAST ODO</th>
                                                <th>ODO</th>
                                                <th>DRIVER</th>
                                                <th>FUEL TOPUP</th>
                                                <th>EQUIPEMENT</th>
                                                <th>CONDITION</th>
                                                <th>PROBLEM</th>
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
                {{-- @include('daily.adddaily') --}}
@endsection
@section('script')

<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabeldailyhistory').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listdailyhistory')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        //Menyimpan data 
        $('#dailyModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('daily.store') }}";
                else url = "daily/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#dailyModal form').serialize(),
                    success : function(data){
                        $('#dailyModal').modal('hide');
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
        $('#dailyModal form')[0].reset();
        $('#dailyModal').modal('show');
        $('.modal-title').text('Tambah Daily');
        $("#vehicles_id").val('').trigger('change')
        $("#driver").val('').trigger('change')
        $("#equipement").val('').trigger('change')
        $("#condition").val('').trigger('change')
    }
    //Menampilkan data form Edit
    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#dailyModal form')[0].reset();
        $.ajax({
            url : "daily/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#dailyModal').modal('show');
                $('.modal-title').text('Edit Daily');

                $('#id').val(data.dailies_id);
                $('#vehicles_id').val(data.vehicles_id).trigger('change');
                $('#log_date').val(data.log_date);
                $('#odo').val(data.odo);
                $('#driver').val(data.driver).trigger('change');
                $('#fuel_topup').val(data.fuel_topup);
                $('#equipement').val(data.equipement).trigger('change');
                $('#condition').val(data.condition).trigger('change');
                $('#problem').val(data.problem);


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
                url : "daily/"+id,
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
                        dropdownParent: $("#dailyModal"),
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
