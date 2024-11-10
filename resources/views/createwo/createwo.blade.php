@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Create Manual Work Order</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">WO</a></li>
                    <li class="breadcrumb-item active">Create Manual Work Order</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Manual WO (for New Vehicle)</h4>

                    @if ($id == 'bikin')
                    <form action="{{ route('pr.store') }}" class="form form-createpr" data-toggle="validator" method="post"
                        id="modal_form" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('POST') }}
                    @else
                    <form action="{{ route('pr.update',[$id]) }}" class="form-createpr" data-toggle="validator" method="post"
                        id="modal_form" enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                    @endif
                    <input type="hidden" id="created_by" name="created_by" value="{{Auth::user()->name}}">
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                {{-- <label for="spareparts_id" class="control-label">SPAREPARTS ID</label>
                                <input type="text" class="form-control" id="spareparts_id" name="spareparts_id" value="{{old('spareparts_id')}}" required>
                                <span class="help-block with-errors"></span> --}}
                                <label for="remarks" class="control-label">REMARKS</label>
                                <input type="text" class="form-control" name="remarks" id="remarks" onchange="this.form.submit()" >
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>


                    </form>

                    <form class="form-addpart">
                        {{csrf_field()}} {{@method_field('PATCH')}}
                        <table class="table table-striped tabel-part">
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

                    <button  class="btn btn-info d-none d-lg-block m-l-15">
                                        <i class="fa fa-plus-circle"></i> Save to Draft
                                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@include('pr.addpart')

@endsection

@section('script')
{{-- <script type="text/javascript">
var table, save_method;
    $(function () {
        // Menampilkan data dengan Datatables
        table = $('#tabelpartpr').DataTable({
            "processing": true,
            "serverside": true,
           
            "ajax": {
                "url": "{{route('addpart.data')}}",
                "type": "GET",
            }
        });


        //Menyimpan data 
        $('#packageModal form').on('submit',function(e){
            if(!e.isDefaultPrevented()){
                var id = $('#id').val();
                if(save_method == "add") url = "{{route('package.store') }}";
                else url = "package/"+id;
                $.ajax({
                    url : url,
                    type : "POST",
                    data : $('#packageModal form').serialize(),
                    success : function(data){
                        $('#packageModal').modal('hide');
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
        $('#packageModal').modal('show');
        $('#packageModal form')[0].reset();
        $('.modal-title').text('Tambah Package');
    }
    //Menampilkan data form Edit
    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#packageModal form')[0].reset();
        $.ajax({
            url : "package/"+id+"/edit",
            type : "GET",
            dataType : "JSON",
            success : function(data){
                $('#packageModal').modal('show');
                $('.modal-title').text('Edit Package');

                $('#id').val(data.packages_id);
                $('#packages_name').val(data.packages_name);
                $('#vehiclemodels_id').val(data.vehiclemodels_id).trigger('change');
                $('#maintenance_type').val(data.maintenance_type).trigger('change');
                $('#km').val(data.km);
                $('#day').val(data.day);
                $('#next_packages_id').val(data.next_packages_id).trigger('change');
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
                url : "package/"+id,
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






function showPart(){
    $('#addpartModal').modal('show');
    $('.modal-title').text('Add Part');
}
</script> --}}
@endsection