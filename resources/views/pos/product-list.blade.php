<div class="row pos-products layout-wrap" id="layout-wrap">
    <!-- include product preview page -->
    @foreach ($products as $product)
        <div class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-2 list-item list-item-grid p-2">
            <div class="card mb-1 pos-product-card" data-info="{{ htmlentities(json_encode($product)) }}">
                <div class="d-flex card-img">
                    <img src="{{ $product->getImageURL() }}" alt="{{ $product['name'] }}"
                        class="list-thumbnail responsive border-0">
                </div>
                <div class="p-2">
                    <p>{{ $product['name'] }} <small class="text-muted">{{ $product['category_name'] }}</small> </p>
                    <span class="product-price"><span class="price-symbol">$</span>{{ $product['sellingPrice'] }}</span>
                    {{-- @if ($product['offer_price'])
                        <span class="product-price"><span
                                class="price-symbol">$</span>{{ $product['offer_price'] }}</span> <small
                            class="text-red font-15"><s>{{ $product['regular_price'] }}</s></small>
                    @else --}}
                        
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    @endforeach
</div>
