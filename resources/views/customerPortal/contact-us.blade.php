<!-- Contact Section Start -->
<section class="contact-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="materialContainer">
                    <div class="material-details">
                        <div class="title title1 title-effect mb-1 title-left">
                            <h2>Contact Us</h2>
                            <p class="ms-0 w-100">Your email address will not be published. You can also be anonymous
                            </p>
                        </div>
                    </div>
                    <form method="GET" action="{{route('store.comment')}}" >
                        @csrf
                        <div class="row g-4 mt-md-1 mt-2">
                            <div class="col-md-6">
                                <label for="first" class="form-label">Full Name</label>
                                <input type="text" name="senderName" class="form-control" id="first"
                                    placeholder="Enter Your Full Name">
                               
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="senderEmail" class="form-control" id="email"
                                    placeholder="Enter Your Email Address">
                               
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phoneNumber" class="form-control" id="phone"
                                    placeholder="Enter Your Phone Number">
                               
                            </div>

                            <div class="col-12">
                                <label for="message" class="form-label">Comment *</label>
                                <textarea name="message" class="form-control" id="message" rows="5" required></textarea>
                                @error('message')
                               
                                    <span class="text-danger">{{ $message }}</span>
                               
                            @enderror
                            </div>

                            <div class="col-auto">
                                <button class="btn btn-solid-default" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="contact-details">
                    <div>
                        <h2>Let's get in touch</h2>
                        <h5 class="font-light">We're open for any suggestion </h5>
                        <div class="contact-box">
                            <div class="contact-icon">
                                <i data-feather="map-pin"></i>
                            </div>
                            <div class="contact-title">
                                <h4>Address :</h4>
                                <p> Franko, Ekele Mall , Adama , Ethiopia </p>
                            </div>
                        </div>

                        <div class="contact-box">
                            <div class="contact-icon">
                                <i data-feather="phone"></i>
                            </div>
                            <div class="contact-title">
                                <h4>Phone Number :</h4>
                                <p>+1 0000000000</p>
                            </div>
                        </div>

                        <div class="contact-box">
                            <div class="contact-icon">
                                <i data-feather="mail"></i>
                            </div>
                            <div class="contact-title">
                                <h4>Email Address :</h4>
                                <p>fitsaMobile@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->
