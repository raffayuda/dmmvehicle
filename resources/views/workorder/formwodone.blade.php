@extends('layouts.main')
@section('title')
<title>VMM - workorder</title>
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
            <h4 class="text-themecolor">Create Work Order</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Work Order</a></li>
                    <li class="breadcrumb-item active">Create Workorder</li>
                </ol>
                {{-- <button onclick="addForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Create New
                            </button>
                            {{ csrf_field() }} --}}
            </div>
        </div>
    </div>
    {{-- <form id="form-produk" method="post">
        @csrf
        <input type="hidden" id="id" name="id" value={{$id}}>

    </form> --}}
      
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <form action="#" class="form-horizontal"> --}}
                    <form action="{{ route('done',[$id]) }}"  class="form-horizontal" data-toggle="validator" method="post" id="modal_form" name="modal_form" enctype="multipart/form-data" onsubmit="myButtonDone.disabled = true; return true;" onchange="myButtonDone.disabled = false; return false;">
                    {{ csrf_field() }} {{ method_field('POST') }}    
                    <input type="hidden" id="id" name="id" value={{$id}}>
                    <div class="form-body">

                    <div class="col-md-12">
                            <div class="form-group row">
                                <label for="done_date" class="control-label text-right col-md-3">WO DONE</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control mydatepicker" id="done_date" name="done_date" value="{{$now}}" required autocomplete="off">

                                {{-- <input type="text" id="wo_date" name="wo_date" class="form-control" value=" {{$workorder->wo_date}} "> --}}
                                </div>
                            </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="result" class="control-label text-right col-md-3">SERVICE DETAIL</label>
                                <div class="col-md-9">
                                <textarea id="result" name="result" type="text" class="form-control"  cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="deferred_item" class="control-label text-right col-md-3">BACK LOG</label>
                                <div class="col-md-9">
                                <textarea id="deferred_item" name="deferred_item" type="text" class="form-control"  cols="30" rows="10"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="status" class="control-label text-right col-md-3">STATUS</label>
                                <div class="col-md-9">
                                <input id="status" name="status" type="text" class="form-control" value=" {{$workorder->status}} " disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                </div>
                <div class="modal-footer">

                    <button type="submit" class="btn btn-primary" name="myButtonDone">Save</button>
            </form>
              
            </div>
        </div>
    </div>

</div>

@endsection
@section('script')
<script>
    $(function () {
        $('.mydatepicker, #datepicker').datepicker({
                autoclose: true,
                showTime: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true
            })


    });
$('#time').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
</script>
@endsection
