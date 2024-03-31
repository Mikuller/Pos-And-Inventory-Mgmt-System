
<div class="modal fade edit-layout-modal pr-0" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog w-305" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Purchase Date: {{ date_format(session('purchase')->created_at, "F j, Y, g:i a") }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="">
                    
                    <div id="product-cart" class="product-cart mb-3">
                        @foreach (session('purchase')->products as $product)
                            <div class="d-flex justify-content-between position-relative">

                                <div class="cart-image-holder">
                                    <img src="{{ $product->getImageURL() }}">
                                </div>
                                <div class="w-100 p-2">
                                    <h5 class="mb-2 cart-item-title">{{ $product->name }}</h5>
                                    <div class="d-flex justify-content-between">

                                        <span class="text-muted m-0">{{ $product->pivot->amount }}</span>

                                        <span
                                            class="text-danger font-weight-bold cart-item-price">{{ number_format($product->purchasePrice * $product->pivot->amount) }}</span>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <div class="box-shadow p-3">
                        <div class="d-flex justify-content-between font-15 align-items-center">
                            <b>Grand Total</b>
                            <b id="total-bill"> {{ session('purchase')->grandTotal }}</b>
                        </div>
                        <div class="d-flex justify-content-between font-15 align-items-center mt-2">
                            <b>Shipping Cost</b>
                            <b id="total-bill"> {{  number_format(session('purchase')->shippingCost) }}</b>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between font-20 align-items-center">
                            <b>Total Cost</b>
                            <b id="total-bill"> {{  number_format(session('purchase')->grandTotal + session('purchase')->shippingCost) }}</b>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="col-12">
                              <a class="btn btn-sm btn-primary" href="{{route('purchases.generatePDF')}}"><i class="fa fa-download"></i>
                                Generate PDF</button> </a>
                        </div>
                    </div>
                  

                </div>
               

            </div>
            
        </div>
    </div>
</div>
