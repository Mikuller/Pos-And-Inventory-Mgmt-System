<div class="modal fade edit-layout-modal pr-0 " id="expenseEdit" role="dialog" aria-labelledby="expenseEditLabel"
        aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staffEditLabel">Edit Expense Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" method="POST" action="{{route('expense.update',['expense'=>session('expense')->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            
                            @if (session('expense')->expenseReason=='Service' && session('services')!=null )
                            <div class="form-group" id="expenseReasonWrapper">
                                <label>Expense Reason</label>
                                <input  name="expenseReason" class="form-control"  type="text" value="Service" readonly>
                            </div>
                            <div class="form-group" id="serviceIDs">
                                <label for="serviceId">Service ID</label>
                                <select class="form-control" name="serviceId" id="serviceId">
                                    <option value="" selected disabled>Select service Refrence num</option>
                                    @foreach (session('services') as $service)
                                        <option @selected( session('expense')->service_id==$service->id ) value="{{ $service->id }}">
                                            {{ $service->refNumber }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('serviceIDs')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @else
                            <div class="form-group" id="expenseReasonWrapper">
                                <label>Expense Reason</label>
                                <select  name="expenseReason" id="expenseReason" class="form-control">
                                    <option value="" selected disabled>Select Expense Reason</option>
                                    <option @selected(session('expense')->expenseReason=='Salary') value="Salary">Salary</option>
                                    <option @selected(session('expense')->expenseReason=='Food') value="Food">Food</option>
                                    <option @selected(session('expense')->expenseReason=='Transport')  value="Transport">Transport</option>
                                    <option @selected(session('expense')->expenseReason=='Rent') value="Rent">Rent</option>
                                    <option @selected(session('expense')->expenseReason=='Other') value="Other">Other</option>     
                                </select>
                                @error('expenseReason')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif

                            
                        
                            <div class="form-group" id="expenseDescription" >
                                <label for="expenseDescription">Expense Description</label>
                                <textarea wire:model="expenseDescription" type="text" id="expenseDescription" name="expenseDescription" class="form-control" placeholder="Enter custom reason">{{session('expense')->expenseDescription}}</textarea>
                                @error('expenseDescription')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Paid To:-</label>
                                <input name="payedPartnerName" type="text" class="form-control"
                                    placeholder="Enter Paid Partner" value="{{session('expense')->payedPartnerName}}">
                                @error('payedPartnerName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="d-block">Payment Status</label>
                                <label class="ml-2" for="paid"><input type="radio" @checked(session('expense')->status=='Paid') name="status"
                                        id="paid" value="Paid" required /> Paid</label><br />
                                <label class="ml-2" for="unpaid"><input type="radio" @checked(session('expense')->status=='Unpaid') name="status"
                                        id="unpaid" value="Unpaid" required /> Unpaid</label><br />
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input name="amount" type="number" class="form-control"
                                    placeholder="Enter Amount" value="{{session('expense')->amount}}" required>
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
            
                        </div>
            
                    </form>
                </div>
            </div>
        </div>
        
    </div>