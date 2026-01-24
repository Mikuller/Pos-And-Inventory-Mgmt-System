<div class="col-sm-3 bg-white product-cart-area">
    <div class="product-selection-area">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0"> Order Details</h6>
                <i class="text-danger ik ik-refresh-ccw cursor-pointer font-15" wire:click="clearCart"></i>
        </div>
        <hr>
        <div id="product-cart" class="product-cart mb-3">

            @if ($cart != [])
                {{-- Uncomment to preview original cart html
            ==================================================== --}}

                @foreach ($cart as $key => $item)
                    @php
                        $product = App\Models\Product::find($key);
                        $quantity = is_array($item) ? $item['quantity'] ?? 0 : $item;
                        // default POS input to 0; do not expose product default here
                        $sellingPrice = is_array($item) ? ($item['sellingPrice'] ?? 0) : 0;
                    @endphp
                    @if ($product != null && $quantity > 0)
                        <div class="d-flex justify-content-between position-relative">

                            <i class="text-red ik ik-x-circle cart-remove cursor-pointer"
                                wire:click="removeCartItem({{ $product->id }})"></i>
                            <div class="cart-image-holder">
                                <img src="{{ $product->getImageURL() }}">
                            </div>
                            <div class="w-100 p-2">
                                <h5 class="mb-2 cart-item-title">{{ $product->name }}</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($product->quantity >= $quantity)
                                        <form wire:submit.prevent="addToCart({{ $product->id }})">
                                            <button type="submit" class="btn btn-primary btn-sm">+</button>
                                        </form>
                                    @endif

                                    <span class="mx-2 text-muted">{{ $quantity }}</span>


                                    <form wire:submit.prevent="removeFromCart({{ $product->id }})">
                                        <button type="submit" class="btn btn-primary btn-sm ">-</button>
                                    </form>


                                    <div class="d-flex align-items-center">
                                        <input type="number" step="0.01" min="0"
                                            class="form-control form-control-sm mr-2" style="width:90px"
                                            value="{{ $sellingPrice }}"
                                            wire:change="updateSellingPrice({{ $product->id }}, $event.target.value)">
                                        <span class="text-success font-weight-bold cart-item-price">
                                            {{ $sellingPrice > 0 ? number_format($sellingPrice * $quantity) : '' }}
                                        </span>
                                    </div>
                                </div>
                            </div>


                        </div>
                    @endif
                @endforeach


            @endif

        </div>


        <div class="box-shadow p-3">

            {{-- <div class="d-flex justify-content-between font-15 align-items-center">

                <span>Subtotal</span>
                <strong id="subtotal-products">0.00</strong>
            </div> 
            <div class="d-flex justify-content-between font-15 align-items-center">
                <span>Discount</span>
                <input class="form-control w-90 font-15 text-right" id="discount">
            </div> --}}
            <hr>
            <div class="d-flex justify-content-between font-20 align-items-center">
                <b>Grand Total</b>
                {{-- show grand total only when component computed a positive total from entered prices --}}
                <b id="total-bill">{{ $grandTotal > 0 ? number_format($grandTotal) : '' }}</b>
            </div>
        </div>

        @if ($cart != [])
            <form wire:submit="openModal">
                <div class="box-shadow p-3 mb-3">
                    <label class="d-block">Customer Information</label>
                    <div class="d-block">
                        <div class="form-group">
                            <input type="text" name="customerName" wire:model="customerName" class="form-control"
                                placeholder="Enter Customer Name" required>

                        </div>
                        <div class="form-group">
                            <input type="text" name="customerPhone" wire:model="customerPhone" class="form-control"
                                placeholder="Enter Phone" required>

                        </div>

                    </div>
                </div>

                <div class="box-shadow p-3">
                    <button class="btn btn-danger btn-checkout btn-pos-checkout " type="submit">PLACE ORDER</button>
                </div>
            </form>
        @endif
    </div>
</div>

</div>
