<div class="modal fade bs-example-modal-lg" id="vehicleModal" tabindex="-1" role="dialog"
    aria-labelledby="vehicleModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vehicleModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="vehicleModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="vehiclemodels_id" class="control-label">VEHICLEMODELS ID</label>
                                <select class="select2 form-control custom-select" id="vehiclemodels_id" name="vehiclemodels_id" data-url="api/selectvehiclemodel" data-value="" style="width: 100%; height:36px;" ></select>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="manufacturers_id" class="control-label">MANUFACTURERS ID</label>
                                <select class="select2 form-control custom-select" id="manufacturers_id" name="manufacturers_id" data-url="api/selectmanufacturer" data-value="" style="width: 100%; height:36px;" ></select>
                                
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="nomor_lambung" class="control-label">NOMOR LAMBUNG</label>
                                <input type="text" class="form-control" id="nomor_lambung" name="nomor_lambung" value="{{old('nomor_lambung')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="nomor_polisi" class="control-label">NOMOR POLISI</label>
                                <input type="text" class="form-control" id="nomor_polisi" name="nomor_polisi" value="{{old('nomor_polisi')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="tahun_pembuatan" class="control-label">TAHUN PEMBUATAN</label>
                                <input type="text" class="form-control" id="tahun_pembuatan" name="tahun_pembuatan" value="{{old('tahun_pembuatan')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="nomor_rangka" class="control-label">NOMOR RANGKA</label>
                                <input type="text" class="form-control" id="nomor_rangka" name="nomor_rangka" value="{{old('nomor_rangka')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="nomor_mesin" class="control-label">NOMOR MESIN</label>
                                <input type="text" class="form-control" id="nomor_mesin" name="nomor_mesin" value="{{old('nomor_mesin')}}" required>
                                <span class="help-block with-errors"></span>
                            </div>	
                        </div>		
                    </div>			
                                
                    <div class="row">			
                        <div class="col-md-12 ">		
                            <div class="form-group">	
                                <label for="nomor_polis" class="control-label">NOMOR POLIS</label>
                                <input type="text" class="form-control" id="nomor_polis" name="nomor_polis" value="{{old('nomor_polis')}}" required>
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