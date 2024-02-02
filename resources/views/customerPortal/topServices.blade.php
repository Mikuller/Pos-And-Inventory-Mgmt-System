<section class="ratio_asos overflow-hidden">
    <!-- category section start -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="title title-2 text-center">
                    <h2>Our services</h2>
                    <h5 class="text-color">Top service Types</h5>
                </div>
            </div>
        </div>
        <div class="row gy-3">
            <div class="col-xxl-2 col-lg-3">
                <div class="category-wrap category-padding category-block theme-bg-color">
                    <div>
                        <h2 class="light-text">Top</h2>
                        <h2 class="top-spacing">Our Top</h2>
                        <span>Services</span>
                    </div>
                </div>
            </div>
            <div class="col-xxl-10 col-lg-9">
                <div class="category-wrapper category-slider1 white-arrow category-arrow">
                    
                    @forelse ($serviceTypes as $serviceType)
                        <div>
                            <a href="shop-left-sidebar.html" class="category-wrap category-padding">
                                <img src="{{ $serviceType->getImageURL() }}" class="bg-img blur-up lazyload"
                                    alt="category image">
                                <div class="category-content category-text-1">
                                    <h3 class="theme-color">{{ $serviceType->name }}</h3>
                                </div>
                            </a>
                        </div> 
                    @empty
                        <div>
                            <div class="category-content category-text-1">
                                <h3 class="theme-color">No Services Yet</h3>
                            </div>
                        </div>
                    @endforelse                
                  

                </div>
            </div>
        </div>
    </div>

</section>
