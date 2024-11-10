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
                                    <input type="text" class="form-control" name="po_status" id="po_status" value="DRAFT"  readonly>
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
                                    <input type="text" class="form-control" name="top" id="top" value="{{$po->top}} " >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="delivery_point" class="control-label text-left col-md-3">DELIVERY POINT</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="delivery_point" id="delivery_point" value="{{$po->delivery_point}}" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="suppliers_id" class="control-label text-left col-md-3">SUPPLIER</label>
                                    <div class="col-md-9">
                                    <select class="select2 form-control custom-select" name="suppliers_id" id="suppliers_id"  style="width: 100%; height:36px;" required>
                                        
                                        <option value="{{$po->suppliers_id}}" selected>{{$po->suppliers_id}}</option>
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
                                        
                                        <option value="{{$po->cost_code}}" selected>{{$po->cost_code}}</option>

                                        @foreach ($vehicles_model as $item)
                                        <option value="{{$item->vehiclemodels_name}}"> {{$item->vehiclemodels_name}}</option>
                                        @endforeach
                                    </select> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="po_remarks" class="control-label text-left col-md-3">PO REMARKS</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="po_remarks" id="po_remarks" value="{{$po->po_remarks}} ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ppn" class="control-label text-left col-md-3">PPN</label>
                                    <div class="col-md-9">
                                    <select name="po_ppn" id="po_ppn" class="select2 form-control custom-select col-md-10" style="width: 100%; height:36px;" required>
                                        <option value="{{$po->po_ppn}}" selected>{{$po->po_ppn}}</option>
                                        
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
                                <td>
                                <div class="form-group row">
                                    <div class="controls">
                                    <input type="text" name="pr_qty_{{$podetail->newpodetails_id}}" id="pr_qty_{{$podetail->newpodetails_id}}" min="0" max="{{$podetail->po_qty+$gap}}" value="{{$podetail->po_qty}}" class="form-control" required data-validation-required-message="This field is required" autocomplete="off">
                                    </div>
                                </div>
                                    </td>
                                <td>{{$podetail->uom}}</td>
                                <td>
                                    <input type="text" name="po_price_{{$podetail->newpodetails_id}}" id="po_price_{{$podetail->newpodetails_id}}"  value="{{$podetail->po_price}}" class="form-control" required data-validation-required-message="This field is required" autocomplete="off">
                                </td>
                                <td>
                                <input type="hidden" class="form-control" name="spareparts_id_{{$podetail->newpodetails_id}}" id="spareparts_id_{{$podetail->newpodetails_id}}" value="{{$podetail->spareparts_id}}">
                                <input type="hidden" name="podetail[]" id="podetail[]" value="{{$podetail->newpodetails_id}}">
                                <a onClick="deleteData({{$podetail->newpodetails_id}})" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                
                                </td>
                                </tr>
                                    
                                @endforeach
                                <tr>
                                
                            </tbody>
                        </table>
                    <div class="modal-footer">
                        
                        @if ($po->po_status == 'DRAFT')
                        {{-- <i href="#" class="btn btn-info">Save to Draft</i></i> --}}

                        <button type="button" onclick="addpartForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Add Part
                        </button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('submitnewpo',$po->newpos_id) }}" class="btn btn-info">Submit</i></a>


                        @elseif($po->po_status == 'Submit')
                                <a href="{{ route('rejectnewpr',$po->newprs_id) }}" class="btn btn-danger">PRINT</a></i>
                                <a href="{{ route('rejectnewpr',$po->newprs_id) }}" class="btn btn-danger">Cancel</a></i>

                        
                        @else
                            
                        @endif   
                    
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>




@include('newpo.addpart')

@endsection

@section('script')
<script>

var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabeladdpart').DataTable({
            "processing": true,
            "serverside": true,
            "ajax": {
                "url": "{{route('addpopartdetaildata',['newprs_id'=>$newprs_id,'newpos_id'=>$newpos_id,'spareparts_id'])}}",
                // "url": "/dmmvehicle/addpopartdetaildata/$newpos_id",
                "type": "GET",
            }
        });
        // $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    });
    $(document).ready(function() {
    $('.select2').select2();
});

function addpartForm(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#addpartModal').modal('show');
        $('#addpartModal form')[0].reset();
        $('.modal-title').text('Tambah Part');
    }
function deleteData(id){
        if(confirm("Are you Sure?"+id)){
            $.ajax({
                url : "/dmmvehicle/newpodetail/"+id,
                type : "DELETE",
                data : {
                    'method' : 'DELETE',
                    "_token": "{{ csrf_token() }}"

                    },
                    success : function(data){
                         location.reload();
                    },
                    error : function(){
                        alert("Cannot Delete Data");
                    }
            });
        }
    }
</script>
@endsection
