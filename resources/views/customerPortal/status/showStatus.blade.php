<section class="contact-section">
    <div class="row">
        
        <div class="col-8 mx-auto text-center">
            
            @if ($service != null)
            <div class="col-8 mx-auto position-relative contact-details">
                <a href="{{route('customerPortal.index')}}" class="btn btn-sm btn-primary float-start"><span aria-hidden="true">×</span></a>

                <div class="mx-auto">

                    <h2>Thank You For Choosing Us</h2>
                    <h5 class="font-light d-flex">We're open for any suggestion or just to have a chat</h5>

                    <div class="contact-box">
                        <div class="contact-icon">
                            <i data-feather="user"></i>
                        </div>
                        <div class="contact-title">
                            <h4>Customer Name:</h4>
                            <strong><span class="theme-color">{{ $service->customerName }}</span></strong>
                        </div>
                    </div>

                    <div class="contact-box">
                        <div class="contact-icon">
                            <i data-feather="phone"></i>
                        </div>
                        <div class="contact-title">
                            <h4>Phone Number :</h4>
                            <strong><span class="theme-color">{{ $service->customerPhone }}</span></strong>
                        </div>
                    </div>

                    <div class="contact-box">
                        <div class="contact-icon">
                            <i data-feather="activity"></i>
                        </div>
                        <div class="contact-title">
                            <h4>Service Types :</h4>
                            @foreach ($service->serviceTypes as $serviceType)
                                <strong><span class="theme-color">
                                        <p>{{ $serviceType->name }}</p>
                                    </span></strong>
                            @endforeach

                        </div>
                    </div>
                    <div class="contact-box">
                        <div class="contact-icon">
                            <i data-feather="dollar-sign"></i>
                        </div>
                        <div class="contact-title">
                            <h4>Service Price :</h4>
                            <strong><span class="theme-color">{{ $service->price }}</span></strong>
                        </div>
                    </div>
                    <div class="contact-box">
                        <div class="contact-icon">
                            <i data-feather="flag"></i>
                        </div>
                        <div class="contact-title">
                            <h4>Service Status :</h4>
                            <strong><span
                                    class="badge theme-color bg-theme new-badge rounded-pill ms-auto bg-dark">{{ $service->status }}</span></strong>
                        </div>
                    </div>
                    <div class="contact-box">
                        <div class="contact-icon">
                            <i data-feather="info"></i>
                        </div>
                        <div class="contact-title">
                            <h4>Status Note :</h4>
                            <strong><span class="theme-color"> {{ $service->statusNote }}</span></strong>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <span class="text-danger">No Service is registered with the given refrence number!!</span>
            @endif
        
            
        </div>
    </div>
</section>
