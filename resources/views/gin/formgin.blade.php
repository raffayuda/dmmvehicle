@extends('layouts.main')
@section('title')
    <title>VMM - Goods Issue Note</title>
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
                        <h4 class="text-themecolor">Create Goods Issue Note</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Goods Issue Note</a></li>
                                <li class="breadcrumb-item active">Create Goods Issue Note</li>
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
                                <h4 class="card-title">Create Goods Issue Note</h4>
                                {{-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> --}}
                                <form action="{{ route('savegin') }}"  class="form-horizontal" data-toggle="validator" method="post" id="modal_form" name="modal_form" enctype="multipart/form-data">
                    {{ csrf_field() }} {{ method_field('POST') }}    
                    <input type="hidden" id="id" name="id" value={{$id}}>
                    {{-- <input type="hidden" id="receipt_from" name="receipt_from" value={{$requested->suppliers_id}}> --}}
                    {{-- <input type="hidden" id="document_number" name="document_number" value={{$requested->po_alias}}> --}}
                    <input type="hidden" id="wo_number" name="wo_number" value={{$requested->workorders_id}}>
                    <input type="hidden" id="spareparts_id" name="spareparts_id" value={{$requested->spareparts_id}}>

                <div class="modal-body">
                    {{-- <input type="hidden" id="id" name="id"> --}}
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="gins_date" class="control-label">GOOD ISSUE DATE</label>
                                <input type="text" class="form-control mydatepicker" id="gins_date" name="gins_date" value="{{old('gins_date')}}" required autocomplete="off">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                   		
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="spareparts_ids" class="control-label">PART NUMBER</label>
                                <input type="text" class="form-control" id="spareparts_ids" name="spareparts_ids" value="{{$part_number}}" readonly>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="nomor_lambung" class="control-label">NOMOR LAMBUNG</label>
                                <input type="text" class="form-control" id="nomor_lambung" name="nomor_lambung" value="{{$nomor_lambung}}" readonly>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="part_name" class="control-label">PART NAME</label>
                            <input type="text" class="form-control" id="part_name" name="part_name" value="{{$spareparts_name}}" readonly>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>			
                    </div>			
                                
                    <div class="row">	
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="document" class="control-label">DOCUMENT</label>
                                <input type="hidden" class="form-control" id="document" name="document" value="1" required readonly>
                                <input type="text" class="form-control" id="documents" name="documents" value="WO" required readonly>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="document_number_alias" class="control-label">WO NUMBER</label>
                                <input type="text" class="form-control" id="document_number_alias" name="document_number_alias" value="{{$requested->wo_alias}}" readonly>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
	
                        
                    </div>			
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="qty" class="control-label">QTY (Pending WO {{$pending}}) </label>
                                <div class="controls">
                                        <input type="text" name="qty" id="qty" min="0" max="{{$pending}}" class="form-control" required data-validation-required-message="This field is required" required autocomplete="off">
                                </div>
                            </div>	
                        </div>
		
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="uom" class="control-label">UOM</label>
                                <input type="text" class="form-control" id="uom" name="uom" value="{{$uom}}" readonly>

                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="remarks" class="control-label">REMARKS</label>
                                <input type="text" class="form-control" id="remarks" name="remarks" value="{{old('remarks')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
	
                        {{-- <div class="col-md-6 ">
                            <div class="form-group">	
                                <label for="taken_by" class="control-label">TAKEN BY</label>
                                <select class="form-control select2" id="taken_by" name="taken_by" data-url="/dmmvehicle/api/selectemployee" required>
                                    <option selected value="{{$requested->taken_by}}">{{$requested->taken_by}}</option>
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		 --}}
                    </div>			
                                
                    {{-- <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="store_man" class="control-label">STORE MAN</label>
                                <select class="form-control select2" id="store_man" name="store_man" data-url="/dmmvehicle/api/selectemployee" data-value="" required>
                                    <option selected value="{{$requested->store_man}}">{{$requested->store_man}}</option>
                                    </select>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
	
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="approved_by" class="control-label">APPROVED BY</label>
                                <select class="form-control select2" id="approved_by" name="approved_by" data-url="/dmmvehicle/api/selectemployee" data-value="" required>
                                    <option selected value="{{$requested->approved_by}}">{{$requested->approved_by}}</option>
                                    </select>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
		 --}}


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span> </button>

                </div>
            </form>
                                
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
        $('.modal-title').text('Goods Receive Notes');
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
                $('.modal-title').text('Edit Good Receipt Note');

                $('#id').val(data.gins_id);
                $('#gins_date').val(data.gins_date);
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
{{-- //Add gin --}}

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
