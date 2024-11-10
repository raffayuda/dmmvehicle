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
                            <input type="text" class="form-control" id="spareparts_name" name="spareparts_name" value="{{old('spareparts_name')}}" readonly>
                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="last_stock" class="control-label">LAST STOCK</label>
                            <input type="text" class="form-control" id="last_stock" name="last_stock" value="{{old('last_stock')}}" readonly>
                            <span class="help-block with-errors"></span>
                        </div>

                        
                    </div>		
                </div>			
                            

                <div class="row">			
                    <div class="col-md-6 ">	
                        <div class="form-group">	
                            <label for="part_number_group" class="control-label">PART NUMBER GROUP</label>
                            <input type="text" class="form-control" id="part_number_group" name="part_number_group" value="{{old('part_number')}}" readonly>
                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="new_stock" class="control-label">NEW STOCK</label>
                            <input type="text" class="form-control" id="new_stock" name="new_stock" value="{{old('new_stock')}}" required>
                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>		
                </div>			
                
                <div class="row">			
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="part_number" class="control-label">PART NUMBER</label>
                            <input type="text" class="form-control" id="part_number" name="part_number" value="{{old('part_number')}}" readonly>
                            <span class="help-block with-errors"></span>
                        </div>	
                        	
                    </div>		
                    
                    <div class="col-md-6 ">		
                        <div class="form-group">	
                            <label for="uom" class="control-label">UOM</label>
                            <input type="text" class="form-control" id="uom" name="uom" value="{{old('uom')}}" readonly>
                            <span class="help-block with-errors"></span>
                        </div>	
                    </div>			
                </div>	
                <div class="row">			
                    <div class="col-md-12 ">		
                        <div class="form-group">	
                            <label for="note" class="control-label">NOTE</label>
                            <input type="text" class="form-control" id="note" name="note" value="{{old('note')}}" >
                            <span class="help-block with-errors"></span>
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