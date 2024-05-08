<div class="modal fade edit-layout-modal pr-0 " id="editDebt" role="dialog" aria-labelledby="expenseEditLabel"
        aria-hidden="true">
        <div class="modal-dialog w-300" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDebtLabel">Edit Debt Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form class="forms-sample" method="POST" action="{{route('debt.update',['debt'=>session('debt')->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                       
                            <div class="form-group" id="debtDescription" >
                                <label for="deptDescription">Debt Description</label>
                                <textarea type="text" id="deptDescription" name="deptDescription" class="form-control" placeholder="Enter debt description">{{session('debt')->deptDescription}}</textarea>
                                @error('deptDescription')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>Creditor's Name:-</label>
                                <input name="creditorName" type="text" class="form-control"
                                    placeholder="Enter Paid Partner's Name" value="{{session('debt')->creditorName}}" required>
                                @error('creditorName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Creditor's Phone Number:-</label>
                                <input name="creditorPhone" type="text" class="form-control"
                                    placeholder="Enter Paid Partner's Phone Number" value="{{session('debt')->creditorPhone}}" required>
                                @error('creditorPhone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                
                            <div class="form-group">
                                <label>Amount</label>
                                <input name="amount" type="number" class="form-control"
                                    placeholder="Enter Amount" value="{{session('debt')->amount}}" required>
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