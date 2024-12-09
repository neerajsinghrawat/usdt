

    <footer class="overflow-hidden py-6 py-sm-7 py-xl-6 bg-body-tertiary">
        <div class="container">
            <div class="row gy-5">
                <div class="col-12 col-xl-6">
                    <div class="pb-3 max-w-lg position-relative">
                        <form method="post" target="_blank" novalidate class="mc-embedded-subscribe-form">

                            <h2 class="text-body-emphasis leading-6 text-4xl tracking-tight fw-bold">
                                Subscribe to our newsletter.
                            </h2>
                            <p class="m-0 mt-3 text-body-secondary text-lg leading-8">
                                Experience the ease of code deployment with just a click. Simplify your development tasks, and increase productivity.
                            </p>

                            <div class="mt-4 mb-2 d-flex flex-column flex-sm-row w-100 gap-2 js-form-inputs">
                                <label for="emailSubscribe1" class="visually-hidden">Email address</label>
                                <input type="email" name="EMAIL" id="emailSubscribe1" value="" class="form-control leading-6 text-sm max-w-xl" placeholder="Enter your email">
                                <button type="submit" name="subscribe" class="btn btn-primary text-white fw-semibold text-sm">Subscribe</button>
                            </div>

                            <!-- This div is related to Mailchimp integration and handled by a function in our scripts.js file, so no need to worry about it. -->
                            <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                <input type="text" class="js-validate-robot" name="b_a4752870f583bb49a02427b3c_143fa46c21" tabindex="-1" value="">
                            </div>

                            <!-- response -->
                            <div class="js-subscribe-response"></div>

                        </form>
                    </div>
                </div>

                <div class="col-12 col-xl-6">
                    <div class="row row-cols-1 row-cols-sm-2 gx-3 gy-5">
                        <div class="d-flex flex-column align-items-start">
                            <div class="p-2 bg-body-tertiary rounded-3 border">
                                <svg class="text-body-emphasis" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                </svg>
                            </div>
                            <div class="m-0 mt-3 text-body-emphasis fw-semibold">
                                Weekly articles
                            </div>
                            <div class="m-0 mt-2 text-body-secondary leading-7">
                                Accelerate your deployment process effortlessly. Seamlessly manage your code deployment.
                            </div>
                        </div>

                        <div class="d-flex flex-column align-items-start">
                            <div class="p-2 bg-body-tertiary rounded-3 border">
                                <svg class="text-body-emphasis" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 013.15 0V15M6.9 7.575a1.575 1.575 0 10-3.15 0v8.175a6.75 6.75 0 006.75 6.75h2.018a5.25 5.25 0 003.712-1.538l1.732-1.732a5.25 5.25 0 001.538-3.712l.003-2.024a.668.668 0 01.198-.471 1.575 1.575 0 10-2.228-2.228 3.818 3.818 0 00-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0116.35 15m.002 0h-.002" />
                                </svg>
                            </div>
                            <div class="m-0 mt-3 text-body-emphasis fw-semibold">
                                No spam
                            </div>
                            <div class="m-0 mt-2 text-body-secondary leading-7">
                                Accelerate your deployment process effortlessly. Seamlessly manage your code deployment.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="container">
            <hr class="my-6 text-body-emphasis opacity-10">

            <div class="d-flex flex-column flex-xl-row gap-5 justify-content-between align-items-xl-center">
                <div class="order-first order-xl-last">
                    <ul class="nav row gy-4 gx-sm-4 row-cols-1 row-cols-sm-auto">
                        <li class="nav-item">
                            <a href="{{ route('terms') }}" class="p-0 text-body-secondary nav-link leading-6 text-sm">{{ translate('Terms & conditions') }} </a>
                        </li>
                    </ul>
                </div>

                <div class="">
                        <a href="{{ route('home') }}" class="link-body-emphasis d-flex align-items-center text-decoration-none">
                @if(get_setting('footer_logo') != null)
                    <img class="lazyload h-45px" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" height="24" loading="lazy">
                @else
                    <img class="lazyload h-45px" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" height="24" loading="lazy">
                @endif
            </a>
                </div>

                <div class="order-last order-xl-first">
                    <p class="mb-0 text-body-secondary leading-6 text-sm">
                        © 
                        <span class="current-year"></span> 
                        All Right Reserved <a href="{{ route('home') }}">{{get_setting('website_name')}}</a>
                        <span style="font-size: 1px;">Company, Inc Distributed by <a href="https://themewagon.com/">ThemeWagon</a></span>
                    </p>
                </div>
            </div>
        </div>  
    </footer>
