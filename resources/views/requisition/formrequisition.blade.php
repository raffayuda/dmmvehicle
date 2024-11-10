@extends('layouts.main')
@section('title')
<title>VMM - Workorder</title>
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
            <h4 class="text-themecolor">Create SPR</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">SPR</a></li>
                    <li class="breadcrumb-item active">Create SPR</li>
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
                                <h4 class="card-title">Sparepart Purchase Requisition</h4>
                                <form data-toggle="validator" method="post" enctype="multipart/form-data">
                                 {{ csrf_field() }} {{ method_field('POST')}}
                                    
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="requisitions_id" name="requisitions_id" value=" SPR Number : {{$lastInsertedId}} " readonly>
                                        <input type="text" class="form-control" id="spr_alias" name="spr_alias" value=" SPR Number : {{$status->spr_alias}} " readonly>
                                        <input type="text" class="form-control" id="procurement_method" name="procurement_method" value=" Procurement Method : {{$status->procurement_method}} " readonly>
                                        <input type="text" class="form-control" id="remarks" name="remarks" value=" Remarks : {{$status->remarks}} " readonly>
                                        
                                    </div>
                                    
                                    <div class="table-responsive m-t-40">
                                        <table id="tabelrequested" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>PART NUMBER</th>
                                                    <th>PART NAME</th>
                                                    <th>QTY</th>
                                                    <th>UOM</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                
                                            </tfoot>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                                    {{-- {{$count}} --}}
                                </form>
                                <div class="modal-footer">
                                    @if ($status->status == 'Draft')
                                        <button onclick="addForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                        <i class="fa fa-plus-circle"></i> Add Spare New
                                        </button>
                                        @if ($count > 0)
                                        <a href=" {{ url('requisition/send/'.$lastInsertedId)}} " class="btn btn-success">Submit</a>

                                        {{-- <button type="submit" class="btn btn-primary">Send</button> --}}
                                        @endif
                                    @elseif ($status->status == 'Submitted')
                                        @if (Auth::user()->approve_spr == 1)
                                            <a href=" {{route('requisitionacknowledge',$lastInsertedId)}}" class="btn btn-info"><i class="fa fa-plus-circle">Acknowledge</i></a>
                                        @endif
                                    @elseif ($status->status == 'Acknowledge')
                                        @if (Auth::user()->approve_spr == 2)
                                            <a href=" {{route('requisitionapprove',$lastInsertedId)}}" class="btn btn-info"><i class="fa fa-plus-circle">Approve</i></a>
                                        @endif
                                    @endif

                                    {{-- @if ($status->status == 'Send')
                                        @if (Auth::user()->approve_spr == 1)
                                            <a href="/dmmvehicle/requisition/approve/{{ $lastInsertedId}}" class="btn btn-info"><i class="fa fa-plus-circle">Acknowledge</i></a>
                                        @endif
                                                                           
                                    @elseif ($status->status == 'Acknowledge')
                                        @if (Auth::user()->approve_spr == 1)
                                        
                                            <a href="/dmmvehicle/requisition/approve/{{ $lastInsertedId}}" class="btn btn-info"><i class="fa fa-plus-circle">Approve</i></a>
                                        @endif
                                        
                                    @endif
                                    @endif --}}
                                </div>
                                

                                
                                {{ csrf_field() }}
                            </div>
                        </div>
                    </div>
                </div>


</div>
{{-- @include('requisition.addrequisition') --}}
                @include('requisition.addrequested')

@endsection
@section('script')
<script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelrequested').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('listrequested',$lastInsertedId)}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        //Menyimpan data 
        $('#requestedModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('requested.store') }}";
                else url = "requested/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#requestedModal form').serialize(),
                    success : function(data){
                        $('#requestedModal').modal('hide');
                        // table.ajax.reload();
                        window.location.reload();
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
        $('#requestedModal').modal('show');
        $('#requestedModal form')[0].reset();
        $('.modal-title').text('Tambah requested');
    }
    //Menampilkan data form Edit
    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#requestedModal form')[0].reset();
        $.ajax({
            url : "requested/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#requestedModal').modal('show');
                $('.modal-title').text('Edit requested');

                $('#id').val(data.requesteds_id);
                $('#requesteds_name').val(data.requesteds_name);
                $('#vehiclemodels_id').val(data.vehiclemodels_id).trigger('change');
                $('#maintenance_type').val(data.maintenance_type).trigger('change');
                $('#km').val(data.km);
                $('#day').val(data.day);
                $('#next_requesteds_id').val(data.next_requesteds_id).trigger('change');
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
                url : "/dmmvehicle/requested/"+id,
                type : "DELETE",
                data : {
                    'method' : 'DELETE',
                    "_token": "{{ csrf_token() }}"

                    },
                    success : function(data){
                        //  table.ajax.reload();
                         window.location.reload();
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