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
                                <input wire:model.live="selectedDate" class="form-control" type="date" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select wire:model.live="selectedBank" class="form-control" name="depositBank" required>
                                    <option value="" selected>By Bank info</option>
                                    @forelse ($depositBank as $bank)
                                        <option wire:key="{{ $bank->id }}" value="{{ $bank->id }}">
                                            {{ $bank->bankName . ' :' . $bank->accNum }}</option>
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
                        <h5 class="text-primary float-left">Total Revenue: {{ number_format($sales->sum('grandTotal')) }} </h5>
                        <div class="float-left ml-3" >
                            <label for="cash1" class="mt-1"> <input type="checkbox" id="cash1" wire:model.live="cash" > Cash</label>             
                            <label for="e-cash" class="d-block "> <input type="checkbox" id="e-cash" wire:model.live="eCash" > E-Cash</label>                          
                        </div>
                    </thead>
                    <thead>
                        <tr>
                            <th class="nosort">No.</th>
                            <th>Seller Name</th>
                            <th>DateTime</th>
                            <th>Grand Total</th>
                            <th>Payment Method</th>
                            <th>Bank Info</th>
                            <th>Txn Refrence</th>
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
                                <td class="text-center">{{ $seller->name }}</td>
                                <td>{{ $sale->created_at->diffForHumans() }}</td>
                                <td class="text-center">{{ number_format($sale->grandTotal) }}</td>
                                <td class="text-center">
                                    @if ($sale->paymentMethod == 'Cash')
                                        <span class="badge badge-pill badge-success ">Cash</span>
                                    @else
                                        <span class="badge badge-pill badge-warning ">E-Cash</span>
                                    @endif
                                </td>

                                <td>{{ $sale->depositBank != null ? $sale->depositBank->bankName . ':' . $sale->depositBank->accNum : '-' }}
                                </td>
                                <td>{{ $sale->eCashRefNumber != null ? $sale->eCashRefNumber : '-' }}</td>
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
