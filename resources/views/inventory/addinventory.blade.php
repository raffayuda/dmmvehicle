<div class="modal fade bs-example-modal-lg" id="manufacturerModal" tabindex="-1" role="dialog"
    aria-labelledby="manufacturerModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="manufacturerModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="manufacturerModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="manufacturers_name" class="control-label">MANUFACTURERS NAME</label>
                                <input type="text" class="form-control" id="manufacturers_name" name="manufacturers_name" value="{{old('manufacturers_name')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="manufacturers_address" class="control-label">MANUFACTURERS ADDRESS</label>
                                <input type="text" class="form-control" id="manufacturers_address" name="manufacturers_address" value="{{old('manufacturers_address')}}" required>
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


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span> </button>

                </div>
            </form>
        </div>
    </div>
</div>