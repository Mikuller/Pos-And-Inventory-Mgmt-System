@extends('inventory.layout')
@section('title', 'Services')
@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="fa fa-spinner bg-green" aria-hidden="true"></i>
                        <div class="d-inline">
                            <h5>Pending services</h5>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4">

                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('service.index') }}">Pending services</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                @include('include.message')
            </div>
        </div>
        <livewire:pending-services />
    </div>

    @if (session('createMode'))
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#serviceAdd').modal('show');
            });
        </script>
        <?php session(['createMode' => false]); ?>
        <div class="modal fade edit-layout-modal pr-0" id="serviceAdd" role="dialog" aria-labelledby="serviceAddLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog w-300" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="supplierAddLabel">Add service</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('service.store.pendingService') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label class="d-block">Customer Name</label>
                                <input type="text" name="customerName" class="form-control"
                                    placeholder="Enter Customer Name" required>
                                @error('customerName')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="d-block">Phone</label>
                                <input type="text" name="customerPhone" class="form-control" placeholder="Enter Phone"
                                    required>
                                @error('customerPhone')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="d-block">Price</label>
                                <input type="number" name="price" class="form-control" placeholder="Enter Price"
                                    required>
                                @error('price')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="d-block">service Note</label>
                                <textarea type="text" name="statusNote" class="form-control" placeholder="Enter a Note"></textarea>
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

                                            <input name="serviceTypeId[]" class="border-checkbox" type="checkbox"
                                                id="checkbox{{ $serviceType->id }}" value="{{ $serviceType->id }}">
                                            <label class="border-checkbox-label"
                                                for="checkbox{{ $serviceType->id }}">{{ $serviceType->name }}</label>

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
                                <input class="btn btn-primary" type="submit" name="Save" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('editMode') && session('service')->exists() ?? false)
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#serviceEdit').modal('show');
            });
        </script>
        <?php session(['editMode' => false]); ?>
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
                                <input type="text" name="customerPhone" class="form-control"
                                    placeholder="Enter Phone" value="{{ session('service')->customerPhone }}">
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
    @endif

    @if (session('editPaymentMode') ?? false)
        <script>
            // Open the modal using JavaScript
            $(document).ready(function() {
                $('#servicePaymentEdit').modal('show');
            });
        </script>
        <?php session(['editPaymentMode' => false]); ?>
        <div class="modal fade edit-layout-modal pr-0" id="servicePaymentEdit" role="dialog"
            aria-labelledby="servicePaymentEdit" style="display: none;" aria-hidden="true">
            <div class="modal-dialog w-300" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="supplierAddLabel">Update Service Payment Info</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form
                            action="{{ route('service.markAsDone.pendingService', ['service' => session('service')->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="d-block">Price</label>
                                <input type="number" name="price" class="form-control" placeholder="Enter Price"
                                    value="{{session('service')->price}}" required>
                                
                            </div>
                            <div class="form-group">
                                <label class="d-block h4">Payment Method <span
                                        class="text-danger">*required*</span></label>
                                <div class="ml-2">
                                    <label class="h2 d-block" for="cash">
                                        <input type="radio" name="paymentMethod" id="cash" value="Cash"
                                            required /> Cash
                                    </label>
                                    <label class="h2 d-block" for="E-Cash">
                                        <input type="radio" name="paymentMethod" id="E-Cash" value="E-Cash"
                                            required /> E-Cash
                                    </label>
                                </div>
                            </div>



                            <div class="form-group" id="eCashRefNumberWrapper" class="form-group"
                                style="display: none;">
                                <label class="d-block">Bank Information</label>
                                <select class="form-control" id="bankInfo" name="depositBank">
                                    <option selected="selected" value="">Select Deposit Bank</option>
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

                                <input class="form-control mt-2 " type="text" name="eCashRefNumber"
                                    id="eCashRefNumber" placeholder="Txn Refrence Number" />
                            </div>


                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="Save" value="Save as Done">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @push('style')
        <style>
            /* Custom CSS to style the radio buttons */
            .custom-radio-input {
                width: 1.5em;
                height: 1.5em;
                margin-right: 0.5em;
                /* Adjust spacing between label and radio button */
            }
        </style>
    @endpush
    <!-- push external js -->

    @push('script')
        <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('plugins/DataTables/Cell-edit/dataTables.cellEdit.js') }}"></script>
        <!--get editable datatable script-->
        <script src="{{ asset('js/editable-datatable.js') }}"></script>

        <script>
            // Get the radio button and text input elements
            const eCashRadio = document.getElementById('E-Cash');
            const cashRadio = document.getElementById('cash');

            const eCashRefNumberWrapper = document.getElementById('eCashRefNumberWrapper');


            const refNum = document.getElementById('eCashRefNumber');
            const bankInfo = document.getElementById('bankInfo');
            // Add event listener to the radio button
            eCashRadio.addEventListener('change', function() {
                // If the E-Cash radio button is checked, show the text input
                if (this.checked) {
                    eCashRefNumberWrapper.style.display = 'block';
                    refNum.required = true;
                    bankInfo.required = true;
                } else {
                    // If the E-Cash radio button is unchecked, hide the text input
                    eCashRefNumberWrapper.style.display = 'none';
                    refNum.required = false;
                    refNum.value = null;
                    bankInfo.required = false;
                    bankInfo.value = null;

                }
            });
            cashRadio.addEventListener('change', function() {

                if (this.checked) {
                    eCashRefNumberWrapper.style.display = 'none';
                    refNum.required = false;
                    bankInfo.required = false;
                    bankInfo.value = null;
                    refNum.value = null;
                } else {
                    eCashRefNumberWrapper.style.display = 'block';
                    refNum.required = true;
                    bankInfo.required = true;

                }
            });
        </script>
    @endpush

@endsection
