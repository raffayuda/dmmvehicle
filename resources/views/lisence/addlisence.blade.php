<div class="modal fade bs-example-modal-lg" id="lisenceModal" tabindex="-1" role="dialog"
    aria-labelledby="lisenceModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="lisenceModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="lisenceModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="vehicles_id" class="control-label">NOMOR LAMBUNG</label>
                                <input type="text" class="form-control" id="vehicles_id" name="vehicles_id" value="{{old('vehicles_id')}}" readonly>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="stnk" class="control-label">STNK</label>
                                <input type="text" class="form-control mydatepicker"  id="stnk" name="stnk" autocomplete="off">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="pajak_tahunan" class="control-label">PAJAK TAHUNAN</label>
                                <input type="text" class="form-control mydatepicker"  id="pajak_tahunan" name="pajak_tahunan" autocomplete="off">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="izin_lapor" class="control-label">IZIN LAPOR</label>
                                <input type="text" class="form-control mydatepicker"  id="izin_lapor" name="izin_lapor" autocomplete="off">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="kir" class="control-label">KIR</label>
                                <input type="text" class="form-control mydatepicker"  id="kir" name="kir" autocomplete="off">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="commisioning" class="control-label">COMMISIONING</label>
                                <input type="text" class="form-control mydatepicker"  id="commisioning" name="commisioning" autocomplete="off">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="fuel_issue" class="control-label">FUEL ISSUE</label>
                                <input type="text" class="form-control mydatepicker"  id="fuel_issue" name="fuel_issue" autocomplete="off">
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="road_i" class="control-label">ROAD I</label>
                                <input type="text" class="form-control mydatepicker"  id="road_i" name="road_i" autocomplete="off">
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