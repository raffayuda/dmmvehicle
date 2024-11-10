<div class="modal fade bs-example-modal-lg" id="employeeModal" tabindex="-1" role="dialog"
    aria-labelledby="employeeModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="employeeModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="employeeModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="id_number" class="control-label">ID NUMBER</label>
                                <input type="text" class="form-control" id="id_number" name="id_number" value="{{old('id_number')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                  		
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="employees_name" class="control-label">EMPLOYEES NAME</label>
                                <input type="text" class="form-control" id="employees_name" name="employees_name" value="{{old('employees_name')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="birth_date" class="control-label">BIRTH DATE</label>
                                <input type="text" class="form-control mydatepicker"  id="birth_date" name="birth_date" autocomplete="off">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="join_date" class="control-label">JOIN DATE</label>
                                <input type="text" class="form-control mydatepicker"  id="join_date" name="join_date" autocomplete="off">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
{{--                                 
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="skill" class="control-label">SKILL</label>
                                <input type="text" class="form-control" id="skill" name="skill" value="{{old('skill')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>	
                     --}}
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="skills_id" class="control-label">SKILL</label>
                                <select class="select2 form-control custom-select" id="skills_id" name="skills_id" data-url="api/selectskill" data-value="" style="width: 100%; height:36px;" ></select>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="position" class="control-label">POSITION</label>
                                <input type="text" class="form-control" id="position" name="position" value="{{old('position')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>
                    			
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="phone" class="control-label">PHONE</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    		
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="kimper" class="control-label">KIMPER</label>
                                <input type="text" class="form-control mydatepicker"  id="kimper" name="kimper" autocomplete="off">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="sim" class="control-label">SIM</label>
                                <input type="text" class="form-control mydatepicker"  id="sim" name="sim" autocomplete="off">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                   			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="status" class="control-label">STATUS</label>
                                <select class="select2 form-control custom-select" id="status" name="status" style="width: 100%; height:36px;">
                                    <option value="Active">Active</option>
                                    <option value="Resign">Resign</option>
                                </select>

                                {{-- <input type="text" class="form-control" id="status" name="status" value="{{old('status')}}" required> --}}
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