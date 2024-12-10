@extends('auth.layouts.authentication')

@section('content')
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column justify-content-md-center bg-white">
        <section class="bg-white overflow-hidden">
            <div class="row">
                <div class="col-xxl-6 col-xl-9 col-lg-10 col-md-7 mx-auto py-lg-4">
                    <div class="card shadow-none rounded-0 border-0">
                        <div class="row no-gutters">
                            <!-- Left Side Image-->
                            <div class="col-lg-6">
                                <img src="{{ uploaded_asset(get_setting('customer_login_page_image')) }}" alt="{{ translate('Customer Login Page Image') }}" class="img-fit h-100">
                            </div>

                            <!-- Right Side -->
                            <div class="col-lg-6 p-4 p-lg-5 d-flex flex-column justify-content-center border right-content" style="height: auto;">
                                <!-- Site Icon -->
                                <div class="size-48px mb-3 mx-auto mx-lg-0">
                                    <img src="{{ uploaded_asset(get_setting('site_icon')) }}" alt="{{ translate('Site Icon')}}" class="img-fit h-100">
                                </div>

                                <!-- Titles -->
                                <div class="text-center text-lg-left">
                                    <h1 class="fs-20 fs-md-24 fw-700 text-primary" style="text-transform: uppercase;">{{ translate('GO Payment !')}}</h1>
                                    <h5 class="fs-14 fw-400 text-dark">{{ translate(' pay to your account')}}</h5>
                                </div>

                                <!-- Login form -->
                                <div class="pt-3">
                                    <div class="">
                                            <form class="form-default"  enctype="multipart/form-data" role="form" action="{{ route('save.transaction.register') }}" method="POST">
                                            @csrf
                                            
                                                <div class="form-group">
                                                    <label for="transaction_id" class="fs-12 fw-700 text-soft-dark">{{ translate(' Transaction Id') }}</label>
                                                    <input type="text"
                                                        class="form-control rounded-0{{ $errors->has('transaction_id') ? ' is-invalid' : '' }}"
                                                        value="{{ old('transaction_id') }}"
                                                        placeholder="{{ translate('Enter your Transaction Number') }}"
                                                        name="transaction_id"
                                                        id="transaction_id">
                                                    @if ($errors->has('transaction_id'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('transaction_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                          
                                                <div class="form-group">
                                                
                                                    <label for="transaction_image" class="fs-12 fw-700 text-soft-dark">{{ translate('Transaction Image') }}</label>
                                                    <input type="file" 
                                                    class="form-control rounded-0{{ $errors->has('transaction_image') ? ' is-invalid' : '' }}" 
                                                    name="transaction_image" 
                                                    accept="image/*">
                                                    
                                                    @if ($errors->has('transaction_image'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('transaction_image') }}</strong>
                                                        </span>
                                                    @endif
                                               
                                                </div>




                                            <!-- Submit Button -->
                                            <div class="mb-4 mt-4">
                                                <button type="submit" class="btn btn-primary btn-block fw-700 fs-14 rounded-0">Submit</button>
                                                {{-- <button type="submit">Submit</button> --}}
                                            </div>
                                        </form>

                                        <!-- DEMO MODE -->
                                        @if (env("DEMO_MODE") == "On")
                                            <div class="mb-4">
                                                <table class="table table-bordered mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ translate('Customer Account')}}</td>
                                                            <td class="text-center">
                                                                <button class="btn btn-info btn-sm" onclick="autoFillCustomer()">{{ translate('Copy credentials') }}</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif

                                        <!-- Social Login -->
                                        <!-- @if(get_setting('google_login') == 1 || get_setting('facebook_login') == 1 || get_setting('twitter_login') == 1 || get_setting('apple_login') == 1)
                                            <div class="text-center mb-3">
                                                <span class="bg-white fs-12 text-gray">{{ translate('Or Login With')}}</span>
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
                                                        <a href="{{ route('social.login', ['provider' => 'apple']) }}"
                                                            class="apple">
                                                            <i class="lab la-apple"></i>
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        @endif -->
                                    </div>

                                    <!-- Register Now -->
                                    <p class="fs-12 text-gray mb-0">
                                        {{ translate('Dont have an account?')}}
                                        <a href="{{ route('user.registration') }}" class="ml-2 fs-14 fw-700 animate-underline-primary">{{ translate('Register Now')}}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Go Back -->
                        <div class="mt-3 mr-4 mr-md-0">
                            <a href="{{ url()->previous() }}" class="ml-auto fs-14 fw-700 d-flex align-items-center text-primary" style="max-width: fit-content;">
                                <i class="las la-arrow-left fs-20 mr-1"></i>
                                {{ translate(' Back to Home  Page')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }
    </script>
@endsection