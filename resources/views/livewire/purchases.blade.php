<div id="main" class="col-md-12">

    <input type="hidden" name="_token" value="k4JC0rIKsVlV9AR9NCn4JfVS7hvobvmKTZm9pwR6">
    <div class="row">
        <div class="col-md-3 pr-0">
            <div class="card mb-0">

                @isset($products)

                    <form wire:submit.prevent="addPurchase">
                        <div class="card-body">


                            <div class="form-group">

                                <div class="row">
                                    <div class="col-sm-10 pr-0">
                                        <label>Product</label>
                                        <select wire:model="product" class="form-control">
                                            <option selected="selected" value="">Select Product</option>
                                            @forelse ($products as $product)
                                                <option wire:key={{ $product->id }} value="{{ $product->id }}">
                                                    {{ $product->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>

                                    </div>
                                    <div class="col-sm-2 pl-1 pt-1">
                                        <a href="{{ route('product.create') }}"> <button type="button"
                                                class="mt-4 btn btn-sm btn-primary">+</button> </a>
                                    </div>

                                </div>

                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input wire:model="quantity" type="number" class="form-control"
                                    placeholder="Enter Quantity" value="0">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-danger btn-checkout btn-pos-checkout" type="submit">ADD
                                    PURCHASE</button>
                            </div>
                        </div>
                    </form>
                @else
                @endisset

            </div>
        </div>
        <div class="col-md-9">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5 pl-1 ">
                            <div class="form-group">
                                <label>Purchase Note</label>
                                <textarea wire:model="purchaseNote" class="form-control h-8" name="note" placeholder="Enter Note"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Supplier Name</label>
                                    <input wire:model="supplierName" type="text" class="form-control text-input">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="Purchasestable">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="wp-10">Action</th>
                                    <th class="wp-10">SL</th>
                                    <th class="wp-30">Product</th>
                                    <th class="wp-20 text-center">Unit Price</th>
                                    <th class="wp-15">Qty</th>
                                    <th class="wp-15">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchaseList as $index => $purchase)
                                    <tr>
                                        <th>
                                            <button wire:click="removePurchaseItem({{ $index }})"
                                                class="btn btn-sm btn-danger"><i class="ik ik-trash-2"></i></button>
                                        </th>
                                        <td>{{ $index + 1 }}</td>
                                        <td> <img src="{{ $purchase['product']->getImageURL() }}" alt=""
                                                class="img-fluid img-20">
                                            {{ $purchase['product']->name }}</td>
                                        <td><input type="text" name="price"
                                                class="form-control w-100 text-center hm-30"
                                                value="{{ number_format($purchase['product']->purchasePrice) }}"
                                                readonly></td>
                                        <td><input type="number" name="Quantity"
                                                class="form-control w-60 text-center hm-30"
                                                value={{ number_format($purchase['quantity']) }} readonly></td>
                                        <td class="text-right">
                                            {{ number_format($purchase['quantity'] * ($purchase['product']->purchasePrice)) }}
                                        </td>
                                    </tr>
                                @endforeach


                                {{-- <tr>
                                    <th class="border-0" colspan="4"></th>
                                    <th>Total</th>
                                    <th class="text-right">{{ number_format($totalPrice) }}</th>
                                </tr> --}}
                                {{-- <tr>
                                    <td class="border-0" colspan="4"></td>
                                    <td>Tax (<span id="tax-per">15</span>%)</td>
                                    <td class="text-right">{{ number_format($totalTax) }}</td>
                                </tr> --}}
                                <tr>
                                    <td class="border-0" colspan="4"></td>
                                    <td>Shipping</td>
                                    <td class="text-right"><input type="text" name="shiping"
                                            class="form-control w-60 text-center hm-30 ml-auto" wire:model="shippingCost"></td>
                                </tr>
                                {{-- <tr>
                                        <td class="border-0" colspan="3"></td>
                                        <td>Discount</td>
                                        <td class="text-right"><input type="text" name="discount"
                                                class="form-control w-60 text-center hm-30 ml-auto" value="0.00"></td>
                                    </tr> --}}
                                <tr>
                                    <th class="border-0" colspan="4"></th>
                                    <th>Grand Total</th>
                                    <th wire:model="grandTotal" class="text-right">{{ number_format($grandTotal) }}
                                    </th>
                                </tr>
                                <tr>

                                    <td class="border-0" colspan="5">
                                        <div class="form-group">
                                            <select wire:model="status" class="form-control">
                                                <option selected="">Select Status</option>
                                                <option value="Paid">Paid</option>
                                                <option value="Unpaid">Unpaid</option>
                                            </select>
                                        </div>
                                    </td>
                                    @if (count($purchaseList)>0)
                                    <td class="border-0">
                                        <form wire:submit.prevent="storePurchase">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary wp-100">Save</button>
                                            </div>
                                        </form>
                                    </td> 
                                    @endif
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
