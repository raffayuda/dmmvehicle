@extends('layouts.main')
@section('title')
<title>VMM - workorder</title>
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
            <h4 class="text-themecolor">Create Work Order</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Work Order</a></li>
                    <li class="breadcrumb-item active">Create Workorder</li>
                </ol>
                {{-- <button onclick="addForm()" class="btn btn-info d-none d-lg-block m-l-15">
                                <i class="fa fa-plus-circle"></i> Create New
                            </button>
                            {{ csrf_field() }} --}}
            </div>
        </div>
    </div>
    {{-- <form id="form-produk" method="post">
        @csrf
        <input type="hidden" id="id" name="id" value={{$id}}>

    </form> --}}
      
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <form action="#" class="form-horizontal"> --}}
                    <form action="{{ route('savewo') }}"  class="form-horizontal" data-toggle="validator" method="post" id="modal_form" name="modal_form" enctype="multipart/form-data">
                    {{ csrf_field() }} {{ method_field('POST') }}    
                    <input type="hidden" id="id" name="id" value={{$id}}>
                    <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="schedule_date" class="control-label text-right col-md-3">SCHEDULE</label>
                                <div class="col-md-9">
                                <input id="schedule_date" name="schedule_date" type="text" class="form-control" value="{{$workorder->schedule_date}} " readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="odo" class="control-label text-right col-md-3">ODO</label>
                                <div class="col-md-9">
                                <input id="odo" name="odo" type="number"  class="form-control" value="{{$workorder->odo}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="wo_date" class="control-label text-right col-md-3">WO DATE</label>
                                <div class="col-md-9">
                                <input type="text" class="form-control mydatepicker" id="wo_date" name="wo_date" value="{{$workorder->wo_date}}" required autocomplete="off">

                                {{-- <input type="text" id="wo_date" name="wo_date" class="form-control" value=" {{$workorder->wo_date}} "> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="time" class="control-label text-right col-md-3">TIME</label>
                                <div class="col-md-9">
                                        <input class="form-control" id="time" name="time" placeholder="Select time" value=" {{$workorder->time}} ">

                                </div>
                            </div>
                        </div>
                    </div>
                        {{-- <div class="col-md-6">
                                        <label for="time" class="control-label text-right col-md-3">TIME</label>
                                        <div class="col-md-9">

                                        <input class="form-control" id="time" placeholder="Select time">
                                        </div>
                                        
                                    </div>
                    </div> --}}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nomor_lambung" class="control-label text-right col-md-3">NOMOR LAMBUNG</label>
                                <div class="col-md-9">
                                <input id="nomor_lambung" name="nomor_lambung" type="text" class="form-control" value=" {{$workorder->nomor_lambung}} " readonly>

                                <input id="vehicles_id" name="vehicles_id" type="hidden" class="form-control" value=" {{$workorder->vehicles_id}} ">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="location" class="control-label text-right col-md-3">LOCATION</label>
                                <div class="col-md-9">
                                <input type="text" id="location" name="location" class="form-control" value=" {{$workorder->location}} ">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="note" class="control-label text-right col-md-3">NOTE</label>
                                <div class="col-md-9">
                                <input id="note" name="note" type="text" class="form-control" value=" {{$workorder->note}} ">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="mechanic" class="control-label text-right col-md-3">MECHANIC</label>
                                <div class="col-md-9">
                                    <select class="form-control select2 col-md-10" id="mechanic" name="mechanic" data-url="/dmmvehicle/api/selectmechanic" data-value="">
                                    <option selected value="{{$workorder->mechanic}}">{{$workorder->mechanic}}</option>
                                    </select>
                                
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="leading_head" class="control-label text-right col-md-3">LEADING HEAD</label>
                                <div class="col-md-9">
                                    <select class="form-control select2 col-md-10" id="leading_head" name="leading_head" data-url="/dmmvehicle/api/selectleadinghead" data-value="">
                                    <option selected value="{{$workorder->leading_head}}">{{$workorder->leading_head}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="coordinator" class="control-label text-right col-md-3">COORDINATOR</label>
                                <div class="col-md-9">
                                    <select class="form-control select2 col-md-10" id="coordinator" name="coordinator" data-url="/dmmvehicle/api/selectkoordinator" data-value="">
                                    <option selected value="{{$workorder->coordinator}}">{{$workorder->coordinator}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    		
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="status" class="control-label text-right col-md-3">STATUS</label>
                                <div class="col-md-9">
                                <input id="status" name="status" type="text" class="form-control" value=" {{$workorder->status}} " disabled>

                                    {{-- <select class="form-control select2" id="status" name="status">
                                        <option value="{{$workorder->status}}" selected>{{$workorder->status}}</option>
                                                        <option value="In Progress">In Progress</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Close">Close</option>
                                    </select> --}}
                                
                                
                                
                                {{-- <input id="status" name="status" type="text" class="form-control" value=" {{$workorder->status}} "> --}}
                                </div>
                            </div>
                        </div>
                    </div>            
                </div>
                <div class="modal-footer">
                    @if ($workorder->status == 'Scheduled')

                    <button type="submit" class="btn btn-primary">Save</button>
                    @endif

                    {{-- <button type="submit" class="btn btn-success">Print</button> --}}
                {{-- </div> --}}
            </form>
                {{-- <div class="modal-footer"> --}}
                    {{-- WO Status --}}
                    {{-- {{ $workorder->status }} --}}
                    @if ($workorder->status == 'Created')
                    <button type="submit" class="btn btn-primary">Save</button>

                    <a href="/dmmvehicle/printwo/{{$id}}" target="_blank" class="btn btn-info"><i class="fa fa-print">Print</i></a>
                    <a href="/dmmvehicle/inprogress/{{$id}}" class="btn btn-info">In Progress</i></a>
                        
                    @elseif ($workorder->status == 'In Progress')
                    <button type="submit" class="btn btn-primary">Save</button>

                    <a href="/dmmvehicle/printwo/{{$id}}" target="_blank" class="btn btn-info"><i class="fa fa-print">Print</i></a>
                    <a href="/dmmvehicle/pending/{{$id}}" class="btn btn-primary">Pending</i></a>
                    <a href="/dmmvehicle/wodone/{{$id}}" class="btn btn-success">Done</i></a>
                    @elseif ($workorder->status == 'Pending')
                    <a href="/dmmvehicle/printwo/{{$id}}" target="_blank" class="btn btn-info"><i class="fa fa-print">Print</i></a>
                    <a href="/dmmvehicle/inprogress/{{$id}}" class="btn btn-info">In Progress</i></a>
                    @elseif ($workorder->status == 'Done')

                        
                    @endif
                    

                  
                    

                </div>
            
                <div class="card-body">
                    <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <h4 class="card-title">Work Package</h4>
                            </div>
                            @if ($workorder->status != 'Done')
                            
                            <div class="col-md-6 align-self-center text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                <button onclick="addFormPackage()" class="btn btn-info d-none d-lg-block m-l-15">
                                    <i class="fa fa-plus-circle"></i> Add Package
                                </button>
                                </div>
                            </div>
                            @endif
                    </div>
                    <div class="table-responsive m-t-40">
                        <table id="tabelworkorderpackage" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NOMOR LAMBUNG</th>
                                    <th>PACKAGE NAME</th>
                                    <th>SCHEDULE DATE</th>
                                    <th>ODO</th>
                                    <th>PROBLEM</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tfoot>

                            </tfoot>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            
                <div class="card-body">
                    <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <h4 class="card-title">Material and Part</h4>
                            </div>  
                            @if ($workorder->status != 'Done')
                                
                            <div class="col-md-6 align-self-center text-right">
                                <div class="d-flex justify-content-end align-items-center">
                                <button onclick="addFormPart()" class="btn btn-info d-none d-lg-block m-l-15">
                                    <i class="fa fa-plus-circle"></i> Add Material and Part
                                </button>
                                </div>
                            </div>
                            @endif

                    </div>
                    
                    <div class="table-responsive m-t-40">
                        <table id="tabelpartpackageselect" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>PART NUMBER</th>
                                    <th>PART NAME</th>
                                    <th>QTY</th>
                                    <TH>STOCK</TH>
                                    <th>UoM</th>
                                    <th>Add By</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tfoot>

                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>


{{-- @include('workorder.addworkorder') --}}
@include('workorder.addworkorderpackage')
@include('workorder.addworkorderpart')
@include('workorder.workorderpartedit')
{{-- @include('workorder.addinprogress') --}}
{{-- @include('workorder.inprogress') --}}
@endsection
@section('script')
<script>
    var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelworkorderpackage').DataTable({
            "processing": true,
            "serverside": true,
            "searching": false,
            "paging":   false,
            
            "ajax": {
                "url": "{{route('listworkorderpackage',$id)}}",
                "type": "GET",
            }
        });
        
        table = $('#tabelworkorderpackageselect').DataTable({
            "processing": true,
            "serverside": true,
            "searching": false,
            "paging":   false,
            
            "ajax": {
                "url": "{{route('listworkorderpackageselect',[$workorder->vehicles_id,$workorder->workorders_id])}}",
                "type": "GET",
            }
        });

        table = $('#tabelpartpackageselect').DataTable({
            "processing": true,
            "serverside": true,
            "searching": false,
            "paging":   false,
            
            "ajax": {
                "url": "{{route('listpartpackageselect',$id)}}",
                "type": "GET",
            }
        });
        table = $('#tabelpartpackage').DataTable({
            "processing": true,
            "serverside": true,
            // "searching": false,
            "paging":   false,
            
            "ajax": {
                "url": "{{route('listpartpackage',$id)}}",
                "type": "GET",
            }
        });
        //Menyimpan data 
        $('#workorderModal form').on('submit', function (e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                if (save_method == "add") url = "{{route('workorder.store') }}";
                else url = "workorder/"+id;

                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#workorderModal form').serialize(),
                    success: function (data) {
                        $('#workorderModal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function () {
                        alert("Cannot Save Data");
                    }
                });
                return false;
            }
        });
        
    });
    //Menampilkan form tambah
    function addFormPackage() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#workorderpackageModal').modal('show');
        $('#workorderpackageModal form')[0].reset();
        $('.modal-title').text('Add Related Package');
    }
    function addFormPart() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#workorderpartModal').modal('show');
        $('#workorderpartModal form')[0].reset();
        $('.modal-title').text('Add Part Needed');
    }
    // function updateInProgress() {
    //     save_method = "add";
    //     $('input[name=_method]').val('POST');
    //     $('#inprogressModal').modal('show');
    //     $('#inprogressModal form')[0].reset();
    //     $('.modal-title').text('Update In Progress');
    // }
    
    //Menampilkan data form Edit
    function editForm(id) {
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#workorderModal form')[0].reset();
        $.ajax({
            url: "workorder/" + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#workorderModal').modal('show');
                $('.modal-title').text('Edit workorder');

                $('#id').val(data.workorders_id);

            },
            error: function () {
                alert("Cannot Show Data");
            }
        });
    }
    
    // function updateInProgress(id) {
    //     save_method = "edit";
    //     $('input[name=_method]').val('PATCH');
    //     $('#inprogressModal form')[0].reset();
    //     $.ajax({
    //         url: "{{route('manufacturer.edit',$id)}}",

    //         type: "GET",
    //         dataType: "JSON",
    //         success: function (data) {
    //             $('#inprogressModal').modal('show');
    //             $('.modal-title').text('Edit WO Status');

    //             // $('#id').val(data.workorders_id);

    //         },
    //         error: function () {
    //             alert("Cannot Show Data");
    //         }
    //     });
    // }
    //Menampilkan data form PartWO
    function editFormpart(id) {
        console.log('andi');
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        // $('#workorderpartModalku form')[0].reset();
        $.ajax({
            url: "/dmmvehicle/partpackage/" + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#workorderpartModalku').modal('show');
                $('.modal-title').text('Edit workorder');

                $('#id').val(data.workorders_id);

            },
            error: function () {
                alert("Cannot Show Data");
            }
        });
    }
    
    //Menghapus data
    function deleteData(id) {
        if (confirm("Are you Sure?")) {
            $.ajax({
                url: "workorder/" + id,
                type: "DELETE",
                data: {
                    'method': 'DELETE',
                    "_token": "{{ csrf_token() }}"

                },
                success: function (data) {
                    table.ajax.reload();
                },
                error: function () {
                    alert("Cannot Delete Data");
                }
            });
        }
    }
    //Menghapus data
    function deleteDatapart(id){
        if(confirm("Are you Sure?")){
            $.ajax({
                url : "/dmmvehicle/partpackage/"+id,
                type : "DELETE",
                data : {
                    'method' : 'DELETE',
                    "_token": "{{ csrf_token() }}"

                    },
                    success : function(data){
                        // table.ajax.reload();
                        window.location.reload();
                    },
                    error : function(){
                        alert("Cannot Delete Data");
                    }
            });
        }
    }
    function printWo(id){
            
                $('#form-produk').attr('target','blank').attr('action',"printwo").submit();
        }

</script>

<script>

function CustomInitSelect2(element, options) {
            if (options.url) {
                $.ajax({
                    type: 'GET',
                    url: options.url,
                    dataType: 'json'
                }).then(function (data) {
                    element.select2({
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
<script>
    $(function () {
        $('.mydatepicker, #datepicker').datepicker({
                autoclose: true,
                showTime: false,
                format: 'yyyy-mm-dd',
                todayHighlight: true
            })


    });
$('#time').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
</script>
@endsection
