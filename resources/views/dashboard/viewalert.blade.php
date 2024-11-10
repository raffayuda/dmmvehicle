<div class="modal fade bd-example-modal-lg" id="alertModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    {{-- <div class="modal fade bs-example-modal-lg" id="redModal" tabindex="-1" role="dialog" aria-labelledby="redModal" aria-hidden="true"> --}}
    {{-- <div class="modal-dialog modal-lg"> --}}
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title" id="alertModal">Stock Alert</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">

                <div class="table-responsive m-t-40">
                    <table id="tabelalert" class="display nowrap table table-hover table-striped table-bordered"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>PART NUMBER</th>
                                <th>PART NAME</th>
                                <th>STOCK</th>
                                <th>MIN STOCK</th>
                            </tr>
                        </thead>
                        <tfoot>

                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>