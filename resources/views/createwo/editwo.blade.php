@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Create Maintance Program</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Maintenance</a></li>
                    <li class="breadcrumb-item active">Create Maintenance Program</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Maintenance Program</h4>

                    @if ($id == 'bikin')
                    <form action="{{ route('createwo.store') }}" class="form form-createpr" data-toggle="validator" method="post"
                        id="modal_form" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                    @else
                    <form action="{{ route('createwo.update',[$id]) }}" class="form-createpr" data-toggle="validator" method="post"
                        id="modal_form" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                    @endif
                    <input type="hidden" id="created_by" name="created_by" value="{{Auth::user()->name}}">
                    {{-- @if ($pr->pr_status == 'Draft') --}}
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <div class="form-group row">
                                <label class="control-label text-left col-md-3" for="nomor_lambung" >NOMOR LAMBUNG</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="nomor_lambung" id="nomor_lambung" onchange="this.form.submit()" {{$vehicle->nomor_lambung}} value="{{$pr->remarks}}"  >
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label for="nomor_lambung" class="control-label text-left col-md-3">NOMOR LAMBUNG</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="nomor_lambung" id="nomor_lambung" value="{{$vehicle->nomor_lambung}}"  readonly>
                                <input type="hidden" class="form-control" name="vehicles_id" id="vehicles_id" value="{{$vehicle->vehicles_id}}"  readonly>
                                <input type="hidden" class="form-control" name="created_by" id="created_by" value="{{Auth::user()->name}}"  readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="vehiclemodels_name" class="control-label text-left col-md-3">VEHICLE MODEL</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="vehiclemodels_name" id="vehiclemodels_name" value="{{$vehicle->vehiclemodels_name}}"  readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="preventive_maintenance" class="control-label text-left col-md-3"><b> PREVENTIVE MAINTENANCE</b></label>
                                <div class="col-md-9">
                                    <hr>
                                {{-- <input type="text" class="form-control" name="vehiclemodels_name" id="vehiclemodels_name" value="{{$vehicle->vehiclemodels_name}}"  readonly> --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="last_date_prev" class="control-label text-left col-md-3">LAST PREVENTIVE MAINTENANCE DATE</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control mydatepicker" id="last_date_prev" name="last_date_prev"  required autocomplete="off" required>

                                <input type="hidden" class="form-control" name="packages_id_prev" id="packages_id_prev" value="1" >

                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="routine" class="control-label text-left col-md-3"><b> ROUTINE MAINTENANCE</b></label>
                                <div class="col-md-9">
                                    <hr>
                                {{-- <input type="text" class="form-control" name="vehiclemodels_name" id="vehiclemodels_name" value="{{$vehicle->vehiclemodels_name}}"  readonly> --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="packages_id" class="control-label text-left col-md-3">LAST MAINTENANCE PACKAGE</label>
                                <div class="col-md-9">
                                <select class="select2 form-control custom-select" id="packages_id" name="packages_id"  style="width: 100%; height:36px;" required>
                                    <option value=""> --Select Routine Package--</option>
                                    @foreach ($package as $item)
                                    <option value="{{$item->packages_id}}"> {{$item->packages_name}}</option>
                                    @endforeach                        
                                </select>
                                {{-- <input type="text" class="form-control" name="packages_id" id="packages_id" > --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="last_km" class="control-label text-left col-md-3">LAST SERVICE KM</label>
                                <div class="col-md-9">
                                <input type="number" class="form-control" name="last_km" id="last_km" >
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="next_km" class="control-label text-left col-md-3">NEXT SERVICE KM</label>
                                <div class="col-md-9">
                                <input type="number" class="form-control" name="next_km" id="next_km" >
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label for="due_date" class="control-label text-left col-md-3">LAST SERVICE DATE</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control mydatepicker" id="last_date" name="last_date"  required autocomplete="off" required>

                                {{-- <input type="text" class="form-control mydatepicker" id="due_date" name="due_date"  required autocomplete="off" required> --}}

                                {{-- <input type="number" class="form-control" name="due_date" id="due_date" > --}}
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="pr_status" class="control-label text-left col-md-3">STATUS</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="pr_status" id="pr_status" value="{{$pr->pr_status}}"  readonly>
                                </div>
                            </div> --}}
                        </div>			
                    </div>  
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span> </button>

                    </div>  
                    {{-- @else --}}
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label text-left col-md-3" for="remarks" >REMARKS</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="remarks" id="remarks" value="{{$pr->remarks}}"  readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pr_alias" class="control-label text-left col-md-3">PR NUMBER</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="pr_alias" id="pr_alias" value="{{$pr->pr_alias}}"  readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pr_status" class="control-label text-left col-md-3">STATUS</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="pr_status" id="pr_status" value="{{$pr->pr_status}}"  readonly>
                                </div>
                            </div>
                        </div>			
                    </div>  --}}
                    {{-- @endif --}}
                    
                    </form>

                    {{-- <form class="form-addpart">
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
                    @if ($pr->pr_status == 'Draft')
                        <a href="#" class="btn btn-info">Save to Draft</i></a>

                        <button onclick="showPart()" class="btn btn-info d-none d-lg-block m-l-15">
                                        <i class="fa fa-plus-circle"></i> Add New Part
                                        </button>
                        <a href="{{ route('submitpr',$id) }}" class="btn btn-info">Submit</i></a>
                    @elseif($pr->pr_status == 'Submit' and Auth::user()->approve_spr == 1)
                        <a href="{{ route('acknowledgepr',$id) }}" class="btn btn-info">Acknowledge</i></a>
                            <a href="{{ route('rejectpr',$pr->prs_id) }}" class="btn btn-danger">Reject</i></a>

                    @elseif($pr->pr_status == 'Acknowledge' and Auth::user()->approve_spr == 2)
                        <a href="{{ route('approvepr',$id) }}" class="btn btn-info">Approve</i></a>
                        <a href="{{ route('rejectpr',$pr->prs_id) }}" class="btn btn-danger">Reject</i></a>


                    @else
                        
                    @endif     --}}
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pr.addpart')

@endsection

@section('script')
<script type="text/javascript">
var table, save_method;
    $(function () {
        table = $('#tabelpartpr').DataTable({
            "processing": true,
            "serverside": true,
            "ajax": {
                "url": "{{route('addpartdata',$id)}}",

                "type": "GET",
            }
        });
    });

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
        table = $('#tabel-partpr').DataTable({
            "processing": true,
            "serverside": true,
            "searching": false,
            "bLengthChange": false,
            "ajax": {
                "url": "{{route('listdetailpr',$id)}}",
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
    $(function () {
        $('.mydatepicker, #datepicker').datepicker({
                autoclose: true,
                showTime: false,
                format: 'yyyy-mm-dd',
                todayHighlight: true
            })
            
        //Money Euro
        // $('[autocomplete="off"]').inputmask();

    });
    $(document).ready(function() {
    $('.select2').select2();
    });
</script>
@endsection