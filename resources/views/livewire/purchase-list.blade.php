<div class="row">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header row">
                <div class="col col-sm-2">
                    <a href="{{ route('purchases.create') }}" class="btn btn-primary btn-rounded">Add Purchase</a>
                </div>
                {{-- <div class="col col-sm-2">
                    <div class="card-options d-inline-block">
                        <div class="dropdown d-inline-block">
                            <input type="text" wire:model.live.debounce.500ms="dateSearch"
                                class="form-control datetimepicker-input" placeholder="Select Date">
                           


                        </div>
                    </div>

                </div> --}}
                <div class="col col-sm-5">
                    <div class="card-search with-adv-search dropdown">
                        <form action="">
                            <input type="text" wire:model.live.debounce.500ms="search"
                                class="form-control global_filter" id="global_filter" placeholder="Search with any Attribute.."
                                required="">
                            
                            <button type="button" id="adv_wrap_toggler"
                                class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"></button>
                            <div class="adv-search-wrap dropdown-menu dropdown-menu-right"
                                aria-labelledby="adv_wrap_toggler">
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Filter With Date</label>
                                            <input wire:model.live.debounce.500ms="selectedDate" class="form-control" type="date" required />
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="card-body">
                <table id="advanced_table" class="table">
                    <thead>
                        <tr>
                            
                            <th class="text-center">ID</th>
                            <th>Supplier</th>
                            <th class="text-center">Grand Total</th>
                            <th class="text-center">Shipping Cost</th>
                            <th class="text-center">Purchase DateTime</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($purchases as $purchase)
                            <tr>
                                
                                <td>{{ $purchase->id }}</td>
                                <td>
                                    @if ($purchase->supplierName == null)
                                        Unknown
                                    @else
                                        {{ $purchase->supplierName }}
                                    @endif
                                </td>
                                <td class="text-center">{{ $purchase->grandTotal }}</td>
                                <td class="text-center">{{ $purchase->shippingCost }}</td>
                                <td class="text-center">{{ $purchase->created_at->diffForHumans() }}</td>
                                <td class="text-center">
                                    @if ($purchase->status == 'Paid')
                                        <span class="badge badge-pill badge-success mb-1">Paid</span>
                                    @else
                                        <span class="badge badge-pill badge-danger mb-1">Unpaid</span>
                                    @endif

                                </td>
                                <td>
                                    <div class="text-center">
                                        {{-- <a href="#"><i class="m-2 fa fa-print" aria-hidden="true"></i></a> --}}
                                        <a class="btn btn-sm btn-success ml-2" href="{{ route('purchases.show', ['purchase' => $purchase->id]) }}"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-sm btn-danger" href="{{ route('purchases.destroy', ['purchase' => $purchase->id]) }}" onclick="confirmation(event)"><i class="ik ik-trash-2"></i></a>
                                    </div>
                                    
                                </td>
                            </tr>
                        @empty
                            <span class=" b-b-primary text-primary text-center">
                                <p>No Purchases Were made!!</p>
                            </span>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="col col-sm-3 ">
                {{ $purchases->links() }}
            </div>
        </div>
    </div>

</div>
