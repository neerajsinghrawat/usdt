@extends('auth.layouts.authentication')

@section('content')

    <div class="aiz-main-wrapper d-flex flex-column justify-content-md-center bg-white">
        <section class="bg-white overflow-hidden">
            <div class="row">
                <div class="col-xxl-10 col-xl-9 col-lg-10 col-md-7 mx-auto py-lg-4">
                    <div class="card shadow-none rounded-0 border-0">
                        <div class="row no-gutters">
                            <!-- Left Side Image-->
                            <!-- <div class="col-lg-5">
                                <img src="{{ uploaded_asset(get_setting('customer_register_page_image')) }}" alt="{{ translate('Customer Register Page Image') }}" class="img-fit h-100">
                            </div> -->

                            <!-- Right Side -->
                            <div class="col-lg-7 p-4 p-lg-5 d-flex flex-column justify-content-center border right-content new_mar_21" style="height: auto;">
                                <!-- Site Icon -->
                               <!--  <div class="size-48px mb-3 mx-auto mx-lg-0">
                                    <img src="{{ uploaded_asset(get_setting('site_icon')) }}" alt="{{ translate('Site Icon')}}" class="img-fit h-100">
                                </div> -->

                                <!-- Titles -->
                                <div class="text-center text-lg-left">
                                    <h1 class="fs-20 fs-md-24 fw-700 text-primary" style="text-transform: uppercase;">{{ translate('Create an account')}}</h1>
                                </div>

                                <!-- Register form -->
                                <div class="pt-3">
                                    <div class="">
                                        <form id="reg-form" class="form-default"  enctype="multipart/form-data" role="form" action="{{ route('register') }}" method="POST">
                                            @csrf
                                            <!-- Name -->
                                            
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="name" class="fs-12 fw-700 text-soft-dark">{{  translate('Full Name') }}</label>
                                                    <input type="text" class="form-control rounded-0{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Full Name') }}" name="name">
                                                    @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                     <label for="email" class="fs-12 fw-700 text-soft-dark">{{  translate('Email') }}</label>
                                                    <input type="email" class="form-control rounded-0{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Email or Phone -->
                                           

                                            <!-- password -->
                                            <div class="form-group mb-0 row">
                                                <div class="col-md-6">
                                                    <label for="password" class="fs-12 fw-700 text-soft-dark">{{  translate('Password') }}</label>
                                                    <div class="position-relative">
                                                        <input type="password" class="form-control rounded-0{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" name="password">
                                                        <i class="password-toggle las la-2x la-eye"></i>
                                                    </div>
                                                    <div class="text-right mt-1">
                                                        <span class="fs-12 fw-400 text-gray-dark">{{ translate('Password must contain at least 6 digits') }}</span>
                                                    </div>
                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="password_confirmation" class="fs-12 fw-700 text-soft-dark">{{  translate('Confirm Password') }}</label>
                                                    <div class="position-relative">
                                                        <input type="password" class="form-control rounded-0" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation">
                                                        <i class="password-toggle las la-2x la-eye"></i>
                                                    </div>
                                                </div>
                                            </div>

                                        


                                            <div class="form-group row">

                                                {{-- <div class="col-md-6">
                                                    <label for="referral_by" class="fs-12 fw-700 text-soft-dark">{{ translate(' Referral by (Optional)') }}</label>
                                                    <input type="text" class="form-control rounded-0" placeholder="{{ translate(' Referral by') }}" name="referral_by">
                                                </div> --}}

                                                <div class="col-md-6">
                                                    <label for="referral_by" class="fs-12 fw-700 text-soft-dark">{{ translate('Referral by (Optional)') }}</label>
                                                    <input type="text" class="form-control rounded-0" placeholder="{{ translate('Referral by') }}" name="referral_by" id="referral_by">
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <label for="package_no" class="fs-12 fw-700 text-soft-dark">{{ translate('Number of IDs') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><b>1000 USDT ×</b> </span>
                                                    </div>
                                                    <input type="number"
                                                        class="form-control rounded-0{{ $errors->has('package_no') ? ' is-invalid' : '' }}" 
                                                        name="package_no" 
                                                        id="package_no" 
                                                        value="{{ old('package_no') }}" 
                                                        placeholder="{{ translate('number of IDs') }}" 
                                                        min="1" required>
                                                </div>
                                                @if ($errors->has('package_no'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('package_no') }}</strong>
                                                    </span>
                                                @endif
                                                </div>

                                            </div>

                                            
                                            </div>
                                            <!-- ID Document -->
                                        <div class="form-group row">

                                            <div class="col-md-6">
                                                <label for="id_document" class="fs-12 fw-700 text-soft-dark">{{ translate('ID Document') }}</label>
                                                <input type="text"
                                                    class="form-control rounded-0{{ $errors->has('id_document') ? ' is-invalid' : '' }}"
                                                    value="{{ old('id_document') }}"
                                                    placeholder="{{ translate('Enter your ID Document Number') }}"
                                                    name="id_document"
                                                    id="id_document">
                                                @if ($errors->has('id_document'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('id_document') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <label for="document_image" class="fs-12 fw-700 text-soft-dark">{{ translate('Upload Document Image') }}</label>
                                                <input type="file" 
                                                class="form-control rounded-0{{ $errors->has('document_image') ? ' is-invalid' : '' }}" 
                                                name="document_image" 
                                                accept="image/*">
                                                
                                                @if ($errors->has('document_image'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('document_image') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                          


                                        <!-- Document Image -->
                                        <div class="form-group">
                                            
                                        </div>

                                        <!-- Recaptcha -->
                                        @if(get_setting('google_recaptcha') == 1)
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                            </div>
                                            @if ($errors->has('g-recaptcha-response'))
                                                <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                </span>
                                            @endif
                                        @endif

                                        <!-- Terms and Conditions -->
                                        <div class="mb-3">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" name="checkbox_example_1" required>
                                                <span class="">{{ translate('By signing up you agree to our ')}} <a href="{{ route('terms') }}" class="fw-500">{{ translate(' Terms & Conditions.') }}</a></span>
                                                <span class="aiz-square-check"></span>
                                            </label>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="mb-4 mt-4">
                                            <button type="submit" class="btn btn-lg btn-primary text-white text-sm fw-semibold ">{{  translate('Create Account') }}</button>
                                        </div>
                                        </form>
                                        
                                        <!-- Social Login -->
                                       <!--  @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)
                                            <div class="text-center mb-3">
                                                <span class="bg-white fs-12 text-gray">{{ translate('Or Join With')}}</span>
                                            </div>
                                            <ul class="list-inline social colored text-center mb-4">
                                                @if (get_setting('facebook_login') == 1)
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="facebook">
                                                            <i class="lab la-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if(get_setting('google_login') == 1)
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('social.login', ['provider' => 'google']) }}" class="google">
                                                            <i class="lab la-google"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (get_setting('twitter_login') == 1)
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="twitter">
                                                            <i class="lab la-twitter"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                                @if (get_setting('apple_login') == 1)
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('social.login', ['provider' => 'apple']) }}" class="apple">
                                                            <i class="lab la-apple"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        @endif -->
                                    </div>

                                    <!-- Log In -->
                                    <p class="fs-12 text-gray mb-0">
                                        {{ translate('Already have an account?')}}
                                        <a href="{{ route('user.login') }}" class="ml-2 fs-14 fw-700 animate-underline-primary">{{ translate('Log In')}}</a>
                                    </p>
                                    <p class="fs-12 text-gray mb-0">
                                        {{ translate('Already have an account?')}}
                                        <a href="{{ route('user.login_pay_request') }}" class="ml-2 fs-14 fw-700 animate-underline-primary">{{ translate('payment')}}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Go Back -->
                        <!-- <div class="mt-3 mr-4 mr-md-0">
                            <a href="{{ url()->previous() }}" class="ml-auto fs-14 fw-700 d-flex align-items-center text-primary" style="max-width: fit-content;">
                                <i class="las la-arrow-left fs-20 mr-1"></i>
                                {{ translate('Back to Previous Page')}}
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    @if(get_setting('google_recaptcha') == 1)
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif


    <script type="text/javascript">
        @if(get_setting('google_recaptcha') == 1)
        // making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            $("#reg-form").on("submit", function(evt)
            {
                var response = grecaptcha.getResponse();
                if(response.length == 0)
                {
                //reCaptcha not verified
                    alert("please verify you are human!");
                    evt.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here
                $("#reg-form").submit();
            });
        });
        @endif
    </script>

<script>
    // Automatically populate referral code from URL if available
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const referralCode = urlParams.get('referral_code');
        if (referralCode) {
            document.getElementById('referral_by').value = referralCode;
        }
    }
</script>
@endsection