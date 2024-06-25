<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary py-3">
                <h5 class="modal-title text-white" id="exampleModalLabel1">Package <span id="package_id"></span></h5>
                <button type="button" class="close state_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                       <div style="border: 1px solid black;padding-left:10px;">
                            <h5 style="margin: 0;font-weight:600 !important;"><span style="w-50">Name:</span> <span id="modal_name"></span></h5>
                            <h5 style="margin: 0;font-weight:600 !important;"><span>Price: </span><span id="modal_price"></span></h5>
                            <h5 style="margin: 0;font-weight:600 !important;"><span>Status:</span> <span id="modal_status"></span></h5>
                            <h5 style="margin: 0;font-weight:600 !important;"><span>Stock Status:</span> <span id="modal_stock_status"></span></h5>
                       </div>
                    </div>
                    <div class="col-md-6" id="modal_image" style="justify-content: center;">

                    </div>
                    <h4 class="text-center m-auto py-2" style="font-weight: 600;">Description</h4>
                    <div class="col-md-12" id="modal_description" style="border: 1px solid black; padding: 10px;">

                    </div>
                </div>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
