@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Create Purchase</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Purchase</a></li>
                    <li class="breadcrumb-item active">Create Purchase</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Purchase Order</h4>
                    <form action="{{ route('newpodetail.store') }}" class="form form-createpr" data-toggle="validator" method="post"
                        id="modal_form" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                   
                        <input type="hidden" id="created_by" name="created_by" value="{{Auth::user()->name}}">
                        <input type="hidden" id="newprs_id" name="newprs_id" value="{{$prs->newprs_id}}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label text-left col-md-3" for="pr_remarks" >PR REMARKS</label>
                                    <div class="col-md-9">
                                    {{-- <input type="text" class="form-control" name="remarks" id="remarks"> --}}
                                    <input type="text" class="form-control" name="pr_remarks" id="pr_remarks" value="{{$prs->pr_remarks}}" readonly>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pr_alias" class="control-label text-left col-md-3">PR NUMBER</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="pr_alias" id="pr_alias" value="{{$prs->pr_alias}}"  readonly>
                                    </div>
                                    
                                </div>
                                <div class="form-group row">
                                    <label for="po_status" class="control-label text-left col-md-3">PO STATUS</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="po_status" id="po_status" value="DRAFT"  readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="po_alias" class="control-label text-left col-md-3">PO NUMBER</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="po_alias" id="po_alias" value=""  readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="po_date" class="control-label text-left col-md-3">PO DATE</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="po_date" id="po_date" readonly >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="top" class="control-label text-left col-md-3">TERM OF PAYMENT</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="top" id="top" value="" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="delivery_point" class="control-label text-left col-md-3">DELIVERY POINT</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="delivery_point" id="delivery_point" value="" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="suppliers_id" class="control-label text-left col-md-3">SUPPLIER</label>
                                    <div class="col-md-9">
                                    <select class="select2 form-control custom-select" name="suppliers_id" id="suppliers_id"  style="width: 100%; height:36px;" required>
                                        
                                        <option value=""></option>
                                        @foreach ($suppliers as $item)
                                        <option value="{{$item->suppliers_name}}"> {{$item->suppliers_name}}</option>
                                        @endforeach
                                    </select> 

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cost_code" class="control-label text-left col-md-3">COST CODE</label>
                                    <div class="col-md-9">
                                    <select class="select2 form-control custom-select" name="cost_code" id="cost_code"  style="width: 100%; height:36px;" required>
                                        
                                        <option value=""></option>
                                        @foreach ($vehicles_model as $item)
                                        <option value="{{$item->vehiclemodels_name}}"> {{$item->vehiclemodels_name}}</option>
                                        @endforeach
                                    </select> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="po_remarks" class="control-label text-left col-md-3">PO REMARKS</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="po_remarks" id="po_remarks">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ppn" class="control-label text-left col-md-3">PPN</label>
                                    <div class="col-md-9">
                                    <select name="po_ppn" id="po_ppn" class="select2 form-control custom-select col-md-10" style="width: 100%; height:36px;" required>
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                    </div>
                                </div>
                            </div>			
                        </div>    
                        <table class="table table-striped tabelpodetail" id="tabelpodetails">
                            <thead>
                                <tr>
                                    <th width="30">NO</th>
                                    <th>PART NUMBER</th>
                                    <th>PART NAME</th>
                                    <th align="right">QTY</th>
                                    <th>UOM</th>
                                    <th>UNIT PRICE</th>
                                    <th width="100">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prdetails as $prdetail)

                                <?php 
                                // $prqty = App\Newprdetail::where('newprs_id',$podetail->newprs_id)->where('spareparts_id',$podetail->spareparts_id)->sum('pr_qty'); 
                                $poqty = App\Newpodetail::where('newprs_id',$prdetail->newprs_id)->where('spareparts_id',$prdetail->spareparts_id)->where('po_status','Submit')->sum('po_qty'); 
                                $gap = $prdetail->pr_qty-$poqty; 
                                ?>
                                @if ($gap <= 0)
                                    
                                @else
                                    
                                <td>{{++$no}}</td>
                                <td>{{$prdetail->part_number}}</td>
                                <td>{{$prdetail->spareparts_name}}</td>
                                <td>
                                <div class="form-group row">
                                    <div class="controls">
                                    <input type="text" name="pr_qty_{{$prdetail->newprdetails_id}}" id="pr_qty_{{$prdetail->newprdetails_id}}" min="0" max="{{$prdetail->pr_qty-$poqty}}" value="{{$prdetail->pr_qty-$poqty}}" class="form-control" required data-validation-required-message="This field is required" autocomplete="off">
                                    </div>
                                </div>
                                    </td>
                                <td>{{$prdetail->uom}}</td>
                                <td>
                                    <input type="text" name="po_price_{{$prdetail->newprdetails_id}}" id="po_price_{{$prdetail->newprdetails_id}}"  value="{{$prdetail->price}}" class="form-control" required data-validation-required-message="This field is required" autocomplete="off">
                                </td>
                                <td>
                                <input type="hidden" class="form-control" name="spareparts_id_{{$prdetail->newprdetails_id}}" id="spareparts_id_{{$prdetail->newprdetails_id}}" value="{{$prdetail->spareparts_id}}">
                                <input type="checkbox" name="podetail[]" id="podetail[]" value="{{$prdetail->newprdetails_id}}"></td>
                                </tr>
                                @endif
                                    
                                @endforeach
                                <tr>
                                
                            </tbody>
                        </table>
                    <div class="modal-footer">
                        <a href="{{ route('rejectnewpo',$prs->newprs_id) }}" class="btn btn-info">Reject</i></a>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                    
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>




@include('pr.addpart')

@endsection

@section('script')
<script>

var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelpodetail').DataTable({
            "processing": true,
            "serverside": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel'
        ],
            "ajax": {
                "url": "{{route('addpodetaildata')}}",
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    });
    $(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection
