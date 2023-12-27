<div class="col-md-12">
    <form class="forms-sample" method="POST" action="">
        <input type="hidden" name="_token" value="k4JC0rIKsVlV9AR9NCn4JfVS7hvobvmKTZm9pwR6">
        <div class="row">

            <div class="col-md-3 pr-0">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" class="form-control datetimepicker-input" id="datepicker"
                                data-toggle="datetimepicker" data-target="#datepicker" placeholder="Select Date">
                        </div>
                        <div class="form-group">
                            <label>Supplier Name</label>
                            <input type="text" class="form-control" placeholder="Enter Supplier's Name">
                        </div>
                        <div class="form-group">
                            <label>Purchase Note</label>
                            <textarea class="form-control h-123" name="note" placeholder="Enter Note"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <select wire:model="selectedProduct" wire:change="updatePurchaseTable($event.target.value)" class="form-control "  >
                                        <option value=""  selected>Select Product </option>
                                        @forelse ($products as $product)
                                             <option  wire:key={{$product->id}} value="{{ $product->id }}">{{ $product->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1 pl-1 pt-1">
                                <a class="btn btn-sm btn-primary" href="/products/create">+</a>
                            </div>
                        </div>

                        <div class="Purchasestable">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="wp-10">SL</th>
                                        <th class="wp-40">Product</th>
                                        <th class="wp-20 text-center">Unit Price</th>
                                        <th class="wp-15">Qty</th>
                                        <th class="wp-15">Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchaseList as $product)
                                       <livewire:purchase-item  :$product :key="$product->id" />
                                    
                                    @endforeach


                                    <tr>
                                        <th class="border-0" colspan="3"></th>
                                        <th>Total</th>
                                        <th class="text-right">$ 620.00</th>
                                    </tr>
                                    <tr>
                                        <td class="border-0" colspan="3"></td>
                                        <td>Tax (<span id="tax-per">10.00</span>%)</td>
                                        <td class="text-right">$ 62.00</td>
                                    </tr>
                                    <tr>
                                        <td class="border-0" colspan="3"></td>
                                        <td>Shipping</td>
                                        <td class="text-right"><input type="text" name="shiping"
                                                class="form-control w-60 text-center hm-30 ml-auto" value="50.00"></td>
                                    </tr>
                                    <tr>
                                        <td class="border-0" colspan="3"></td>
                                        <td>Discount</td>
                                        <td class="text-right"><input type="text" name="discount"
                                                class="form-control w-60 text-center hm-30 ml-auto" value="0.00"></td>
                                    </tr>
                                    <tr>
                                        <th class="border-0" colspan="3"></th>
                                        <th>Grand Total</th>
                                        <th class="text-right">$ 732.00</th>
                                    </tr>
                                    <tr>
                                        <td class="border-0" colspan="2"></td>
                                        <td class="border-0" colspan="2">
                                            <div class="form-group">
                                                <select class="form-control" name="Purchase_status">
                                                    <option selected="">Select Status</option>
                                                    <option value="ordered">Ordered</option>
                                                    <option value="recived">Recieved</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="border-0">
                                            <div class="form-group">
                                                <div type="submit" class="btn btn-primary wp-100">Save</div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
