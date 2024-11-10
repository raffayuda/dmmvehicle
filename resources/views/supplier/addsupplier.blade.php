<div class="modal fade bs-example-modal-lg" id="supplierModal" tabindex="-1" role="dialog"
    aria-labelledby="supplierModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="supplierModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="supplierModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="suppliers_name" class="control-label">SUPPLIERS NAME</label>
                                <input type="text" class="form-control" id="suppliers_name" name="suppliers_name" value="{{old('suppliers_name')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="address" class="control-label">ADDRESS</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>
                    
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="owner" class="control-label">OWNER</label>
                                <input type="text" class="form-control" id="owner" name="owner" value="{{old('owner')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>	

                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="bank_account" class="control-label">BANK ACCOUNT</label>
                                <input type="text" class="form-control" id="bank_account" name="bank_account" value="{{old('bank_account')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>	
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="contact_person" class="control-label">CONTACT PERSON</label>
                                <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{old('contact_person')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="phone" class="control-label">PHONE</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>
                    
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="fax" class="control-label">FAX</label>
                                <input type="text" class="form-control" id="fax" name="fax" value="{{old('fax')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="email" class="control-label">EMAIL</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="vendor_of" class="control-label">VENDOR OF</label>
                                <input type="text" class="form-control" id="vendor_of" name="vendor_of" value="{{old('vendor_of')}}" required>
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