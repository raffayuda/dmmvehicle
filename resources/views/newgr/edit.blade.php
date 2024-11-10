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
                    <li class="breadcrumb-item active">Create GR</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create GR</h4>

                    <form action="{{ route('newgrdetail.updategrdetail',[$gr->newgrs_id]) }}" class="form form-createpr" data-toggle="validator" method="post"
                        id="modal_form" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                   
                        <input type="hidden" id="created_by" name="created_by" value="{{Auth::user()->name}}">
                        <input type="hidden" id="newpos_id" name="newpos_id" value="{{$pos->newpos_id}}">
                        <?php 
                                $newpos_id = $pos->newpos_id
                                ?>   
                                <?php 
                                $newgrs_id = $gr->newgrs_id
                                ?>   

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label text-left col-md-3" for="po_remarks" >PO REMARKS</label>
                                    <div class="col-md-9">
                                    {{-- <input type="text" class="form-control" name="remarks" id="remarks"> --}}
                                    <input type="text" class="form-control" name="po_remarks" id="po_remarks" value="{{$pos->po_remarks}}" readonly>

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
                                    <input type="text" class="form-control mydatepicker" name="gr_date" id="gr_date" value="{{$gr->gr_date}}" autocomplete="off"
                                    @if ($gr->gr_status == 'Submit')
                                    readonly
                                    @endif
                                    required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gr_remarks" class="control-label text-left col-md-3">GR REMARKS</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="gr_remarks" id="gr_remarks" value="{{$gr->gr_remarks}}"
                                    @if ($gr->gr_status == 'Submit')
                                    readonly
                                    @endif
                                    required>
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
                                @foreach ($grdetails as $grdetail)
                                {{-- {{App\Newpr;}} --}}
                                <?php 
                                $poqty = App\Newpodetail::where('newpos_id',$grdetail->newpos_id)->where('spareparts_id',$grdetail->spareparts_id)->where('po_status','Submit')->sum('po_qty'); 
                                $grqty = App\Newgrdetail::where('newpos_id',$grdetail->newpos_id)->where('spareparts_id',$grdetail->spareparts_id)->sum('gr_qty'); 
                                $gap = $poqty-$grqty; 
                               
                                ?>
                                <td>{{++$no}}</td>
                                <td>{{$grdetail->part_number}}</td>
                                <td>{{$grdetail->spareparts_name}}</td>
                                <td>
                                <div class="form-group row">
                                    <div class="controls">
                                    <input type="text" name="gr_qty_{{$grdetail->newgrdetails_id}}" id="gr_qty_{{$grdetail->newgrdetails_id}}" min="0" max="{{$grdetail->gr_qty+$gap}}" value="{{$grdetail->gr_qty}}" class="form-control" required data-validation-required-message="This field is required" autocomplete="off"
                        @if ($gr->gr_status == 'Submit')
                        readonly
                        @endif

                                    
                                    >
                                    </div>
                                </div>
                                    </td>
                                <td>{{$grdetail->uom}}</td>
                                
                                <td>
                                <input type="hidden" class="form-control" name="spareparts_id_{{$grdetail->newgrdetails_id}}" id="spareparts_id_{{$grdetail->newgrdetails_id}}" value="{{$grdetail->spareparts_id}}">
                                <input type="hidden" name="grdetail[]" id="grdetail[]" value="{{$grdetail->newgrdetails_id}}">
                        @if ($gr->gr_status == 'DRAFT')

                                <a onClick="deleteData({{$grdetail->newgrdetails_id}})" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        @endif   
                                
                                </td>
                                </tr>
                                    
                                @endforeach
                                <tr>
                                
                            </tbody>
                        </table>
                    <div class="modal-footer">
                        {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
                        @if ($gr->gr_status == 'DRAFT')
                        {{-- <i href="#" class="btn btn-info">Save to Draft</i></i> --}}

                        <button type="button" onclick="addpartForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Add Part
                        </button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('submitnewgr',$gr->newgrs_id) }}" class="btn btn-info">Submit</a>


                        @elseif($gr->gr_status == 'Submit')
                                {{-- <a href="{{ route('rejectnewpr',$po->newprs_id) }}" class="btn btn-danger">PRINT</a></i> --}}
                                {{-- <a href="{{ route('rejectnewpr',$po->newprs_id) }}" class="btn btn-danger">Cancel</a></i> --}}

                        
                        @else
                            
                        @endif   
                    
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>




@include('newgr.addpart')

@endsection

@section('script')
<script>

var table, save_method;
    // $(function () {
    //     // Menampilkan data dengan Datatables
    //     table = $('#tabelpodetail').DataTable({
    //         "processing": true,
    //         "serverside": true,
    //         dom: 'Bfrtip',
    //     buttons: [
    //         'copy', 'csv', 'excel'
    //     ],
    //         "ajax": {
    //             "url": "{{route('addpodetaildata')}}",
    //             "type": "GET",
    //         }
    //     });
    //     $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    // });
    // 
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabeladdpart').DataTable({
            "processing": true,
            "serverside": true,
            "ajax": {
                "url": "{{route('addgrpartdetaildata',['newpos_id'=>$newpos_id,'newgrs_id'=>$newgrs_id,'spareparts_id'])}}",
                // "url": "/dmmvehicle/addpopartdetaildata/$newpos_id",
                "type": "GET",
            }
        });
        // $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
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
function addpartForm(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#addpartModal').modal('show');
        $('#addpartModal form')[0].reset();
        $('.modal-title').text('Tambah Part');
    }
function deleteData(id){
        if(confirm("Are you Sure?")){
            $.ajax({
                url : "/dmmvehicle/newgrdetail/"+id,
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
