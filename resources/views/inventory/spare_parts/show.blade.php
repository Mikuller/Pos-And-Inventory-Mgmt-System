<div class="modal fade edit-layout-modal pr-0" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
    aria-hidden="true">
    <div class="modal-dialog w-305" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">Registration Date:
                    {{ date_format(session('sparePart')->created_at, 'F j, Y, g:i a') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="col-auto pr-0">
                    <div class="card mb-0">
                        <div class="card-body">

                            <div class="form-group">
                                <label>Image</label>
                                <img class="img-fluid img-thumbnail mt-2"
                                    src="{{ session('sparePart')->getImageURL() }}">
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input name="name" type="text" value="{{ session('sparePart')->name }}"
                                    class="form-control" readonly>

                            </div>

                            <div class="form-group">
                                <label>Available amount</label>
                                <input name="availableAmount" value="{{ session('sparePart')->availableAmount }}"
                                    type="number" class="form-control" readonly>
                            </div>
                            <br>
                            <div class="form-group">
                                <label>WITHDRAWAL REPORT</label>
                                @forelse (session('sparePart')->sparePartWithdraws as $sparePartWithdraw)
                                    <blockquote class="blockquote">
                                        <p class="mb-0">Withdrawer Name: <strong> {{ $sparePartWithdraw->withdrawerName }}</strong></p>
                                        <footer class="blockquote-footer">Amount: {{ $sparePartWithdraw->amount }},  <cite
                                                title="Date">--Date: {{ date_format($sparePartWithdraw->created_at, 'F j, Y, g:i a') }}
                                            </cite></footer>
                                    </blockquote>
                                @empty
                                    <p class="mb-0 text-primary"> no withdraw after Registration!</p>
                                @endforelse

                            </div>
                            <br>
                            <div class="form-group">
                                <label>DEPOSIT REPORT</label>
                                @forelse (session('sparePart')->sparePartDeposits as $sparePartDeposit)
                                    <blockquote class="blockquote">
                                        <p class="mb-0">Depositor Name: <strong> {{ $sparePartDeposit->depositorName }}</strong></p>
                                        <footer class="blockquote-footer">Amount: {{ $sparePartDeposit->amount }},  <cite
                                                title="Date">--Date: {{ date_format($sparePartDeposit->created_at, 'F j, Y, g:i a') }}
                                            </cite></footer>
                                    </blockquote>
                                @empty
                                    <p class="mb-0 text-primary"> no Deposit after Registration! </p>
                                @endforelse

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
