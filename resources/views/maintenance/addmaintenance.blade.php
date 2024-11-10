<div class="modal fade bs-example-modal-lg" id="maintenanceModal" tabindex="-1" role="dialog"
    aria-labelledby="maintenanceModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="maintenanceModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="maintenanceModal" enctype="multipart/form-data" onsubmit="myButton.disabled = true; return true;" onchange="myButton.disabled = false; return false;">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" id="packages_ids" name="packages_ids">
                    <input type="hidden" id="vehicles_ids" name="vehicles_ids">
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">	
                                <label for="vehicles_id" class="control-label">NOMOR LAMBUNG</label>
                                <input type="text" class="form-control" id="vehicles_id" name="vehicles_id" value="{{old('packages_id')}}"  readonly>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="packages_id" class="control-label">PACKAGES ID</label>
                                <input type="text" class="form-control" id="packages_id" name="packages_id" value="{{old('packages_id')}}"  readonly>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="report_date" class="control-label">REPORT DATE</label>
                                <input type="text" class="form-control" id="report_date" name="report_date" value="{{old('report_date')}}"  readonly>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="last_km" class="control-label">LAST KM</label>
                                <input type="text" class="form-control" id="last_km" name="last_km" value="{{old('last_km')}}"  readonly>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="next_km" class="control-label">NEXT KM</label>
                                <input type="text" class="form-control" id="next_km" name="next_km" value="{{old('next_km')}}"  readonly>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="due_date" class="control-label">DUE DATE</label>
                                <input type="text" class="form-control" id="due_date" name="due_date" value="{{old('due_date')}}"  readonly>
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
                    {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
                    <button class="btn btn-primary btn-save" type="submit" name="myButton" value="Submit">Save to Draft</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span> </button>

                </div>
            </form>
        </div>
    </div>
</div>