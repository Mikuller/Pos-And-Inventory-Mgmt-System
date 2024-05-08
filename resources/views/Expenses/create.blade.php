<div class="col-md-3 pr-0">
    <div class="card mb-0">
        <form class="forms-sample" wire:submit.prevent="store">
            <div class="card-body">
                <div class="form-group" id="expenseReasonWrapper">
                    <label>Expense Reason</label>
                    <select wire:model.live="expenseReason" name="expenseReason" id="expenseReason" class="form-control"
                        required>
                        <option value="" selected disabled>Select Expense Reason</option>
                        <option value="Salary">Salary</option>
                        <option value="Food">Food</option>
                        <option value="Transport">Transport</option>
                        <option value="Rent">Rent</option>
                        <option value="Service">Service</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('expenseReason')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                @if ($services != '')
                    <div class="form-group" id="serviceIDs">
                        <label for="serviceId">Service ID</label>
                        <select class="form-control" wire:model="serviceId" name="serviceId" id="serviceId">
                            <option value="" selected disabled>Select service Refrence num</option>
                            @foreach ($services as $service)
                                <option wire:key={{ $service->id }} value="{{ $service->id }}">
                                    {{ $service->refNumber }}
                                </option>
                            @endforeach
                        </select>
                        @error('serviceIDs')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                <div class="form-group" id="expenseDescription">
                    <label for="expenseDescription">Expense Description</label>
                    <textarea wire:model="expenseDescription" type="text" id="expenseDescription" name="expenseDescription"
                        class="form-control" placeholder="Enter custom reason" required></textarea>
                    @error('expenseDescription')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="d-block">PAID TO:-</label>
                    <label class="d-inline" for="payedPartnerName" >Name:   <input wire:model="payedPartnerName" id="payedPartnerName" name="payedPartnerName" type="text" class="d-inline form-control "
                        placeholder="Enter Paid Partner's Name" required></label>
                    @error('payedPartnerName')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <label class="d-inline" for="payedPartnerPhone" >Phone: </label> <input wire:model="payedPartnerPhone" id="payedPartnerPhone"  name="payedPartnerPhone" type="number" class="form-control d-inline"
                        placeholder="Enter Partner's Phone Number">
                    @error('payedPartnerPhone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="d-block">Payment Status</label>
                    <label class="ml-2" for="paid"><input type="radio" wire:model="status" name="status"
                            id="paid" value="Paid" required /> Paid</label><br />
                    <label class="ml-2" for="unpaid"><input type="radio" wire:model="status" name="status"
                            id="unpaid" value="Unpaid" required /> Unpaid</label><br />
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Amount</label>
                    <input wire:model="amount" name="amount" type="number" class="form-control"
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
