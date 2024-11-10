<div class="modal fade bs-example-modal-lg" id="requisitionModal" tabindex="-1" role="dialog"
    aria-labelledby="requisitionModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="requisitionModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="requisitionModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- <input type="hidden" id="requisitions_id" name="requisitions_id" value=" {{$lastInsertedId}} "> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">


                    

	
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="procurement_method" class="control-label">PROCUREMENT METHOD</label>

                                <select class="form-control custom-select" id="procurement_method" name="procurement_method" required>
                                                        <option value="">--Select Method--</option>
                                                        <option value="PO">PO</option>
                                                        <option value="WO">WO</option>
                                                    </select>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>	
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="remarks" class="control-label">REMARKS</label>
                                <textarea name="remarks" id="remarks" class="form-control" rows="3"></textarea>
                                {{-- <input type="text" class="form-control" id="remarks" name="remarks" value="{{old('remarks')}}"> --}}
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