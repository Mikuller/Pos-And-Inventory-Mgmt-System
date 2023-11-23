
<div class="modal fade edit-layout-modal pr-0" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @if(session('product'))
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">{{ session('product')->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">X</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-4">
                        <img src="{{session('product')->getImageURL() }}" class="img-fluid" alt="">
                        {{-- <div class="other-images">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src="../img/widget/p2.jpg" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-sm-4">
                                            <img src="../img/widget/p2.jpg" class="img-fluid" alt="">
                                        </div>
                                        <div class="col-sm-4">
                                            <img src="../img/widget/p2.jpg" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                </div> --}}
                    </div>
                    <div class="col-8">
                        <p>
                        </p>
                        @foreach (session('product')->categories as $category)
                            <div class="badge badge-pill badge-dark">{{ $category->name }}</div>
                        @endforeach

                        <p>
                        </p>
                        <h3 class="text-danger">
                           $ {{ session('product')->sellingPrice }}
                            <del class="text-muted f-16">$ 1250</del>
                        </h3>
                        <p class="text-green">Purchase Price: $ {{session('product')->purchasePrice}}</p>
                        <p>{{ session('product')->description }}</p>
                        <p>In Stock: {{ session('product')->quantity }}</p>
                        {{-- <p>Spplier: PZ Tech</p> --}}
                    </div>
                </div>
                <h5><strong>Sales</strong></h5>
                <div id="line_chart" class="chart-shadow"></div>

            </div>
            @endif
        </div>
    </div>
</div>
