<div class="modal fade edit-layout-modal pr-0" id="serviceShow" role="dialog"
            aria-labelledby="serviceShowLabel" style="display: none;" aria-hidden="true">
            
            <div class="modal-dialog w-300" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="supplierAddLabel">Show service Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="d-block">Customer Name</label>
                            <input type="text" name="customerName" class="form-control"
                                placeholder="Enter Customer Name" value="{{ session('service')->customerName }}"
                                readonly>

                        </div>
                        <div class="form-group">
                            <label class="d-block">Phone</label>
                            <input type="text" name="customerPhone" class="form-control" placeholder="Enter Phone"
                                value="{{ session('service')->customerPhone }}" readonly>

                        </div>
                        <div class="form-group">
                            <label class="d-block">Maintainer Staff's Name</label>
                            <input type="text" name="maintainerName" class="form-control" 
                                value="{{ session('service')->maintainerName }}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Price</label>
                            <input type="number" name="price" class="form-control" placeholder="Enter Price"
                                value="{{ session('service')->price }}" readonly>

                        </div>

                        <div class="form-group">
                            <label class="d-block">Payment Status<span class="text-danger"> *</span></label>
                            <input type="text" class="d-inline mb-2" name="paymentStatus"
                                value="{{ session('service')->paymentStatus }}" readonly />
                            <br />

                        </div>
                        <div class="form-group">
                            <label class="d-block">Payment Method</label>
                            <input type="text" class="d-inline mb-2" name="paymentMethod"
                                value="{{ session('service')->paymentMethod }}" readonly />
                            <br />
                        </div>


                        <div class="form-group" id="eCashRefNumberWrapper" class="form-group"
                            @if (session('service')->paymentMethod == 'Cash') style="display: none;" @endif>
                            <label class="d-block">Bank Information</label>
                            <select class="form-control" id="bankInfo" name="depositBank" readonly>
                                <option selected="selected" value="{{ null }}">Select Deposit Bank
                                </option>
                                @php
                                    $banks = App\Models\DepositBank::latest()->get();
                                @endphp
                                @forelse ($banks as $bank)
                                    <option value="{{ $bank->id }}" @selected(session('service')->deposit_bank_id == $bank->id)>
                                        {{ $bank->bankName . '-' . $bank->accNum }}</option>

                                @empty
                                    <option value="">No bank Info Added Yet</option>
                                @endforelse

                            </select>

                            <input class="form-control mt-2 " type="text" name="eCashRefNumber" id="eCashRefNumber"
                                placeholder="Txn Refrence Number" value="{{ session('service')->eCashRefNumber }}"
                                readonly />
                        </div>



                        <div class="form-group">
                            <label class="d-block">service Note</label>
                            <textarea type="text" name="statusNote" class="form-control" placeholder="Enter a Note" readonly>{{ session('service')->statusNote }}</textarea>

                        </div>
                        <div class="form-group">
                            <label>Service Type</label>
                            @forelse (session('serviceTypes') as $serviceType)
                                <div class="border-checkbox-section ml-3">

                                    <div class="border-checkbox-group border-checkbox-group-success d-block">
                                        @if (session('service')->serviceTypes->contains($serviceType))
                                            <input name="serviceTypeId[]" class="border-checkbox" type="checkbox"
                                                id="checkbox{{ $serviceType->id }}" value="{{ $serviceType->id }}"
                                                checked>
                                            <label class="border-checkbox-label"
                                                for="checkbox{{ $serviceType->id }}">{{ $serviceType->name }}</label>
                                        @else
                                            <input name="serviceTypeId[]" class="border-checkbox" type="checkbox"
                                                id="checkbox{{ $serviceType->id }}" value="{{ $serviceType->id }}">
                                            <label class="border-checkbox-label"
                                                for="checkbox{{ $serviceType->id }}">{{ $serviceType->name }}</label>
                                        @endif

                                    </div>

                                </div>
                            @empty
                            @endforelse
                        </div>

                    </div>
                </div>
            </div>
        </div>