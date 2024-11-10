<div class="modal fade bs-example-modal-lg" id="editpartModal" tabindex="-1" role="dialog"
    aria-labelledby="editpartModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editpartModal">Input New workorderpart</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="editpartModal"
                enctype="multipart/form-data">
                {{-- @csrf @method('post')
                 --}}
                 {{ csrf_field() }} {{ method_field('POST')}}
                             
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{Auth::user()->name}}">   
                   
                    
                  	
                  <div class="table-responsive m-t-40">
                        <table id="tabelpartpackage" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>VEHICLE MODEL</th>
                                    <th>PART NUMBER</th>
                                    <th>PART NAME</th>
                                    <th>UoM</th>
                                    <TH>STOCK</TH>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tfoot>

                            </tfoot>
                            <tbody>
                                {{-- @foreach ($sparepart as $maintenanc)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$maintenanc->part_number}}</td>
                                    <td>{{$maintenanc->part_name}}</td>
                                    <td>{{$maintenanc->uom}}</td>
                                    <td>{{$maintenanc->manufacturers_id}}</td>
                                    <td><button type="submit" class="btn btn-primary" disabled>Add</button></td>
                                    
                                </tr>     
                                @endforeach --}}
                               
                            </tbody>
                        </table>
                    </div>	


                   


                
            </form>
        </div>
    </div>
</div>