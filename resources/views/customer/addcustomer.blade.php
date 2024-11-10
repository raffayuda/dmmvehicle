<div class="modal fade bs-example-modal-lg" id="customerModal" tabindex="-1" role="dialog"
    aria-labelledby="customerModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="customerModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="customerModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="customers_name" class="control-label">CUSTOMERS NAME</label>
                                <input type="text" class="form-control" id="customers_name" name="customers_name" value="{{old('customers_name')}}" required>
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
                                <label for="email" class="control-label">EMAIL</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="contract_number" class="control-label">CONTRACT NUMBER</label>
                                <input type="text" class="form-control" id="contract_number" name="contract_number" value="{{old('contract_number')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="valid_until" class="control-label">VALID UNTIL</label>
                                <input type="text" class="form-control" id="valid_until" name="valid_until" value="{{old('valid_until')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="department" class="control-label">DEPARTMENT</label>
                                <input type="text" class="form-control" id="department" name="department" value="{{old('department')}}" required>
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