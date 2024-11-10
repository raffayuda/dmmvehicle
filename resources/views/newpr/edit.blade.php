@extends('layouts.main')
@section('title')
    <title>VMM - PO</title>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Create PR</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Requisition</a></li>
                    <li class="breadcrumb-item active">Create PR</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create PR</h4>

                    @if ($id == 'bikin')
                    <form action="{{ route('newpr.store') }}" class="form form-createpr" data-toggle="validator" method="post"
                        id="modal_form" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                    @else
                    <form action="{{ route('newpr.update',[$id]) }}" class="form-createpr" data-toggle="validator" method="post"
                        id="modal_form" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                    @endif
                    <input type="hidden" id="created_by" name="created_by" value="{{Auth::user()->name}}">
                    @if ($pr->pr_status == 'DRAFT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label text-left col-md-3" for="pr_remarks" >REMARKS</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="pr_remarks" id="pr_remarks" onchange="this.form.submit()" {{$pr->remarks}} value="{{$pr->pr_remarks}}"  >
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
                    </div>    
                    @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label text-left col-md-3" for="remarks" >REMARKS</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control" name="pr_remarks" id="pr_remarks" value="{{$pr->pr_remarks}}"  readonly>
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
                    </div> 
                    @endif
                    
                    </form>

                    <form class="form-addpart">
                        {{csrf_field()}} {{@method_field('PATCH')}}
                        <table class="table table-striped tabel-prdetail" id="tabel-prdetail">
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
                    @if ($pr->pr_status == 'DRAFT')
                        {{-- <i href="#" class="btn btn-info">Save to Draft</i></i> --}}

                        <button onclick="showPart()" class="btn btn-info d-none d-lg-block m-l-15">
                                        <i class="fa fa-plus-circle"></i> Add New Part
                                        </button>
                        <a href="{{ route('submitnewpr',$id) }}" class="btn btn-info">Submit</i></a>
                    @elseif($pr->pr_status == 'Submit' and Auth::user()->approve_spr == 1)
                        <a href="{{ route('acknowledgenewpr',$id) }}" class="btn btn-info">Acknowledge</i></a>
                            <a href="{{ route('rejectnewpr',$pr->newprs_id) }}" class="btn btn-danger">Reject</a></i>

                    @elseif($pr->pr_status == 'Acknowledge' and Auth::user()->approve_spr == 2)
                        <a href="{{ route('approvenewpr',$id) }}" class="btn btn-info">Approve</i></a>
                        <a href="{{ route('rejectnewpr',$pr->newprs_id) }}" class="btn btn-danger">Reject</a></i>

                    @else
                        
                    @endif    
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('newpr.addpart')

@endsection

@section('script')
<script type="text/javascript">
var table, save_method;
    $(function () {
        table = $('#tabeladdprdetail').DataTable({
            "processing": true,
            "serverside": true,
            "ajax": {
                "url": "{{route('sparepartlist',$id)}}",

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
        table = $('#tabel-prdetail').DataTable({
            "processing": true,
            "serverside": true,
            "searching": false,
            "bLengthChange": false,
            "ajax": {
                "url": "{{route('newprdetaildata',$id)}}",
                "type": "GET",
            }
        });
        // $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');
    });
    
    //Menghapus data
    function deleteData(id){
        if(confirm("Are you Sure?")){
            $.ajax({
                url : "/dmmvehicle/newprdetail/"+id,
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
        url : "/dmmvehicle/newprdetail/"+id,
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
</script>
@endsection