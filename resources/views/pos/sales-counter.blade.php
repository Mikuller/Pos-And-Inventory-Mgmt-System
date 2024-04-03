<div>
    @include('pos.pos-header')

    <div class="row pos-products layout-wrap" id="layout-wrap">

        <!-- include product preview page -->
        @forelse ($products as $product)
            <div wire:key={{ $product->id }}
                class="col-xl-3 col-lg-4 col-12 col-sm-6 mb-2 list-item list-item-grid p-2">
                <div class="card mb-1 pos-product-card">
                    <div class="d-flex card-img">
                        <img src="{{ $product->getImageURL() }}" alt="{{ $product['name'] }}"
                            class="list-thumbnail responsive border-0">
                    </div>
                    <div class="p-2">
                        <p>{{ $product['name'] }} <small class="text-muted">{{ $product['category_name'] }}</small> </p>
                        <span class="product-price"><span
                                class="price-symbol">$</span>{{ $product['sellingPrice'] }}</span>
                        @if ($product->quantity >= 1)
                            @if (!key_exists($product->id, $cart))
                                <form class="float-right" wire:submit.prevent="countCart({{ $product->id }})">
                                    <button type="submit" class="btn-sm {{ ($product->quantity <= $product->stockAlert) ? 'btn-danger' : 'btn-primary' }}  "><i class="fa fa-cart-plus"
                                            aria-hidden="true"></i></button>
                                </form>
                            @endif
                        @else
                            <button class="align-right btn-sm btn-danger" onclick="message(event)">StockOut <i class="align-right fa fa-exclamation-triangle" aria-hidden="true"></i></button>
                        @endif


                        {{-- @if ($product['offer_price'])
                        <span class="product-price"><span
                                class="price-symbol">$</span>{{ $product['offer_price'] }}</span> <small
                            class="text-red font-15"><s>{{ $product['regular_price'] }}</s></small>
                    @else --}}

                        {{-- @endif --}}
                    </div>
                </div>
            </div>
        @empty
            <span class=" b-b-primary text-primary text-center">
                <p>No Products To sell, Please Add products and Come back</p>
            </span>
        @endforelse

    </div>
</div>
