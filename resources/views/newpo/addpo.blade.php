<div class="modal fade bs-example-modal-lg" id="addpoModal" tabindex="-1" role="dialog"
    aria-labelledby="addpoModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addpoModal1">Input New workorderpart</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="addpoModal"
                enctype="multipart/form-data">
                {{-- @csrf @method('post')
                 --}}
                 {{ csrf_field() }} {{ method_field('POST')}}
                             
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{Auth::user()->name}}">   
                   
                    
                  	
                  <div class="table-responsive m-t-40">
                        <table id="tabeladdpo" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th>NO</th>
                                <th>PR NUMBER</th>
                                <th>PR APPROVE DATE</th>
                                <th>QTY</th>
                                <th>ACTION</th>
                                </tr>
                            </thead>
                            <tfoot>

                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>
                    </div>	
            </form>
        </div>
    </div>
</div>