<div class="modal fade edit-layout-modal pr-0 " id="expenseShow" role="dialog" aria-labelledby="expenseEditLabel"
        aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="expenseShowLabel">Expense Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                   
                        <div class="card-body">
                            
                            @if (session('expense')->expenseReason=='Service' && session('service_ref')!=null )
                            <div class="form-group" id="expenseReasonWrapper">
                                <label>Expense Reason</label>
                                <input  name="expenseReason" class="form-control"  type="text" value="Service" readonly>
                            </div>
                            <div class="form-group" id="serviceIDs">
                                <label for="serviceId">Service ID</label>
                                <input id="serviceId"  name="serviceId" class="form-control"  type="text" value="{{session('service_ref')}}" readonly>                               
                            </div>
                            @else
                            <div class="form-group" id="expenseReasonWrapper">
                                <div class="form-group" id="expenseReasonWrapper">
                                    <label>Expense Reason</label>
                                    <input  name="expenseReason" class="form-control"  type="text" value="{{session('expense')->expenseReason}}" readonly>
                                </div>
                            </div>
                            @endif

                            
                        
                            <div class="form-group" id="expenseDescription" >
                                <label for="expenseDescription">Expense Description</label>
                                <textarea wire:model="expenseDescription" type="text" id="expenseDescription" name="expenseDescription" class="form-control" placeholder="Enter custom reason" readonly>{{session('expense')->expenseDescription}}</textarea>
                                
                            </div>
                            
                            <div class="form-group">
                                <label>Paid To:-</label>
                                <input name="payedPartnerName" type="text" class="form-control"
                                    placeholder="Enter Paid Partner" value="{{session('expense')->payedPartnerName}}" readonly>
                                
                            </div>
                            <div class="form-group">
                                <label class="d-block">Payment Status</label>
                                @if (session('expense')->status=='Paid')
                                <label class="ml-2" for="paid"><input type="radio" checked name="status"
                                    id="paid" value="Paid" required /> Paid</label><br />
                                @else
                                    <label class="ml-2" for="unpaid"><input type="radio" checked name="status"
                                        id="unpaid" value="Unpaid" required /> Unpaid</label><br />
                                @endif
                                
                                
                               
                            </div>
                            <div class="form-group">
                                <label>Amount</label>
                                <input name="amount" type="number" class="form-control"
                                    placeholder="Enter Amount" value="{{session('expense')->amount}}" required readonly>
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
            
                        </div>
            

                </div>
            </div>
        </div>
        
    </div>