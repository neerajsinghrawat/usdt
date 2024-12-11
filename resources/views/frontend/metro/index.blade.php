@extends('frontend.layouts.app')

@section('content')
 


    <!-- header body -->
    <div class="overflow-hidden position-relative">
       <img src="{{ static_asset('assets/usdt/assets/img/bg/bg1.jpg') }}" class="position-absolute z-n1 top-0 h-100 w-100 object-fit-cover" alt="Meeting">

       <div class="overlay position-absolute z-n1 top-0 h-100 w-100 bg-dark"
            style="opacity: 0.85; mix-blend-mode: multiply; filter: contrast(1.15) brightness(0.85);">
        </div>

        <div class="container">
            <div class="min-vh-100 row align-items-center">
                <div class="col-12 col-xl-8">
                    <div class="pt-9 pt-md-10 pt-xl-11 pb-7 pb-md-8 pb-xl-9 max-w-2xl mx-auto mx-xl-0">
                        <div class="mt-4 pt-2">
                            <div class="text-center text-xl-start">
                                <h1 class="m-0 text-white tracking-tight text-6xl fw-bold" data-aos-delay="0" data-aos="fade" data-aos-duration="3000">
                                    "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
                                </h1>
                                <p class="m-0 mt-4 text-white text-lg leading-8" data-aos-delay="100" data-aos="fade" data-aos-duration="3000">
                                    " Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                                </p>
                                <div class="mt-4 pt-3 d-flex align-items-center justify-content-center justify-content-xl-start column-gap-3">
                                    <a href="javascript:;" class="btn btn-lg btn-primary text-white text-sm fw-semibold" data-aos-delay="200" data-aos="fade" data-aos-duration="3000">
                                        Contact us
                                    </a>
                                    <a href="javascript:;" class="btn btn-lg text-white icon-link icon-link-hover bg-secondary-hover text-sm leading-6 fw-semibold" data-aos-delay="300" data-aos="fade" data-aos-duration="3000">
                                        Learn more 
                                        <span class="bi align-self-start left-to-right" aria-hidden="true">→</span>
                                        <span class="bi align-self-start right-to-left" aria-hidden="true">←</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-12 col-xl-4">
                    <div class="pt-3 pt-md-4 pt-xl-12 pb-2 pb-md-3 pb-xl-6">
                        <!-- Button trigger modal -->
                        <a class="video-play-button video-btn-modal position-relative" href="javascript:;"
                            data-bs-toggle="modal" data-bs-target="#videoModal"
                            data-bs-src="https://www.youtube.com/embed/EX0TcLgOPv0">
                            <span class="top-50 start-50 translate-middle"></span>
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>
    </div> 



    <!-- Modal to embed vidoes!! -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0" style="border-radius: 0.75rem;">
                <div class="modal-header border-0 p-0">
                    <button type="button" class="btn-close bg-white border position-absolute top-0 end-0 translate-middle me-n3 me-sm-n5 mt-n4 rounded-circle p-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item iframeVideo" style="border-radius: 0.75rem;" allow="autoplay"></iframe>
                    </div>
                </div>
                
            </div>
        </div>
    </div>



    <!-- services -->
    <div class="overflow-hidden py-7 py-sm-8 py-xl-9 bg-body-tertiary">
        <div class="container">
            <div>
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="m-0 text-primary-emphasis text-base leading-7 fw-semibold">
                        Our services
                    </h2>
                    <p class="m-0 mt-2 text-body-emphasis text-4xl tracking-tight fw-bold">
                        "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
                    </p>
                    <p class="m-0 mt-4 text-body text-lg leading-8">
                        " Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                    </p>
                </div>
            </div>
            <div>
                <div class="row row-cols-1 row-cols-xl-3 gy-5 gx-xl-4 mt-1 justify-content-center justify-content-xl-between">
                    <div class="col pt-5 pt-xl-4">
                        <div class="max-w-xl mx-auto mx-xl-0" data-aos-delay="0" data-aos="fade" data-aos-duration="1000">
                            <div class="ratio" style="--bs-aspect-ratio: 66.66%;">
                                <img src="{{ static_asset('assets/usdt/assets/img/bg/bg2.jpg') }}" class="object-fit-cover rounded-3" alt="Service image" loading="lazy">
                            </div>

                            <h3 class="m-0 mt-4 text-body-emphasis text-lg leading-6 fw-semibold">
                                " Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                            </h3>

                            <!-- Remove line-clamp-2 if you need more lines or add line-clamp-3 -->
                            <p class="m-0 mt-3 text-body-secondary line-clamp-2 text-sm leading-6">
                                " Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                            </p>
                        </div>
                    </div>
                    
                    <div class="col pt-5 pt-xl-4">
                        <div class="max-w-xl mx-auto mx-xl-0" data-aos-delay="100" data-aos="fade" data-aos-duration="1000">
                            <div class="ratio" style="--bs-aspect-ratio: 66.66%;">
                                <img src="{{ static_asset('assets/usdt/assets/img/bg/bg3.jpg') }}" class="object-fit-cover rounded-3" alt="Service image" loading="lazy">
                            </div>

                            <h3 class="m-0 mt-4 text-body-emphasis text-lg leading-6 fw-semibold">
                                " Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                            </h3>

                            <!-- Remove line-clamp-2 if you need more lines or add line-clamp-3 -->
                            <p class="m-0 mt-3 text-body-secondary line-clamp-2 text-sm leading-6">
                                " Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                            </p>
                        </div>
                    </div>

                    <div class="col pt-5 pt-xl-4">
                        <div class="max-w-xl mx-auto mx-xl-0" data-aos-delay="200" data-aos="fade" data-aos-duration="1000">
                            <div class="ratio" style="--bs-aspect-ratio: 66.66%;">
                                <img src="{{ static_asset('assets/usdt/assets/img/bg/bg4.jpg') }}" class="object-fit-cover rounded-3" alt="Service image" loading="lazy">
                            </div>

                            <h3 class="m-0 mt-4 text-body-emphasis text-lg leading-6 fw-semibold">
                                " Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                            </h3>

                            <!-- Remove line-clamp-2 if you need more lines or add line-clamp-3 -->
                            <p class="m-0 mt-3 text-body-secondary line-clamp-2 text-sm leading-6">
                                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."

                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center pt-7">
                <a href="javascript:;" class="btn btn-lg btn-primary text-white icon-link icon-link-hover text-sm leading-6 fw-semibold">
                    Learn more 
                    <span class="bi align-self-start left-to-right" aria-hidden="true">→</span>
                    <span class="bi align-self-start right-to-left" aria-hidden="true">←</span>
                </a>
            </div>
        </div>      
    </div>  



    <!-- About Us -->
    <div class="overflow-hidden py-7 py-sm-8 py-xl-9">
        <div class="container">
            <div class="row gy-5 align-items-center justify-content-between">
                <div class="col-12 col-xl-5 order-last">
                    <div class="mx-auto max-w-2xl">
                        <h2 class="m-0 text-primary-emphasis text-base leading-7 fw-semibold">
                            About Us
                        </h2>
                        <p class="m-0 mt-2 text-body-emphasis text-4xl tracking-tight fw-bold">
                            What is Lorem Ipsum?
                        </p>
                        <p class="m-0 mt-4 text-body-secondary text-lg leading-8">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                        </p>
                        <div class="mt-4">
                            <a href="javascript:;" class="icon-link icon-link-hover text-decoration-none text-sm leading-6 fw-bold">
                                Learn more 
                                <span class="bi align-self-start left-to-right" aria-hidden="true">→</span>
                                <span class="bi align-self-start right-to-left" aria-hidden="true">←</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-6">
                    <div class="mx-auto max-w-2xl">
                        <div class="ratio ratio-4x3" data-aos-delay="0" data-aos="fade" data-aos-duration="3000">
                            <img src="{{ static_asset('assets/usdt/assets/img/bg/bg5.jpg') }}" class="object-fit-cover rounded-3" alt="about us" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>

            <!-- big image -->
            <div class="ratio ratio-16x9 mt-7 mt-sm-8 mt-xl-9">
                <img src="{{ static_asset('assets/usdt/assets/img/bg/bg6.jpg') }}" class="object-fit-cover rounded-3" alt="presentation" loading="lazy">
            </div>
        </div>
    </div>



    <!-- Testimonials -->
    <div class="overflow-hidden py-7 py-sm-8 py-xl-9 bg-body-secondary">
        <div class="container">
            <div id="carouselExampleIndicators" class="carousel slide pb-5">
                <div class="carousel-indicators mb-0">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="mx-auto max-w-4xl text-center">
                            <img class="mx-auto" src="{{ static_asset('assets/usdt/assets/img/clients/logo1.png') }}" height="48" alt="Client Company" loading="lazy">
                            <figure class="m-0 mt-5">
                                <blockquote class="text-center fw-semibold text-body-emphasis text-2xl leading-9">
                                    <p class="m-0">
                                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                                    </p>
                                </blockquote>

                                <figcaption class="m-0 mt-5">
                                    <img class="mx-auto rounded-circle" width="40" height="40" src="{{ static_asset('assets/usdt/assets/img/small-team/st1.jpg') }}" alt="Clinet Name" loading="lazy">
                                    <div class="mt-3 d-flex align-items-center justify-content-center text-base">
                                        <div class="fw-semibold text-body-emphasis">John Bond</div>
                                        <svg viewBox="0 0 2 2" width="3" height="3" aria-hidden="true" class="mx-3 text-body-emphasis" fill="currentColor">
                                            <circle cx="1" cy="1" r="1" />
                                        </svg>
                                        <div class="text-body-secondary">CEO of Aven</div>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="mx-auto max-w-4xl text-center">
                            <img class="mx-auto" src="{{ static_asset('assets/usdt/assets/img/clients/logo2.png') }}" height="48" alt="Client Company" loading="lazy">
                            <figure class="m-0 mt-5">
                                <blockquote class="text-center fw-semibold text-body-emphasis text-2xl leading-9">
                                    <p class="m-0">
                                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                                    </p>
                                </blockquote>

                                <figcaption class="m-0 mt-5">
                                    <img class="mx-auto rounded-circle" width="40" height="40" src="{{ static_asset('assets/usdt/assets/img/small-team/st2.jpg') }}" alt="Client name" loading="lazy">
                                    <div class="mt-3 d-flex align-items-center justify-content-center text-base">
                                        <div class="fw-semibold text-body-emphasis">Judith Bond</div>
                                        <svg viewBox="0 0 2 2" width="3" height="3" aria-hidden="true" class="mx-3 text-body-emphasis" fill="currentColor">
                                            <circle cx="1" cy="1" r="1" />
                                        </svg>
                                        <div class="text-body-secondary">CEO of Circle</div>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="mx-auto max-w-4xl text-center">
                            <img class="mx-auto" src="{{ static_asset('assets/usdt/assets/img/clients/logo3.png') }}" height="48" alt="Client Company" loading="lazy">
                            <figure class="m-0 mt-5">
                                <blockquote class="text-center fw-semibold text-body-emphasis text-2xl leading-9">
                                    <p class="m-0">
                                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                                    </p>
                                </blockquote>

                                <figcaption class="m-0 mt-5">
                                    <img class="mx-auto rounded-circle" width="40" height="40" src="{{ static_asset('assets/usdt/assets/img/small-team/st3.jpg') }}" alt="Client name" loading="lazy">
                                    <div class="mt-3 d-flex align-items-center justify-content-center text-base">
                                        <div class="fw-semibold text-body-emphasis">Alex Bond</div>
                                        <svg viewBox="0 0 2 2" width="3" height="3" aria-hidden="true" class="mx-3 text-body-emphasis" fill="currentColor">
                                            <circle cx="1" cy="1" r="1" />
                                        </svg>
                                        <div class="text-body-secondary">CEO of Amara</div>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev d-none d-xl-inline" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon rtl-flip" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next d-none d-xl-inline" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon rtl-flip" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>



    <!-- Client -->
    <div class="overflow-hidden py-6 py-sm-7 py-xl-8 bg-body-tertiary">
        <div class="container">
            <div class="max-w-2xl">
                <h2 class="m-0 text-primary-emphasis text-base leading-7 fw-semibold">
                    Our Clients
                </h2>
                <div class="m-0 mt-2 text-body-emphasis text-4xl tracking-tight fw-bold">
                    Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
                </div>
            </div>

            <div class="mt-4">
                <div class="glide glideHighLinear">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides align-items-center">
                            <li class="glide__slide">
                                <div class="p-5">
                                    <img src="{{ static_asset('assets/usdt/assets/img/clients/logo1.png') }}" class="img-fluid" alt="clients">
                                </div>
                            </li>
                            <li class="glide__slide">
                                <div class="p-5">
                                    <img src="{{ static_asset('assets/usdt/assets/img/clients/logo2.png') }}" class="img-fluid" alt="clients">
                                </div>
                            </li>
                            <li class="glide__slide">
                                <div class="p-5">
                                    <img src="{{ static_asset('assets/usdt/assets/img/clients/logo3.png') }}" class="img-fluid" alt="clients">
                                </div>
                            </li>
                            <li class="glide__slide">
                                <div class="p-5">
                                    <img src="{{ static_asset('assets/usdt/assets/img/clients/logo4.png') }}" class="img-fluid" alt="clients">
                                </div>
                            </li>
                            <li class="glide__slide">
                                <div class="p-5">
                                    <img src="{{ static_asset('assets/usdt/assets/img/clients/logo5.png') }}" class="img-fluid" alt="clients">
                                </div>
                            </li>
                            <li class="glide__slide">
                                <div class="p-5">
                                    <img src="{{ static_asset('assets/usdt/assets/img/clients/logo6.png') }}" class="img-fluid" alt="clients">
                                </div>
                            </li>
                            <li class="glide__slide">
                                <div class="p-5">
                                    <img src="{{ static_asset('assets/usdt/assets/img/clients/logo7.png') }}" class="img-fluid" alt="clients">
                                </div>
                            </li>
                            <li class="glide__slide">
                                <div class="p-5">
                                    <img src="{{ static_asset('assets/usdt/assets/img/clients/logo8.png') }}" class="img-fluid" alt="clients">
                                </div>
                            </li>
                            <li class="glide__slide">
                                <div class="p-5">
                                    <img src="{{ static_asset('assets/usdt/assets/img/clients/logo9.png') }}" class="img-fluid" alt="clients">
                                </div>
                            </li>       
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Contact us -->
    <div id="contact-us" class="overflow-hidden py-7 py-sm-8 py-xl-9">
        <div class="container">
            <div class="row gy-5 gx-sm-5">
                <div class="col-12 col-xl-5 pt-4">
                    <div class="mx-auto max-w-2xl">
                        <h2 class="m-0 text-primary-emphasis text-base leading-7 fw-semibold">
                            Get in touch
                        </h2>
                        <p class="m-0 mt-2 text-body-emphasis text-3xl tracking-tight fw-bold">
                            Have any questions or need assistance? Contact us today!
                        </p>
                    </div>

                    <div class="mx-auto max-w-2xl mt-6">
                        <form class="row g-4 needs-validation" id="myForm" novalidate>
                            <div class="col-md-6">
                                <label for="nameForm" class="form-label text-sm">
                                    Full name
                                    <span class="text-danger-emphasis">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" name="nameForm" id="nameForm" required>
                                <div class="invalid-feedback text-xs">
                                    Please enter your full name.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="emailForm" class="form-label text-sm">
                                    Email address
                                    <span class="text-danger-emphasis">*</span>
                                </label>
                                <input type="email" class="form-control form-control-sm" name="emailForm" id="emailForm" required>
                                <div class="invalid-feedback text-xs">
                                    Please enter your email address.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="phoneForm" class="form-label text-sm">
                                    Phone number
                                    <span class="text-danger-emphasis">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" name="phoneForm" id="phoneForm" required>
                                <div class="invalid-feedback text-xs">
                                    Please enter your phone number.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="subjectForm" class="form-label text-sm">
                                    Subject
                                    <span class="text-danger-emphasis">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm" name="subjectForm" id="subjectForm" required>
                                <div class="invalid-feedback text-xs">
                                    Please enter a subject for your message.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="messageForm" class="form-label text-sm">
                                    Your message
                                    <span class="text-danger-emphasis">*</span>
                                </label>
                                <textarea class="form-control form-control-sm" name="messageForm" id="messageForm" rows="3" required></textarea>
                                <div class="invalid-feedback text-xs">
                                    Please enter a message.
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck" required>
                                    <label class="form-check-label text-sm" for="gridCheck">
                                        I agree to the terms &amp; conditions and privacy policy
                                        <span class="text-danger-emphasis">*</span>
                                    </label>
                                    <div class="invalid-feedback text-xs">
                                        Please agree to the terms &amp; conditions and privacy policy.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 text-center pt-3">
                                <button type="submit" class="btn btn-lg btn-primary text-white text-sm fw-semibold" id="sendMessage">
                                    Send message
                                </button>
                            </div>

                            <!-- Alert message  -->
                            <div class="col-12" id="yourMessageIsSent"></div>
                        </form>
                    </div>
                </div>

                <div class="d-none d-xl-block col-12 col-xl-7" data-aos-delay="0" data-aos="fade" data-aos-duration="3000">
                    <div class="h-100 position-relative ms-xxl-5">
                        <div class="position-absolute top-0 end-0 bottom-0 start-0 z-n1 rounded-5">
                            <img src="{{ static_asset('assets/usdt/assets/img/bg/bg7.jpg') }}" class="w-100 h-100 rounded-3 object-fit-cover" loading="lazy" alt="Image description">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

