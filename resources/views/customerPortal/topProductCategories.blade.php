<section class="category-section ratio_40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="title title-2 text-center">
                    <h2>Our Category</h2>
                    <h5 class="text-color">Our Category collection</h5>
                </div>
            </div>
        </div>
        <div class="row gy-3">
            <div class="col-xxl-2 col-lg-3">
                <div class="category-wrap category-padding category-block theme-bg-color">
                    <div>
                        <h2 class="light-text">Top</h2>
                        <h2 class="top-spacing">Our Top Product Categories</h2>
                        <span>Categories</span>
                    </div>
                </div>
            </div>
            <div class="col-xxl-10 col-lg-9">
                <div class="category-wrapper category-slider1 white-arrow category-arrow">
                    @forelse ($categories as $category)
                        <div>
                           
                            <a href="#" class="category-wrap category-padding">
                                <img src="{{ $category->getImageURL() }}" class="bg-img blur-up lazyload"
                                    alt="category image">
                                <div class="category-content category-text-1  ">
                                    <h3 class="theme-color ">{{ $category->name }}</h3>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div>
                            <div class="category-content category-text-1">
                                <h3 class="theme-color">No Categories Yet</h3>
                            </div>
                        </div>
                    @endforelse


                </div>
            </div>
        </div>
    </div>
</section>
<!-- category section end -->
