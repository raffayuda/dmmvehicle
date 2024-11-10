@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Create PO</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">PO</a></li>
                    <li class="breadcrumb-item active">Create PO</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create PO</h4>

                    @if ($id == 'bikin')
                    <form action="{{ route('po.store') }}" class="form form-createpo" data-toggle="validator" method="post"
                        id="modal_form" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                    @else
                    <form action="{{ route('po.update',[$id]) }}" class="form-createpo" data-toggle="validator" method="post"
                        id="modal_form" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                    @endif
                    <input type="hidden" id="created_by" name="created_by" value="{{Auth::user()->name}}">
                    @if (empty($pr->po_status) OR $pr->po_status == 'Draft')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label text-left col-md-3" for="remarks" >REMARKS</label>
                                <div class="col-md-9">
                                {{-- <input type="text" class="form-control" name="remarks" id="remarks" onchange="this.form.submit()" {{$pr->remarks}} value="{{$pr->remarks}}"  > --}}
                                <input type="text" class="form-control" name="remarks" id="remarks" value="{{$pr->remarks}}" readonly  >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pr_alias" class="control-label text-left col-md-3">PR NUMBER</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="pr_alias" id="pr_alias" value="{{$pr->pr_alias}}"  readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pr_status" class="control-label text-left col-md-3">PO STATUS</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="pr_status" id="pr_status" value="{{$pr->po_status}}"  readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="po_alias" class="control-label text-left col-md-3">PO NUMBER</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="po_alias" id="po_alias" value="{{$pr->po_alias}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="po_date" class="control-label text-left col-md-3">PO DATE</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="po_date" id="po_date" value="{{$pr->po_date}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="po_top" class="control-label text-left col-md-3">TERM OF PAYMENT</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="po_top" id="po_top" value="{{$pr->po_top}}">
                                {{-- <input type="text" class="form-control" name="po_top" id="po_top" onchange="this.form.submit()" {{$pr->po_top}} value="{{$pr->po_top}}"  > --}}

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="po_delivery_instruction" class="control-label text-left col-md-3">DELIVERY POINT</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="po_delivery_instruction" id="po_delivery_instruction" value="{{$pr->po_delivery_instruction}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="suppliers_id" class="control-label text-left col-md-3">SUPPLIER</label>
                                <div class="col-md-9">
                                {{-- <select class="select2 form-control custom-select" id="suppliers_id" name="suppliers_id" data-url="/dmmvehicle/api/selectsupplier" data-value="{{$pr->suppliers_id}}" style="width: 100%; height:36px;" required>
                                </select> --}}
                                {{-- {{$supplier}} --}}
                                {{-- <input type="text" class="form-control" name="supplier_id" id="supplier_id" value="{{$pr->supplier_id}}" readonly> --}}
                                <select class="select2 form-control custom-select" name="suppliers_id" id="suppliers_id"  style="width: 100%; height:36px;" required>
                                        
                                    <option value="{{$pr->suppliers_id}}"> {{$pr->suppliers_id}}</option>
                                    @foreach ($supplier as $item)
                                    <option value="{{$item->suppliers_name}}"> {{$item->suppliers_name}}</option>
                                    @endforeach
                                
                                </select>    
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="cost_code" class="control-label text-left col-md-3">COST CODE</label>
                                <div class="col-md-9">
                                <select class="select2 form-control custom-select" id="cost_code" name="cost_code"  style="width: 100%; height:36px;" required>
                                    <option value="{{$pr->cost_code}}"> {{$pr->cost_code}}</option>
                                    @foreach ($vehicle as $item)
                                    <option value="{{$item->vehiclemodels_name}}"> {{$item->vehiclemodels_name}}</option>
                                    @endforeach                        
                                </select>
                                {{-- <input type="text" class="form-control" name="cost_code" id="cost_code" value="{{$pr->cost_code}}" readonly> --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="po_remarks" class="control-label text-left col-md-3">PO REMARKS</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="po_remarks" id="po_remarks" value="{{$pr->po_remarks}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="po_ppn" class="control-label text-left col-md-3">PPN</label>
                                <div class="col-md-9">
                                    <select name="po_ppn" id="po_ppn" class="select2 form-control custom-select col-md-10" required>
                                        <option value="{{$pr->po_ppn}}" selected>{{$pr->po_ppn}}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                {{-- <input type="text" class="form-control" name="ppn" id="ppn" value="{{$pr->po_remarks}}"> --}}
                                </div>
                            </div>
                        </div>	
                        		
                    </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update PO Info</button>
                            <a href="{{ route('rejectpo',$pr->prs_id) }}" class="btn btn-danger">Reject</i></a>


                        </div>    


                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label text-left col-md-3" for="remarks" >REMARKS</label>
                                <div class="col-md-9">
                                {{-- <input type="text" class="form-control" name="remarks" id="remarks" onchange="this.form.submit()" {{$pr->remarks}} value="{{$pr->remarks}}"  > --}}
                                <input type="text" class="form-control" name="remarks" id="remarks" value="{{$pr->remarks}}" readonly  >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pr_alias" class="control-label text-left col-md-3">PR NUMBER</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="pr_alias" id="pr_alias" value="{{$pr->pr_alias}}"  readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pr_status" class="control-label text-left col-md-3">PO STATUS</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="pr_status" id="pr_status" value="{{$pr->po_status}}"  readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="po_alias" class="control-label text-left col-md-3">PO NUMBER</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="po_alias" id="po_alias" value="{{$pr->po_alias}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="po_date" class="control-label text-left col-md-3">PO DATE</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="po_date" id="po_date" value="{{$pr->po_date}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="po_top" class="control-label text-left col-md-3">TERM OF PAYMENT</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="po_top" id="po_top" value="{{$pr->po_top}}" readonly>
                                {{-- <input type="text" class="form-control" name="po_top" id="po_top" onchange="this.form.submit()" {{$pr->po_top}} value="{{$pr->po_top}}"  > --}}

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="po_delivery_instruction" class="control-label text-left col-md-3">DELIVERY POINT</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="po_delivery_instruction" id="po_delivery_instruction" value="{{$pr->po_delivery_instruction}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="suppliers_id" class="control-label text-left col-md-3">SUPPLIER</label>
                                <div class="col-md-9">
                                {{-- <select class="select2 form-control custom-select" id="suppliers_id" name="suppliers_id" data-url="/dmmvehicle/api/selectsupplier" data-value="{{$pr->suppliers_id}}" style="width: 100%; height:36px;" required>
                                </select> --}}
                                {{-- {{$supplier}} --}}
                                <input type="text" class="form-control" name="supplier_id" id="supplier_id" value="{{$pr->suppliers_id}}" readonly>
                                {{-- <select class="select2 form-control custom-select" name="suppliers_id" id="suppliers_id"  style="width: 100%; height:36px;" required>
                                        
                                    <option value="{{$pr->suppliers_id}}"> {{$pr->suppliers_id}}</option>
                                    @foreach ($supplier as $item)
                                    <option value="{{$item->suppliers_name}}"> {{$item->suppliers_name}}</option>
                                    @endforeach
                                
                                </select>     --}}
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="cost_code" class="control-label text-left col-md-3">COST CODEsss</label>
                                <div class="col-md-9">
                                    
                                
                                <input type="text" class="form-control" name="cost_code" id="cost_code" value="{{$pr->cost_code}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="po_remarks" class="control-label text-left col-md-3">PO REMARKS</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="po_remarks" id="po_remarks" value="{{$pr->po_remarks}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="po_ppn" class="control-label text-left col-md-3">PPN</label>
                                <div class="col-md-9">
                                    <select name="po_ppn" id="po_ppn" class="select2 form-control custom-select col-md-10" required>
                                        <option value="{{$pr->po_ppn}}" selected>{{$pr->po_ppn}}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                {{-- <input type="text" class="form-control" name="ppn" id="ppn" value="{{$pr->po_remarks}}"> --}}
                                </div>
                            </div>
                        </div>	
                    </div>
                    @endif
                    
                    </form>

                    <form class="form-addpart">
                        {{csrf_field()}} {{@method_field('PATCH')}}
                        <table class="table table-striped tabel-partpo" id="tabel-partpo">
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
                            <tbody></tbody>
                            <tfoot>
                                                <tr>
                                                    <td colspan="5" align="right"></td>
                                                    <td><h4><b>SUB TOTAL</b></h4></td>
                                                    <td style="text-align:right;"><h4><b>{{format_uang($total)}}</b></td>
                                                </tr>
                                                @if ($pr->po_ppn == 'Yes')
                                                <tr>
                                                    <td colspan="5" align="right"></td>
                                                    <td><h4><b>PPN</b></h4></td>
                                                    <td style="text-align:right;"><h4><b>{{format_uang($total*0.1)}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" align="right"></td>
                                                    <td><h4><b>TOTAL</b></h4></td>
                                                    <td style="text-align:right;"><h4><b>{{format_uang($total+$total*0.1)}}</b></td>
                                                </tr>
                                                    
                                                @else
                                                <tr>
                                                    <td colspan="5" align="right"></td>
                                                    <td><h4><b>PPN</b></h4></td>
                                                    <td style="text-align:right;"><h4><b>{{format_uang($total*0)}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" align="right"></td>
                                                    <td><h4><b>TOTAL</b></h4></td>
                                                    <td style="text-align:right;"><h4><b>{{format_uang($total+$total*0)}}</b></td>
                                                </tr>
                                                    
                                                @endif
                                                
                            </tfoot>

                        </table>
                    </form>
                    <div class="modal-footer">
                    @if ($pr->po_status == 'Draft')
                        {{-- <i href="#" class="btn btn-info">Save to Draft</i></i> --}}
                        <button value="Refresh Page"  class="btn btn-info d-none d-lg-block m-l-15" onClick="window.location.reload();">Save to Draft</button>

                        <button value="Refresh Page"  class="btn btn-info d-none d-lg-block m-l-15" onClick="window.location.reload();">Update Total</button>

                        {{-- <button onclick="showPart()" class="btn btn-info d-none d-lg-block m-l-15">
                                        <i class="fa fa-plus-circle"></i> Add New Part
                                        </button> --}}
                        <a href="{{ route('submitpo',$id) }}" class="btn btn-info">Submit</i></a>

                    @elseif($pr->po_status == 'Submit')
                        <a href="{{ route('cancelpo',$id) }}" class="btn btn-info">Cancel</i></a>
                        <a href="{{ route('donepo',$id) }}" class="btn btn-info">PO Done</i></a>

                    
                    @elseif($pr->pr_status == 'Submit' and Auth::user()->approve_spr == 1)
                        <a href="{{ route('acknowledgepr',$id) }}" class="btn btn-info">Acknowledge</i></a>
                    @elseif($pr->pr_status == 'Acknowledge' and Auth::user()->approve_spr == 2)
                        <a href="{{ route('approvepr',$id) }}" class="btn btn-info">Approve</i></a>

                    @else

                    @endif    
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @include('pr.addpart') --}}

@endsection

@section('script')
<script type="text/javascript">
var table, save_method;
    // $(function () {
    //     table = $('#tabelpartpr').DataTable({
    //         "processing": true,
    //         "serverside": true,
    //         "ajax": {
    //             "url": "{{route('addpartdata',$id)}}",

    //             "type": "GET",
    //         }
    //     });
    // });

function showPart(){
    $('#addpartModal').modal('show');
    $('.modal-title').text('Add Part');
}

</script>
<script>
// CRUD Detail PR

var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabel-partpo').DataTable({
            "processing": true,
            "serverside": true,
            "searching": false,
            "paging":   false,
            "bInfo" : false,
            "bLengthChange": false,
            "ajax": {
                "url": "{{route('listdetailpo',$id)}}",
                "type": "GET",
            }
        });
        // $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    });
    
    //Menghapus data
    function deleteData(id){
        if(confirm("Are you Sure?")){
            $.ajax({
                url : "/dmmvehicle/prdetail/"+id,
                // url : "{{route('prdetail.update',$id)}}",
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
    function changeQty(id){
    $.ajax({
        url : "/dmmvehicle/prdetail/"+id,
        // url : "{{route('prdetail.update',$id) }}",
        type : "POST",
        data : $('.form-addpart').serialize(),
        success : function(data){
            table.ajax.reload();
        },
        error : function(){
            alert("Tidak dapat menyimpan data");
        }
    });
    
    }
    function changePrice(id){
    $.ajax({
        url : "/dmmvehicle/podetail/"+id,
        // url : "{{route('prdetail.update',$id) }}",
        type : "POST",
        data : $('.form-addpart').serialize(),
        success : function(data){
            table.ajax.reload();
        },
        error : function(){
            alert("Tidak dapat menyimpan data");
        }
    });
    
    }
$(document).ready(function() {
    $('.select2').select2();
});
</script>

@endsection