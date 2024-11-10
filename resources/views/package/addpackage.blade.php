<div class="modal fade bs-example-modal-lg" id="packageModal" tabindex="-1" role="dialog"
    aria-labelledby="packageModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="packageModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="packageModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                                                  
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="packages_name" class="control-label">PACKAGES NAME</label>
                                <input type="text" class="form-control" id="packages_name" name="packages_name" value="{{old('packages_name')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="vehiclemodels_id" class="control-label">VEHICLEMODELS</label>
                                <select class="select2 form-control custom-select" id="vehiclemodels_id" name="vehiclemodels_id" data-url="api/selectvehiclemodel" data-value="" style="width: 100%; height:36px;" ></select>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>
                    
                    
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="maintenance_type" class="control-label">MAINTENANCE TYPE</label>

                                <select class="select2 form-control custom-select" id="maintenance_type" name="maintenance_type" data-url="api/selectpackagetype" data-value="" style="width: 100%; height:36px;" ></select>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="km" class="control-label">KM</label>
                                <input type="text" class="form-control" id="km" name="km" value="{{old('km')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="day" class="control-label">DAY</label>
                                <input type="text" class="form-control" id="day" name="day" value="{{old('day')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="next_packages_id" class="control-label">NEXT PACKAGES</label>
                                <select class="select2 form-control custom-select" id="next_packages_id" name="next_packages_id" data-url="api/selectpackage" data-value="" style="width: 100%; height:36px;" ></select>

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