<div class="modal fade edit-layout-modal pr-0" id="servicePaymentEdit" role="dialog" aria-labelledby="servicePaymentEdit"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog w-300" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="supplierAddLabel">Update Service Payment Info</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form
                    action="{{ route('service.savePaymentInfo.pendingService', ['service' => session('service')->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="d-block">Price</label>
                        <input type="number" name="price" class="form-control" placeholder="Enter Price"
                            value="{{ session('service')->price }}" required>

                    </div>
                    <div class="form-group">
                        <label class="d-block">Maintainer Staff's Name</label>
                        @php
                            $maintainerNames = App\Models\Service::all()->groupBy('maintainerName')->keys();
                        @endphp
                        <select id="nameList" name="maintainerName" class="form-control" required>
                            <option selected value="" disabled>Select maintainer's name</option>
                            @forelse ($maintainerNames as $maintainerName)
                                @if ($maintainerName != null)
                                    <option value="{{ $maintainerName }}">{{ $maintainerName }}</option>
                                @endif
                            @empty
                                <option value="">No record added Yet</option>
                            @endforelse
                            <option value="custom">ADD NEW</option>
                        </select>
                        <input id="customName" type="text" name="maintainerNameNew" class="form-control"
                            placeholder="who maintained it?" style="display: none">
                    </div>
                    <div class="form-group">
                        <label class="d-block h6">Payment Status <span class="text-danger">*required*</span></label>
                        <div class="ml-2">
                            <label class="h5 d-block" for="paid">
                                <input type="radio" name="paymentStatus" id="paid" value="Paid" required />
                                Paid
                            </label>
                            <label class="h5 d-block" for="unpaid">
                                <input type="radio" name="paymentStatus" id="unpaid" value="Unpaid" required />
                                Credit
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="d-block h6">Payment Method <span class="text-danger">*required*</span></label>
                        <div class="ml-2">
                            <label class="h5 d-block" for="cash">
                                <input type="radio" name="paymentMethod" id="cash" value="Cash" required />
                                Cash
                            </label>
                            <label class="h5 d-block" for="E-Cash">
                                <input type="radio" name="paymentMethod" id="E-Cash" value="E-Cash" required />
                                E-Cash
                            </label>
                        </div>
                    </div>



                    <div class="form-group" id="eCashRefNumberWrapper" class="form-group" style="display: none;">
                        <label class="d-block">Bank Information</label>
                        <select class="form-control" id="bankInfo" name="depositBank">
                            <option selected="selected" value="" disabled>Select Deposit Bank</option>
                            @php
                                $banks = App\Models\DepositBank::latest()->get();
                            @endphp
                            @forelse ($banks as $bank)
                                <option value="{{ $bank->id }}">
                                    {{ $bank->bankName . '-' . $bank->accNum }}</option>

                            @empty
                                <option value="">No bank Info Added Yet</option>
                            @endforelse

                        </select>

                        <input class="form-control mt-2 " type="text" name="eCashRefNumber" id="eCashRefNumber"
                            placeholder="Txn Refrence Number" />
                    </div>


                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="Save" value="Save Payment">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
