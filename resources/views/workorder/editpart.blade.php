@extends('layouts.main')
@section('title')
    <title>VMM - Work Order</title>
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
                        <h4 class="text-themecolor">Daftar Work Order</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Work Order</a></li>
                                <li class="breadcrumb-item active">Daftar Work Order</li>
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
                    <form action="{{ route('updatepart',[$id,$work]) }}"  class="form-horizontal" data-toggle="validator" method="post" id="modal_form" name="modal_form" enctype="multipart/form-data">
                    {{ csrf_field() }} {{ method_field('PATCH') }}    
                    <input type="hidden" id="id" name="id" value={{$id}}>
                    <input type="hidden" id="work" name="work" value={{$work}}>
                    <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="spareparts_name" class="control-label text-right col-md-3">SPAREPART NAME</label>
                                <div class="col-md-9">
                                <input id="spareparts_name" name="spareparts_name" type="text" class="form-control" value="{{$sparepart_name}} ">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="wo_qty" class="control-label text-right col-md-3">QUANTITY</label>
                                <div class="col-md-9">
                                <input id="wo_qty" name="wo_qty" type="text" class="form-control" value="{{$partpackage->wo_qty}} ">
                                </div>
                            </div>
                            
                        </div>
                    </div>         
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span> </button>
                </div>
                    

                </div>
            </form>
                </div>
                {{-- @include('workorder.addworkorder') --}}
@endsection

