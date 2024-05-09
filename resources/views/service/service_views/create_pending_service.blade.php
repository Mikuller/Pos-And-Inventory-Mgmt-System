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
                                @php
                                     $serviceTypes = App\Models\ServiceType::latest()->get();
                                @endphp
                                @forelse ($serviceTypes as $serviceType)
                                    <div class="border-checkbox-section ml-3">

                                        <div class="border-checkbox-group border-checkbox-group-success d-block">

                                            <input name="serviceTypeId[]" class="border-checkbox" type="checkbox"
                                                id="checkbox{{ $serviceType->id }}" value="{{ $serviceType->id }}">
                                            <label class="border-checkbox-label"
                                                for="checkbox{{ $serviceType->id }}">{{ $serviceType->name }}</label>

                                        </div>

                                    </div>
                                @empty
                                    <span class=" b-b-primary text-primary ">
                                        <p>No registerd Service types </p>
                                    </span>
                                @endforelse

                                @error('serviceTypeId')
                                    <div class="help-block with-errors">
                                        <span class="text-red">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                @if (!$serviceTypes->isEmpty())
                                    <input class="btn btn-primary" type="submit" name="Save" value="Save">
                                @else
                                    <a href="{{ route('service.serviceTypes') }}">
                                        <span class="float-right btn-sm btn-danger">Add Service Types First <i
                                                class="fa fa-exclamation-triangle" aria-hidden="true"></i></span></a>
                                @endif

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>