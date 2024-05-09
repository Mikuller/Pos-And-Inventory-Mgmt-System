<div class="modal fade edit-layout-modal pr-0" id="serviceEdit" role="dialog" aria-labelledby="serviceEditLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog w-300" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="supplierAddLabel">Update service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('service.update.pendingService', ['service' => session('service')->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="d-block">Customer Name</label>
                                <input type="text" name="customerName" class="form-control"
                                    placeholder="Enter Customer Name" value="{{ session('service')->customerName }}">
                                @error('customerName')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="d-block">Phone</label>
                                <input type="text" name="customerPhone" class="form-control" placeholder="Enter Phone"
                                    value="{{ session('service')->customerPhone }}">
                                @error('customerPhone')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="d-block">Price</label>
                                <input type="number" name="price" class="form-control" placeholder="Enter Price"
                                    value="{{ session('service')->price }}">
                                @error('price')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            @if (session('service')->status == 'Done')
                                <div class="form-group">
                                    <label class="d-block">Payment Method<span class="text-danger"> *</span></label>
                                    <label class="ml-2 d-inline mb-2" for="cash"><input type="radio"
                                            class="d-inline mb-2" name="paymentMethod" id="cash" value="Cash"
                                            required @checked(session('service')->paymentMethod == 'Cash') /> Cash
                                    </label><br />
                                    <label class="ml-2" for="E-Cash"><input type="radio" name="paymentMethod"
                                            id="E-Cash" value="E-Cash" required @checked(session('service')->paymentMethod == 'E-Cash') /> E-Cash
                                    </label><br />
                                </div>

                                <div class="form-group" id="eCashRefNumberWrapper" class="form-group"
                                    @if (session('service')->paymentMethod == 'Cash') style="display: none;" @endif>
                                    <label class="d-block">Bank Information</label>
                                    <select class="form-control" id="bankInfo" name="depositBank">
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

                                    <input class="form-control mt-2 " type="text" name="eCashRefNumber"
                                        id="eCashRefNumber" placeholder="Txn Refrence Number"
                                        value="{{ session('service')->eCashRefNumber }}" />
                                </div>
                            @endif


                            <div class="form-group">
                                <label class="d-block">service Note</label>
                                <textarea type="text" name="statusNote" class="form-control" placeholder="Enter a Note">{{ session('service')->statusNote }}</textarea>
                                @error('statusNote')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
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

                                @error('serviceTypeId')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="Save" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>