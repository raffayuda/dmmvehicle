<div class="modal fade bs-example-modal-lg" id="workorderModal" tabindex="-1" role="dialog"
    aria-labelledby="workorderModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="workorderModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="workorderModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- <input type="hidden" id="packages_ids" name="packages_ids"> --}}
                    {{-- <input type="hidden" id="vehicles_ids" name="vehicles_ids"> --}}
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">	
                                <label for="vehicles_id" class="control-label">NOMOR LAMBUNG</label>
                                <select class="select2 form-control custom-select" id="vehicles_id" name="vehicles_id" data-url="api/selectvehicle" data-value="" style="width: 100%; height:36px;" required>
                                <option id="" value="" selected="selected">--Select--</option>
                                
                                </select>
                                {{-- <input type="text" class="form-control" id="vehicles_id" name="vehicles_id" value="{{old('packages_id')}}" required> --}}
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="packages_id" class="control-label">PACKAGES TYPE</label>
                                <input type="text" class="form-control" id="packages_id" name="packages_id" value="Robbing" required readonly>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>			
                       		
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="schedule_date" class="control-label">SCHEDULE DATE</label>
                                <input type="text" class="form-control mydatepicker"  id="schedule_date" name="schedule_date" autocomplete="off">

                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="problem" class="control-label">PROBLEM</label>
                                <textarea class="form-control" rows="5" id="problem" name="problem" value="{{old('problem')}}" required></textarea>

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