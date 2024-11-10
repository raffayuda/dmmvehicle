<div class="modal fade bs-example-modal-lg" id="requestedModal" tabindex="-1" role="dialog"
    aria-labelledby="requestedModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="requestedModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="requestedModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="requisitions_id" name="requisitions_id" value=" {{$lastInsertedId}} ">
                    
                    <input type="hidden" class="form-control" id="spr_alias" name="spr_alias" value="{{$status->spr_alias}}" readonly>
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                                                  
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                {{-- <label for="spareparts_id" class="control-label">SPAREPARTS ID</label>
                                <input type="text" class="form-control" id="spareparts_id" name="spareparts_id" value="{{old('spareparts_id')}}" required>
                                <span class="help-block with-errors"></span> --}}
                                <label for="spareparts_id" class="control-label">PART NUMBER</label>
                                <select class="select2 form-control custom-select" id="spareparts_id" name="spareparts_id" data-url="/dmmvehicle/api/selectsparepart" data-value="" style="width: 100%; height:36px;" >
                                
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    
                    
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="qty" class="control-label">QTY</label>
                                <input type="text" class="form-control" id="qty" name="qty" value="{{old('qty')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>	
	
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="procurement_method" class="control-label">PROCUREMENT METHOD</label>
                                <input type="text" class="form-control" id="procurement_method" name="procurement_method" value="{{$status->procurement_method}}" readonly>
                                <input type="hidden" class="form-control" id="remarks" name="remarks" value="{{$status->remarks}}" readonly>


                                {{-- <select class="form-control custom-select" id="procurement_method" name="procurement_method" required>
                                                        <option value="">--Select Method--</option>
                                                        <option value="PO">PO</option>
                                                        <option value="WO">WO</option>
                                                    </select> --}}


                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>	
                    {{-- <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="remarks" class="control-label">REMARKS</label>
                                <textarea name="remarks" id="remarks" class="form-control" rows="3"></textarea>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>	 --}}


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span> </button>

                </div>
            </form>
        </div>
    </div>
</div>