@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Create Requisition</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Requisition</a></li>
                    <li class="breadcrumb-item active">Create Requisition</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Requisition</h4>
                    <form action="{{ route('newpr.store') }}" class="form form-createpr" data-toggle="validator" method="post"
                        id="modal_form" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                   
                        <input type="hidden" id="created_by" name="created_by" value="{{Auth::user()->name}}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label text-left col-md-3" for="pr_remarks" >REMARKS</label>
                                    <div class="col-md-9">
                                    {{-- <input type="text" class="form-control" name="remarks" id="remarks"> --}}
                                    <input type="text" class="form-control" name="pr_remarks" id="pr_remarks" onchange="this.form.submit()" >

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pr_alias" class="control-label text-left col-md-3">PR NUMBER</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="pr_alias" id="pr_alias" value=""  readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pr_status" class="control-label text-left col-md-3">STATUS</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="pr_status" id="pr_status" value="DRAFT"  readonly>
                                    </div>
                                </div>
                            </div>			
                        </div>    
                    </form>

                    <form class="form-addpart">
                        {{csrf_field()}} {{@method_field('PATCH')}}
                        <table class="table table-striped tabel-partpr" id="tabel-partpr">
                            <thead>
                                <tr>
                                    <th width="30">NO</th>
                                    <th>PART NUMBER</th>
                                    <th>PART NAME</th>
                                    <th align="right">QTY</th>
                                    <th>UOM</th>
                                    <th width="100">ACTION</th>
                                </tr>
                            </thead>
                            <tbody></tbody>

                        </table>
                    </form>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-info">Save</i></a>

                        <button onclick="showPart()" class="btn btn-info d-none d-lg-block m-l-15">
                                        <i class="fa fa-plus-circle"></i> Add New Part
                                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pr.addpart')

@endsection

