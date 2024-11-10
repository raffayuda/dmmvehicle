@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Create GR</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">GR</a></li>
                    <li class="breadcrumb-item active">Create GRse</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create GR</h4>
                    <form action="{{ route('newgrdetail.store') }}" class="form form-createpr" data-toggle="validator" method="post"
                        id="modal_form" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                   
                        <input type="hidden" id="created_by" name="created_by" value="{{Auth::user()->name}}">
                        <input type="hidden" id="newpos_id" name="newpos_id" value="{{$pos->newpos_id}}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label text-left col-md-3" for="pr_remarks" >PO REMARKS</label>
                                    <div class="col-md-9">
                                    {{-- <input type="text" class="form-control" name="remarks" id="remarks"> --}}
                                    <input type="text" class="form-control" name="pr_remarks" id="pr_remarks" value="{{$pos->po_remarks}}" readonly>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="po_alias" class="control-label text-left col-md-3">PO NUMBER</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="po_alias" id="po_alias" value="{{$pos->po_alias}}"  readonly>
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group row">
                                    <label for="po_date" class="control-label text-left col-md-3">PO DATE</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="po_date" id="po_date" value="{{$pos->po_date}}" readonly >
                                    </div>
                                </div>
                               

                                <div class="form-group row">
                                    <label for="delivery_point" class="control-label text-left col-md-3">DELIVERY POINT</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="delivery_point" id="delivery_point" value="{{$pos->delivery_point}}" readonly>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="suppliers_id" class="control-label text-left col-md-3">SUPPLIER</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="suppliers_id" id="suppliers_id" value="{{$pos->suppliers_id}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gr_date" class="control-label text-left col-md-3">GR DATE</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control mydatepicker" name="gr_date" id="gr_date" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gr_remarks" class="control-label text-left col-md-3">GR REMARKS</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="gr_remarks" id="gr_remarks" required>
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
                                    <th width="100">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($podetails as $podetail)

                                <?php 
                                // $prqty = App\Newprdetail::where('newprs_id',$podetail->newprs_id)->where('spareparts_id',$podetail->spareparts_id)->sum('pr_qty'); 
                                $poqty = App\Newpodetail::where('newpos_id',$podetail->newpos_id)->where('spareparts_id',$podetail->spareparts_id)->where('po_status','Submit')->sum('po_qty'); 
                                $grqty = App\Newgrdetail::where('newpos_id',$podetail->newpos_id)->where('spareparts_id',$podetail->spareparts_id)->sum('gr_qty'); 
                                $gap = $poqty-$grqty; 
                                ?>
                                @if ($gap <= 0)
                                    
                                @else
                                    
                                <td>{{++$no}}</td>
                                <td>{{$podetail->part_number}}</td>
                                <td>{{$podetail->spareparts_name}}</td>
                                <td>
                                <div class="form-group row">
                                    <div class="controls">
                                    <input type="text" name="po_qty_{{$podetail->newpodetails_id}}" id="po_qty_{{$podetail->newpodetails_id}}" min="0" max="{{$gap}}" value="{{$gap}}" class="form-control" required data-validation-required-message="This field is required" autocomplete="off">
                                    </div>
                                </div>
                                    </td>
                                <td>{{$podetail->uom}}</td>
                                <td>
                                <input type="hidden" class="form-control" name="spareparts_id_{{$podetail->newpodetails_id}}" id="spareparts_id_{{$podetail->newpodetails_id}}" value="{{$podetail->spareparts_id}}">
                                <input type="checkbox" name="grdetail[]" id="grdetail[]" value="{{$podetail->newpodetails_id}}"></td>
                                </tr>
                                @endif
                                    
                                @endforeach
                                <tr>
                                
                            </tbody>
                        </table>
                    <div class="modal-footer">
                        
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

$(function () {
        $('.mydatepicker, #datepicker').datepicker({
                autoclose: true,
                showTime: false,
                format: 'yyyy-mm-dd',
                todayHighlight: true
            })
            
       

    });
</script>
@endsection
