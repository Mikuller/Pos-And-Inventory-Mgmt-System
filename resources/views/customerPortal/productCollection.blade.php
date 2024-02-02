<section class="ratio_asos overflow-hidden pb-5">
    <div class="px-0 container-fluid p-sm-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="title-3 text-center">
                    <h2>Products</h2>
                    <h5 class="theme-color">Our Product Collection</h5>
                </div>
            </div>

            <div class="our-product products-c">
                @forelse ($products as $product)
                    <div>
                        <div class="product-box">
                            <div class="img-wrapper">
                                <a href="product/details.html">
                                    <img src="{{$product->getImageURL()}}"
                                        class="w-100 bg-img blur-up lazyload" alt="">
                                </a>
                                <div class="circle-shape"></div>
                                <span class="background-text">{{$product->name}}</span>
                                <div class="label-block">
                                    <span class="label label-theme">30% Off</span>
                                </div>
                                
                            </div>
                            <div class="product-style-3 product-style-chair">
                                <div class="product-title d-block mb-0">
                                    <div class="r-price">
                                        <div class="theme-color">{{$product->sellingPrice}}</div>
                                        <div class="main-price">
                                            <ul class="rating mb-1 mt-0">
                                                <li>
                                                    <i class="fas fa-star theme-color"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star theme-color"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    {{-- <p class="font-light mb-sm-2 mb-0">{{$product->description }}</p> --}}
                                    <a href="product/details.html" class="font-default">
                                        <h5>{{$product->name}}</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse



            </div>
        </div>
    </div>
</section>