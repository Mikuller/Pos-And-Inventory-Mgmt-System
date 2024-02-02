<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header row">
                <div class="col col-sm-2">
                    <a href="/sales/pos" class="btn btn-primary btn-rounded">Add Sale</a>
                </div>
                <div class="col col-sm-1">
                    

                </div>
                <div class="col col-sm-6">
                    <div class="card-search with-adv-search dropdown">
                        <form action="">
                            <input type="text" wire:model.live.debounce.500ms="search"
                                class="form-control global_filter" id="global_filter" placeholder="Search with customer name.."
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
                <div class="col col-sm-3">
                    <div class="card-options text-right">
                        <span class="mr-5" id="top">{{ $sales->links() }}</span>
                        
                    </div>
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
                        @foreach ($sales as $index=>$sale)
                            @php
                                 $seller = App\Models\User::all()->find($sale->sellerID);
                            @endphp
                            <tr>
                               
                                <td>{{$index+1}}</td>
                                <td>{{$sale->customerName}}</td>

                                <td>{{$seller->name}}</td>
                                <td>{{$sale->created_at->diffForHumans()}}</td>
                                <td>{{$sale->grandTotal}}</td>

                                <td>{{$sale->paymentMethod}}</td>
                                <td>
                                    <div class="text-center">
                                        {{-- <a href="#"><i class="m-2 fa fa-print" aria-hidden="true"></i></a> --}}
                                        <a class="btn btn-sm btn-success ml-2" href="{{route('sales.show',['sale'=>$sale->id])}}"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-sm btn-danger" href="{{route('sales.destroy',['sale'=>$sale->id])}}" onclick="confirmation(event)"><i class="ik ik-trash-2"></i></a>
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
