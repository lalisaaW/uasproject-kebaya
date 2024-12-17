@extends('userpage.layout.main')
@section('content')
    <div class="container-fluid bg-primary d-flex align-items-center mb-5 py-5" id="home" style="min-height: 100vh;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 px-5 pl-lg-0 pb-5 pb-lg-0">
                    <img class="img-fluid w-100 rounded-circle shadow-sm" src="{{ asset('assets/images/faces/Kebaya 2.jpeg') }}"
                        alt="">
                </div>
                <div class="col-lg-7 text-center text-lg-left">
                    <h1 class="display-3 text-uppercase text-primary mb-2" style="-webkit-text-stroke: 2px #ffffff;">
                        EWARDROBE</h1>
                    <h1 class="typed-text-output d-inline font-weight-lighter text-white"></h1>
                    <div class="typed-text d-none">Kebaya Bali, Kebaya Kutu baku, Kebaya Sunda, Kebaya Jawa</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-fluid py-5" id="about">
        <div class="container">
            <div class="position-relative d-flex align-items-center justify-content-center">
                <h1 class="display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">About</h1>
                <h1 class="position-absolute text-uppercase text-primary">About Us</h1>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 pb-4 pb-lg-0">
                    <img class="img-fluid rounded w-100" src="{{ asset('assets/images/faces/mee2.jpeg') }}" alt="">
                </div>
                <div class="col-lg-7">
                    <h3 class="mb-4">Kebaya Modern, Kebaya Tradisional, Kebaya Wisuda</h3>
                    <p>Selamat datang di EWARDROBE , toko penyewaan kebaya untuk berbagai acara spesial seperti pernikahan, wisuda, lamaran, dan pesta. Kami menyediakan kebaya berkualitas dengan desain tradisional dan modern, beragam ukuran, warna, dan model.

                        Didukung layanan fitting gratis dan pemesanan mudah, kami siap menyempurnakan penampilan Anda di momen istimewa.</p>
                    <div class="row mb-3">
                        <div class="col-sm-6 py-2">
                            <h6>Buka: <span class="text-secondary">Setiap Hari</span></h6>
                        </div>
                        <div class="col-sm-6 py-2">
                            <h6>Open Fitting: <span class="text-secondary">09.00-19.30</span></h6>
                        </div>
                        <div class="col-sm-6 py-2">
                            <h6>Alamat: <span class="text-secondary">Jl. Gubeng Kertajaya XIII E No.23a, Surabaya, Indonesia 60282</span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <!-- About End -->

    {{-- <!-- Contact Start -->
    <div class="container-fluid py-5" id="contact">
        <div class="container">
            <div class="position-relative d-flex align-items-center justify-content-center">
                <h1 class="display-1 text-uppercase text-white" style="-webkit-text-stroke: 1px #dee2e6;">Contact</h1>
                <h1 class="position-absolute text-uppercase text-primary">Contact Me</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form text-center">
                        <div id="success"></div>
                        <form name="sentMessage" id="contactForm" novalidate="novalidate">
                            <div class="form-row">
                                <div class="control-group col-sm-6">
                                    <input type="text" class="form-control p-4" id="name" placeholder="Your Name"
                                        required="required" data-validation-required-message="Please enter your name" />
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group col-sm-6">
                                    <input type="email" class="form-control p-4" id="email" placeholder="Your Email"
                                        required="required" data-validation-required-message="Please enter your email" />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <input type="text" class="form-control p-4" id="subject" placeholder="Subject"
                                    required="required" data-validation-required-message="Please enter a subject" />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group">
                                <textarea class="form-control py-3 px-4" rows="5" id="message" placeholder="Message" required="required"
                                    data-validation-required-message="Please enter your message"></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div>
                                <button class="btn btn-outline-primary" type="submit" id="sendMessageButton">Send
                                    Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
