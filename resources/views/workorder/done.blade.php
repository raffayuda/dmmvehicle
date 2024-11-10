<div class="modal fade bs-example-modal-lg" id="doneModal" tabindex="-1" role="dialog"
    aria-labelledby="doneModal1">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="doneModal1">Input New workorderpackage</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form data-toggle="validator" method="post" id="doneModal"
                enctype="multipart/form-data">
                {{-- @csrf @method('post')
                 --}}
                 {{ csrf_field() }} {{ method_field('POST')}}
                             
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <input type="hidden" class="form-control" id="created_by" name="created_by" value="{{Auth::user()->name}}">   
                   
                    
                   <div class="table-responsive m-t-40">
                        <table id="tabelworkorderpackageselect" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NOMOR LAMBUNG</th>
                                    <th>PACKAGE NAME</th>
                                    <th>SCHEDULE DATE</th>
                                    <th>ODO</th>
                                    <th>PROBLEM</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tfoot>

                            </tfoot>
                            <tbody>
                                @foreach ($maintenance as $maintenanc)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$maintenanc->nomor_lambung}}</td>
                                    <td>{{$maintenanc->package_name}}</td>
                                    <td>{{$maintenanc->log_date}}</td>
                                    <td>{{$maintenanc->problem}}</td>
                                    <td>{{$maintenanc->due_date}}</td>
                                    <td><button type="submit" class="btn btn-primary" disabled>Add</button></td>
                                    
                                </tr>     
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>			


                   


                </div>
                <div class="modal-footer">
                    {{-- <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span> </button> --}}
                    
                </div>
            </form>
        </div>
    </div>
</div>