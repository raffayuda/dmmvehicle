<div class="modal fade bs-example-modal-lg" id="sparepartModal" tabindex="-1" role="dialog"
    aria-labelledby="sparepartModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="sparepartModal1"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="sparepartModal" enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST')}}

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- <input type="text" class="form-control" id="id" name="id" value="{{old('id')}}" required> --}}

                    <input type="hidden" class="form-control" id="created_by" name="created_by"
                        value="{{Auth::user()->name}}">

                    <div class="row">			
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="spareparts_name" class="control-label">SPAREPARTS NAME</label>
                            <input type="text" class="form-control" id="spareparts_name" name="spareparts_name" value="{{old('spareparts_name')}}" required>
                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="vehiclemodels_id" class="control-label">VEHICLEMODELS ID</label>
                                <select class="select2 form-control custom-select" id="vehiclemodels_id" name="vehiclemodels_id" data-url="api/selectvehiclemodel" data-value="" style="width: 100%; height:36px;" ></select>

                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                </div>			
                            
                <div class="row">			
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="manufacturers_id" class="control-label">MANUFACTURERS ID</label>
                            <select class="select2 form-control custom-select" id="manufacturers_id" name="manufacturers_id" data-url="api/selectmanufacturer" data-value="" style="width: 100%; height:36px;" ></select>

                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="part_number_group" class="control-label">PART NUMBER GROUP</label>
                            <input type="text" class="form-control" id="part_number_group" name="part_number_group" value="{{old('part_number')}}" required>
                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                </div>

                <div class="row">			
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="part_number" class="control-label">PART NUMBER</label>
                            <input type="text" class="form-control" id="part_number" name="part_number" value="{{old('part_number')}}" required>
                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="part_type" class="control-label">PART TYPE</label>
                            
                            <select class="select2 form-control custom-select" id="part_type" name="part_type" data-url="api/selectspareparttype" data-value="" style="width: 100%; height:36px;" ></select>

                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                </div>			
                
                <div class="row">			
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="min_stock" class="control-label">MIN STOCK</label>
                            <input type="text" class="form-control" id="min_stock" name="min_stock" value="{{old('min_stock')}}" required>
                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="max_stock" class="control-label">MAX STOCK</label>
                            <input type="text" class="form-control" id="max_stock" name="max_stock" value="{{old('max_stock')}}" required>
                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                </div>	

                <div class="row">			
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="uom" class="control-label">UOM</label>
                            <input type="text" class="form-control" id="uom" name="uom" value="{{old('uom')}}" required>
                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="price" class="control-label">PRICE</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{old('price')}}" >
                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                </div>			
                            
                <div class="row">			
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="price_update" class="control-label">PRICE UPDATE DATE</label>

                            <input type="text"  class="form-control mydatepicker" id="price_update" name="price_update" value="{{old('price_update')}}" autocomplete="off">
                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                    
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="status" class="control-label">STATUS</label>
                            {{-- <input type="text" class="form-control" id="status" name="status" value="{{old('status')}}" required> --}}
                            <select class="select2 form-control custom-select" id="status" name="status" data-url="api/selectstatuspart" data-value="" style="width: 100%; height:36px;" ></select>

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