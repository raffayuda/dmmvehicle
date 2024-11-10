<div class="modal fade bs-example-modal-lg" id="cobalagiModal" tabindex="-1" style="z-index: 999999 !important;" role="dialog"
    aria-labelledby="cobalagiModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="cobalagiModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="cobalagiModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="ida" name="ida">
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="cobaa" class="control-label">cobalagi</label>
                                <input type="text" class="form-control" id="cobaa" name="cobaa" value="{{old('cobalagi')}}" required autocomplete="off">
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