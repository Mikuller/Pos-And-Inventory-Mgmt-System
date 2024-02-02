<div class="pos-container p-3 pt-0">
    <div class="row">
        
        {{-- @include('pos.sidebar') --}}
        
        <div class="col-9 bg-white">
            <div class="customer-area">

        @include('pos.sales-counter')

            </div>
            
        </div>
        
       
        @include('pos.cart-area')

        @include('pos.invoice-modal')
        
    </div>

</div>