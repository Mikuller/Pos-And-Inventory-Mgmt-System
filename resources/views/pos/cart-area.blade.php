<div  class="col-sm-3 bg-white product-cart-area" >
    <div class="product-selection-area">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0"> Order Details</h6>
                <a href="{{url('/pos')}}"> <i class="text-danger ik ik-refresh-ccw cursor-pointer font-15" onclick="cleartCart() "></i> </a>
        </div>
        <hr>
        <div id="product-cart" class="product-cart mb-3">
            <!-- Uncomment to preview original cart html
            ====================================================
            <div class="d-flex justify-content-between position-relative">
                <i class="text-red ik ik-x-circle cart-remove cursor-pointer" onclick="removeCartItem(ID)"></i>
                <div class="cart-image-holder">
                    <img src="IMAGE_SRC">
                </div>
                <div class="w-100 p-2">
                    <h5 class="mb-2 cart-item-title">ITEM_NAME</h5>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">QUANTITYx</span>
                        <span class="text-success font-weight-bold cart-item-price">SUBTOTAL</span>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="box-shadow p-3">
            <div class="d-flex justify-content-between font-15 align-items-center">
                <span>Subtotal</span>
                <strong id="subtotal-products">0.00</strong>
            </div>
            <div class="d-flex justify-content-between font-15 align-items-center">
                <span>Discount</span>
                <input class="form-control w-90 font-15 text-right" id="discount">
            </div>
            <hr>
            <div class="d-flex justify-content-between font-20 align-items-center">
                <b>Total</b>
                <b id="total-bill">0.00</b>
            </div>
        </div>
        
        {{-- <div class="box-shadow p-3">
            
            <button wire:click="openModal"  type="submit" class="btn btn-danger btn-checkout btn-pos-checkout" >SELL</button>
        `
        </div> --}}
    </div>
    
</div>

