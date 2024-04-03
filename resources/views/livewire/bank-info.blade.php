<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3 pr-0">
                <div class="card mb-0">
                    <form wire:submit.prevent="storeBankInfo" class="forms-sample">

                        <div class="card-body">

                            <div class="form-group">
                                <label>Bank Name</label>
                                <input wire:model="bankName" name="bankName" type="text" class="form-control"
                                    placeholder="Enter Bank Name">
                                @error('bankName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Account Number</label>
                                <input wire:model="accNum" name="accNum" type="text" class="form-control"
                                    placeholder="Enter Acc Number">
                                @error('accNum')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card mb-0">
                    <div class="card-body">

                        <div class="card-body">
                            <table id="advanced_table" class="table">
                                <thead>
                                    <tr>
                                        <th class="wp-10">No</th>
                                        <th class="wp-20">Bank Name</th>
                                        <th class="wp-20">Account Number</th>
                                        <th class="wp-10 align-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($banks as $key=>$bank)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td> {{ $bank->bankName }}</td>
                                            <td>{{ $bank->accNum }}</td>

                                            <td>
                                                <div>
                                                    <button type="button" wire:click="destroy({{ $bank->id }})"
                                                        wire:confirm="Are you sure you want to delete this bank info?"
                                                        class="btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i> </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty

                                        <span class="text-danger">No Bank info is registered</span>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>


</div>
