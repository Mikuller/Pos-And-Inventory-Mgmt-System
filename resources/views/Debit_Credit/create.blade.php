<div class="modal fade edit-layout-modal pr-0 " id="addCredit" role="dialog" aria-labelledby="expenseEditLabel"
        aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCreditLabel">Save Credit Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" method="POST" action="{{route('credit.store')}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                       
                            <div class="form-group" id="expenseDescription" >
                                <label for="creditDescription">Credit Description</label>
                                <textarea type="text" id="creditDescription" name="creditDescription" class="form-control" placeholder="Enter credit description"></textarea>
                                @error('creditDescription')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Debitor Name:-</label>
                                <input name="payedPartnerName" type="text" class="form-control"
                                    placeholder="Enter Paid Partner's Name" required>
                                @error('payedPartnerName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Debitor Phone Number:-</label>
                                <input name="payedPartnerPhone" type="text" class="form-control"
                                    placeholder="Enter Paid Partner's Phone Number" required>
                                @error('payedPartnerPhone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                
                            <div class="form-group">
                                <label>Amount</label>
                                <input name="amount" type="number" class="form-control"
                                    placeholder="Enter Amount" required>
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
            
                        </div>
            
                    </form>
                </div>
            </div>
        </div>
        
    </div>