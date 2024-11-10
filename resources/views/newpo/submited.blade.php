@extends('layouts.main')
@section('title')
    <title>VMM - PO</title>
@endsection
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
                    <h4 class="card-title">Create Purchase</h4>
                    <form action="{{ route('newpodetail.updatepodetail',[$po->newpos_id]) }}" class="form form-createpr" data-toggle="validator" method="post"
                        id="modal_form" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                   
                        <input type="hidden" id="created_by" name="created_by" value="{{Auth::user()->name}}">
                        <input type="hidden" id="newprs_id" name="newprs_id" value="{{$prs->newprs_id}}">
                                <?php 
                                $newprs_id = $po->newprs_id
                                ?>   
                                <?php 
                                $newpos_id = $po->newpos_id
                                ?>   


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
                                    <input type="text" class="form-control" name="po_status" id="po_status" value="{{$po->po_status}}"  readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="po_alias" class="control-label text-left col-md-3">PO NUMBER</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="po_alias" id="po_alias" value="{{$po->po_alias}} "  readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="po_date" class="control-label text-left col-md-3">PO DATE</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="po_date" id="po_date" value="{{$po->po_date}} " readonly >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="top" class="control-label text-left col-md-3">TERM OF PAYMENT</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="top" id="top" value="{{$po->top}} " readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="delivery_point" class="control-label text-left col-md-3">DELIVERY POINT</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="delivery_point" id="delivery_point" value="{{$po->delivery_point}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="suppliers_id" class="control-label text-left col-md-3">SUPPLIER</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="suppliers_id" id="suppliers_id" value="{{$po->suppliers_id}}" readonly>

                                    {{-- <select class="select2 form-control custom-select" name="suppliers_id" id="suppliers_id"  style="width: 100%; height:36px;" required>
                                        
                                        <option value="{{$po->suppliers_id}}" selected>{{$po->suppliers_id}}</option>
                                        @foreach ($suppliers as $item)
                                        <option value="{{$item->suppliers_name}}"> {{$item->suppliers_name}}</option>
                                        @endforeach
                                    </select>  --}}

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cost_code" class="control-label text-left col-md-3">COST CODE</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="cost_code" id="cost_code" value="{{$po->cost_code}}" readonly>

                                    {{-- <select class="select2 form-control custom-select" name="cost_code" id="cost_code"  style="width: 100%; height:36px;" required>
                                        
                                        <option value="{{$po->cost_code}}" selected>{{$po->cost_code}}</option>

                                        @foreach ($vehicles_model as $item)
                                        <option value="{{$item->vehiclemodels_name}}"> {{$item->vehiclemodels_name}}</option>
                                        @endforeach
                                    </select>  --}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="po_remarks" class="control-label text-left col-md-3">PO REMARKS</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="po_remarks" id="po_remarks" value="{{$po->po_remarks}} " readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ppn" class="control-label text-left col-md-3">PPN</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="po_ppn" id="po_ppn" value="{{$po->po_ppn}}" readonly>

                                    {{-- <select name="po_ppn" id="po_ppn" class="select2 form-control custom-select col-md-10" style="width: 100%; height:36px;" required>
                                        <option value="{{$po->po_ppn}}" selected>{{$po->po_ppn}}</option>
                                        
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select> --}}
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
                                    <th>TOTAL PRICE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($podetails as $podetail)
                                {{-- {{App\Newpr;}} --}}
                                <?php 
                                $prqty = App\Newprdetail::where('newprs_id',$podetail->newprs_id)->where('spareparts_id',$podetail->spareparts_id)->sum('pr_qty'); 
                                $poqty = App\Newpodetail::where('newprs_id',$podetail->newprs_id)->where('spareparts_id',$podetail->spareparts_id)->sum('po_qty'); 
                                $gap = $prqty-$poqty; 
                                ?>
                                <td>{{++$no}}</td>
                                <td>{{$podetail->part_number}}</td>
                                <td>{{$podetail->spareparts_name}}</td>
                                <td align="right">{{format_uang($podetail->po_qty)}}</td>
                                <td>{{$podetail->uom}}</td>
                                <td align="right">{{format_uang($podetail->po_price)}}</td>
                                <td align="right">{{format_uang($podetail->po_price*$podetail->po_qty)}}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2"><b>Sub Total</b></td>
                                    <td align="right"><strong>{{format_uang($totalpo)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>

                                        <td colspan="2">PPN</td>
                                        @if ($po->po_ppn == 'Yes')
                                            <td align="right">{{format_uang($totalpo*0.1)}} </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>

                                                <td colspan="2"><b>TOTAL</b></td>
                                                <td align="right">{{format_uang($totalpo+$totalpo*0.1)}}</td>
                                            </tr>
                                        @else
                                            <td align="right">{{format_uang($totalpo*0)}} </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>

                                                <td colspan="2"><b>TOTAL</b></td>
                                                <td align="right"><b>{{format_uang($totalpo+$totalpo*0)}}</b></td>
                                            </tr>
                                            
                                        @endif
                                    

                                
                            </tbody>
                        </table>
                    <div class="modal-footer">
                        

                        @if($po->po_status == 'Submit')
                                <a href="{{ route('printnewpo',$po->newpos_id) }}" target="_blank" class="btn btn-info"><i class="fa fa-print" aria-hidden="true">PRINT</i></a></i>

                                <a href="{{ route('editnewpo',$po->newpos_id) }}" class="btn btn-info"><i class="fa fa-edit" aria-hidden="true">EDIT</i></a></i>

                                <a href="{{ route('donenewpo',$po->newpos_id) }}" class="btn btn-info"><i class="fa fa-edit" aria-hidden="true">DONE</i></a></i>
                                <a href="{{ route('cancelnewpo',$po->newpos_id) }}" class="btn btn-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true">CANCEL</i></a></i>
                        
                        @else
                            
                        @endif   
                    
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>





@endsection

@section('script')

@endsection
