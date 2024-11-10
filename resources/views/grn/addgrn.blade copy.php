<div class="modal fade bs-example-modal-lg" id="grnModal" tabindex="-1" style="z-index: 999999 !important;" role="dialog"
    aria-labelledby="grnModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="grnModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="grnModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="grns_date" class="control-label">GRNS DATE</label>
                                <input type="text" class="form-control mydatepicker" id="grns_date" name="grns_date" value="{{old('grns_date')}}" required autocomplete="off">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                   			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="spareparts_id" class="control-label">SPAREPARTS ID</label>
                                <select class="select2 form-control custom-select" id="spareparts_id" name="spareparts_id" data-url="api/selectsparepart" data-value="" style="width: 100%; height:36px;" ></select>
                                
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="manufacture" class="control-label">MANUFACTURE</label>
                                <select class="select2 form-control custom-select" id="manufacture" name="manufacture" data-url="api/selectmanufacturer" data-value="" style="width: 100%; height:36px;" ></select>
                                
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
		
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="document" class="control-label">DOCUMENT</label>
                                <select class="select2 form-control custom-select" id="document" name="document" data-url="api/selectdoctype" data-value="" style="width: 100%; height:36px;" ></select>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="document_number" class="control-label">DOCUMENT NUMBER</label>
                                <input type="text" class="form-control" id="document_number" name="document_number" value="{{old('document_number')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>				
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="receipt_from" class="control-label">RECEIPT FROM</label>
                                <select class="select2 form-control custom-select" id="receipt_from" name="receipt_from" data-url="api/selectsupplier" data-value="" style="width: 100%; height:36px;" ></select>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="condition" class="control-label">CONDITION</label>
                                <input type="text" class="form-control" id="condition" name="condition" value="{{old('condition')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="qty" class="control-label">QTY</label>
                                <input type="text" class="form-control" id="qty" name="qty" value="{{old('qty')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="uom" class="control-label">UOM</label>
                                <input type="text" class="form-control" id="uom" name="uom" value="{{old('uom')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="remarks" class="control-label">REMARKS</label>
                                <input type="text" class="form-control" id="remarks" name="remarks" value="{{old('remarks')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="store_man" class="control-label">STORE MAN</label>
                                <select class="select2 form-control custom-select" id="store_man" name="store_man" data-url="api/selectemployee" data-value="" style="width: 100%; height:36px;" ></select>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>				
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="approved_by" class="control-label">APPROVED BY</label>
                                <select class="select2 form-control custom-select" id="approved_by" name="approved_by" data-url="api/selectemployee" data-value="" style="width: 100%; height:36px;" ></select>
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