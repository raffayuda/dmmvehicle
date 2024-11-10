<div class="modal fade bs-example-modal-lg" id="dailyModal" tabindex="-1" role="dialog"
    aria-labelledby="dailyModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="dailyModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="dailyModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="vehicles_id" class="control-label">NOMOR LAMBUNG</label>
                                <select class="select2 form-control custom-select" id="vehicles_id" name="vehicles_id" data-url="api/selectvehicle" data-value="" style="width: 100%; height:36px;" required>
                                <option id="" value="" selected="selected">--Select--</option>
                                
                                </select>

                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="log_date" class="control-label">LOG DATE</label>
                                <input type="text" class="form-control mydatepicker" id="log_date" name="log_date"  required autocomplete="off" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="odo" class="control-label">ODO</label>
                                <input type="text" class="form-control" id="odo" name="odo" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="driver" class="control-label">DRIVER</label>
                                <select class="select2 form-control custom-select" id="driver" name="driver" data-url="api/selectdriver" data-value="" style="width: 100%; height:36px;" required>
                                <option id="" value=""  selected="selected">--Select--</option>
                                </select>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="fuel_topup" class="control-label">FUEL TOPUP</label>
                                <input type="text" class="form-control" id="fuel_topup" name="fuel_topup">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="equipement" class="control-label">EQUIPEMENT</label>
                                <select class="select2 form-control custom-select" id="equipement" name="equipement" data-url="api/selectequipement" data-value="" style="width: 100%; height:36px;" required>
                                <option id="" value="" selected="selected">--Select--</option>
                                </select>

                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="condition" class="control-label">CONDITION</label>
                                <select class="select2 form-control custom-select" id="condition" name="condition" data-url="api/selectcondition" data-value="" style="width: 100%; height:36px;" required>
                                <option id="" value=""  selected="selected">--Select--</option>
                                </select>

                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    		
                        <div class="col-md-6 ">		
                            <div class="form-group">	
                                <label for="problem" class="control-label">NOTE</label>
                                <textarea class="form-control" rows="5" id="problem" name="problem" required></textarea>

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