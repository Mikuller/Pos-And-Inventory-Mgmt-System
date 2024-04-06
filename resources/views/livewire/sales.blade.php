<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header row">
                <div class="col col-sm-2">
                    <a href="/sales/pos" class="btn btn-primary mb-2 ">Add Sale</a>
                </div>
                
                <div class="col col-sm-6">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" wire:model.live.debounce.500ms="search" class="form-control"
                                placeholder="Search with customer name.." required="">
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input wire:model.live="selectedDate" class="form-control" type="date"
                                    required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                               <select wire:model.live="selectedBank" class="form-control" name="depositBank" required>
                                <option value="" selected>By Bank info</option>
                                @forelse ($depositBank as $bank)
                                    <option wire:key="{{$bank->id}}" value="{{$bank->id}}">{{$bank->bankName." :".$bank->accNum}}</option>
                                @empty
                                    
                                @endforelse
    
                               </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-sm-3 ">
                   {{ $sales->links() }}

                    
                </div>
            </div>
            <div class="card-body">
                <table id="advanced_table" class="table">
                    <thead>
                        <tr>

                            <th class="nosort">No.</th>
                            <th>Customer Info</th>

                            <th>Seller Name</th>
                            <th>Transaction DateTime</th>
                            <th>Grand Total</th>

                            <th>Payment Method</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $index => $sale)
                            @php
                                $seller = App\Models\User::all()->find($sale->sellerID);
                            @endphp
                            <tr>

                                <td>{{ $index + 1 }}</td>
                                <td>{{ $sale->customerName }}</td>

                                <td>{{ $seller->name }}</td>
                                <td>{{ $sale->created_at->diffForHumans() }}</td>
                                <td>{{ $sale->grandTotal }}</td>

                                <td>{{ $sale->paymentMethod }}</td>
                                <td>
                                    <div class="text-center">
                                        {{-- <a href="#"><i class="m-2 fa fa-print" aria-hidden="true"></i></a> --}}
                                        <a class="btn btn-sm btn-success ml-2"
                                            href="{{ route('sales.show', ['sale' => $sale->id]) }}"><i
                                                class="fa fa-eye"></i></a>
                                        <a class="btn btn-sm btn-danger"
                                            href="{{ route('sales.destroy', ['sale' => $sale->id]) }}"
                                            onclick="confirmation(event)"><i class="ik ik-trash-2"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
