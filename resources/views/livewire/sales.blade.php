<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header row">
                <div class="col col-sm-2">
                    <a href="/sales/pos" class="btn btn-primary btn-rounded">Add Sale</a>
                </div>
                <div class="col col-sm-1">
                    <div class="card-options d-inline-block">
                        <div class="dropdown d-inline-block">
                            <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="ik ik-more-horizontal"></i></a>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="moreDropdown">
                                <a class="dropdown-item" href="#">Delete</a>
                                <a class="dropdown-item" href="#">More Action</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col col-sm-6">
                    <div class="card-search with-adv-search dropdown">
                        <form action="">
                            <input type="text" wire:model.live.debounce.500ms="search"
                                class="form-control global_filter" id="global_filter" placeholder="Search with customer name.."
                                required="">
                            <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                            <button type="button" id="adv_wrap_toggler"
                                class="adv-btn ik ik-chevron-down dropdown-toggle" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"></button>
                            <div class="adv-search-wrap dropdown-menu dropdown-menu-right"
                                aria-labelledby="adv_wrap_toggler">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control column_filter" id="col0_filter"
                                                placeholder="Reference No" data-column="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control column_filter" id="col1_filter"
                                                placeholder="Warehouse" data-column="1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control column_filter" id="col2_filter"
                                                placeholder="Customer" data-column="2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="sale_status">
                                                <option selected="">Select Sale Status</option>
                                                <option value="completed">Completed</option>
                                                <option value="shipped">Shipped</option>
                                                <option value="pending">Pending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control" name="sale_status">
                                                <option selected="">Select Payment Status</option>
                                                <option value="pending">Pending</option>
                                                <option value="due">Due</option>
                                                <option value="Paid">Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-theme">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="card-options text-right">
                        <span class="mr-5" id="top">{{ $sales->links() }}</span>
                        <a href="#"><i class="ik ik-chevron-left"></i></a>
                        <a href="#"><i class="ik ik-chevron-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="advanced_table" class="table">
                    <thead>
                        <tr>
                            <th class="nosort" width="10">
                                <label class="custom-control custom-checkbox m-0">
                                    <input type="checkbox" class="custom-control-input" id="selectall" name=""
                                        value="option2">
                                    <span class="custom-control-label">&nbsp;</span>
                                </label>
                            </th>
                            <th class="nosort">Reference No.</th>
                            <th>Customer Info</th>

                            <th>Seller's ID</th>
                            <th>Transaction DateTime</th>
                            <th>Grand Total</th>

                            <th>Payment Method</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input select_all_child"
                                            id="" name="" value="option2">
                                        <span class="custom-control-label">&nbsp;</span>
                                    </label>
                                </td>
                                <td><a href="#InvoiceModal" data-toggle="modal" data-target="#InvoiceModal"
                                        class=" font-weight-bold">{{$sale->id}}</a></td>
                                <td>{{$sale->customerName}}</td>

                                <td>{{$sale->sellerID}}</td>
                                <td>{{$sale->created_at->diffForHumans()}}</td>
                                <td>{{$sale->grandTotal}}</td>

                                <td>{{$sale->paymentMethod}}</td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <a class="nav-link dropdown-toggle" href="#" id="moreDropdown"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="ik ik-more-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="/sales/1/edit"><i class="ik ik-edit"></i>
                                                Edit </a>
                                            <a class="dropdown-item" href="#InvoiceModal" data-toggle="modal"
                                                data-target="#InvoiceModal">
                                                <i class="ik ik-file-text"></i>
                                                Preveiw Invoice
                                            </a>
                                            <a class="dropdown-item">
                                                <i class="ik ik-printer"></i>
                                                Invoice POS
                                            </a>
                                            <a class="dropdown-item">
                                                <i class="ik ik-mail"></i>
                                                Send on Email
                                            </a>

                                            <a class="dropdown-item" href="#">
                                                <i class="ik ik-trash"></i> Delete </a>
                                        </div>
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
