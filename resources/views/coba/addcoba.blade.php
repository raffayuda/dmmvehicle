<div class="modal fade bs-example-modal-lg" id="cobaModal" tabindex="-1" style="z-index: 999999 !important;" role="dialog"
    aria-labelledby="cobaModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="cobaModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="cobaModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="coba" class="control-label">COBA</label>
                                <input type="text" class="form-control" id="coba" name="coba" value="{{old('coba')}}" required autocomplete="off">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                   			
                       	
                    </div>			
                                

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span> </button>

                </div>
            </form>
        </div>
    </div>
</div>