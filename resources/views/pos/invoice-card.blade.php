<!-- Preview Invoice Modal -->
<div class="modal fade edit-layout-modal pr-0 " id="InvoiceModal" role="dialog" aria-labelledby="InvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-70" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="InvoiceModalLabel">Preview Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="card-header">
                    <h3 class="d-block w-100">Radmin<small class="float-right">07/10/2021</small></h3>
                </div>
                <div class="card-body">
                    @include('common.invoice')
                    <div class="row no-print">
                        <div class="col-12">
                            <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                            <button type="button" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>