@extends('layouts.main')
@section('title')
<title>VMM - Workorder</title>
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
            <h4 class="text-themecolor">Create Purchase Order</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Purchase Order</a></li>
                    <li class="breadcrumb-item active">Create Purchase Order</li>
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
                                <h4 class="card-title">Purchase Order</h4>
                                {{-- <form data-toggle="validator" id="requestedModal" name="requestedModal" method="post" enctype="multipart/form-data">
                                 {{ csrf_field() }} {{ method_field('POST')}} --}}
                                    
                                <form action="{{ route('savepurchase') }}"  class="form-horizontal" data-toggle="validator" method="post" id="modal_form" enctype="multipart/form-data">
                                {{ csrf_field() }} {{ method_field('POST') }}    
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-left col-md-3" for="po_number" >PO Number</label>
                                                    <div class="col-md-9">
                                                        <input type="hidden" class="form-control" id="po_number" name="po_number" value="{{$po_number}}" readonly>
                                                        <input type="text" class="form-control" id="po_alias" name="po_alias" value="{{$po_alias}}" readonly>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-left col-md-3" for="po_date" >PO Date</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="po_date" name="po_date" value="{{$date}}" readonly>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-left col-md-3" for="po_date" >TERM OF PAYMENT</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="top" name="top" required>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-left col-md-3" for="delivery_point" >DELIVERY POINT/INSTRUCTION</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" id="delivery_point" name="delivery_point" required>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-left col-md-3" for="suppliers_id" >SUPPLIER</label>
                                                    <div class="col-md-9">
                                                        <select class="select2 form-control custom-select" id="suppliers_id" name="suppliers_id" data-url="/dmmvehicle/api/selectsupplier" data-value="" style="width: 100%; height:36px;" required>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-left col-md-3" for="po_date" >SPR NUMBER</label>
                                                    <div class="col-md-9">
                                                        <input type="hidden" class="form-control" id="requisitions_id" name="requisitions_id" value="{{$lastInsertedId}}" readonly>
                                                        <input type="text" class="form-control" id="spr_alias" name="spr_alias" value="{{$requisition->spr_alias}}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label class="control-label text-left col-md-3" for="cost_code" >COST CODE</label>
                                                    <div class="col-md-9">
                                                        <select class="select2 form-control custom-select" id="cost_code" name="cost_code" data-url="/dmmvehicle/api/selectvehiclemodel" data-value="" style="width: 100%; height:36px;" required>
                                                        
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <a href="{{ route('rejectpurchase',$lastInsertedId) }}" class="btn btn-danger">Reject</i></a>

                                        </div>
                                </form>

                                    <div class="table-responsive m-t-40">
                                        <table id="tabelrequested" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>PART NUMBER</th>
                                                    <th>DESCRIPTION</th>
                                                    <th>QTY</th>
                                                    <th>UNIT</th>
                                                    <th>UNIT PRICE</th>
                                                    <th>TOTAL PRICEsss</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                @foreach ($requesteds as $requested)
                                                    <tr>
                                                        {{-- <form method="POST" action="poprice/{{ $requested->requesteds_id }} "> --}}
                                                        {{-- @method('PATCH')
                                                        @csrf --}}
                                                        <td> {{++$no}} </td>
                                                        <td> {{$requested->part_number}} </td>
                                                        <td> {{$requested->spareparts_name}} </td>
                                                        <td align="right"> {{format_uang($requested->qty)}} </td>
                                                        <td> {{$requested->uom}} </td>

                                                        <td align="right"> {{format_uang($requested->price)}}

                                                        {{-- <input type="text" class="form-control" id="price[{{$requested->requesteds_id}}]" name="price[{{$requested->requesteds_id}}]" value="{{$requested->price}}"> --}}
                                                            {{-- <input type="text" class="form-control" name="price" id="price" onchange="this.form.submit()" {{$requested->price}} value="{{$requested->price}}" > --}}
                    
                                                        </td>
                                                        <td align="right"> {{format_uang($requested->qty*$requested->price)}} </td>
                                                        <input type="hidden" id="total" name="total" value="{{$total += $requested->qty*$requested->price}}">
                                                        {{-- </form>                        --}}
                                                    </tr>
                                                @endforeach
                                                
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" align="right"><h4><b>TOTAL</b></h4></td>
                                                    <td><h4><b>{{format_uang($total)}}</b></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>   
                                
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
</div>
{{-- @include('requisition.addrequisition') --}}
@endsection
@section('script')
{{-- <script>
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelrequested').DataTable({
            "processing": true,
            "serverside": true,
            "paging": false,
            "info": false, 
            dom: 'Bfrtip',
        buttons: [
        ],
            "ajax": {
                "url": "/dmmvehicle/api/requested/" + {{ $lastInsertedId}},
                "type": "GET",
            }
        });
        $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

        //Menyimpan data 
        $('#requestedModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('requested.store') }}";
                else url = "requested/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#requestedModal form').serialize(),
                    success : function(data){
                        $('#requestedModal').modal('hide');
                        table.ajax.reload();
                    },
                    error : function(){
                        alert("Cannot Save Data");
                    }
                });
                return false;
            }
        });
    });
    //Menampilkan form tambah
    function addForm(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#requestedModal').modal('show');
        $('#requestedModal form')[0].reset();
        $('.modal-title').text('Tambah requested');
    }
    //Menampilkan data form Edit
    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#requestedModal form')[0].reset();
        $.ajax({
            url : "requested/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#requestedModal').modal('show');
                $('.modal-title').text('Edit requested');

                $('#id').val(data.requesteds_id);
                $('#requesteds_name').val(data.requesteds_name);
                $('#vehiclemodels_id').val(data.vehiclemodels_id).trigger('change');
                $('#maintenance_type').val(data.maintenance_type).trigger('change');
                $('#km').val(data.km);
                $('#day').val(data.day);
                $('#next_requesteds_id').val(data.next_requesteds_id).trigger('change');
                $('#total').val(data.total);

            },
            error : function(){
                alert("Cannot Show Data");
            }
        });
    }
    //Menghapus data
    function deleteData(id){
        if(confirm("Are you Sure?")){
            $.ajax({
                url : "/dmmvehicle/requested/"+id,
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
</script> --}}

<script>
 function CustomInitSelect2(element, options) {
            if (options.url) {
                $.ajax({
                    type: 'GET',
                    url: options.url,
                    dataType: 'json'
                }).then(function (data) {
                    element.select2({
                        // dropdownParent: $("#requestedModal"),
                        data: data
                    });
                    if (options.initialValue) {
                        element.val(options.initialValue).trigger('change');
                    }
                });
            }
        }

        $('.select2').each(function (index, element) {
            var item = $(element);
            if (item.data('url')) {
                CustomInitSelect2(item, {
                    url: item.data('url'),
                    initialValue: item.data('value')
                });
            }
            else {
                item.select2();
            }
        });


</script>


<script type="text/javascript">
    $('#read-data').on('click',function(){
        $.get(" {{URL::to('api/requested/1')}} ",function(data){
            console.log(data);
        })
    })
</script>

@endsection