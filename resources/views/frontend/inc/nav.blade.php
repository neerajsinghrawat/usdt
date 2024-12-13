
    <!-- header top -->
    <header class="navigation position-absolute w-100 bg-body-tertiary shadow border-bottom border-light border-opacity-10 rounded-bottom-3 rounded-bottom-sm-4">
        <nav class="navbar navbar-expand-xl" aria-label="Offcanvas navbar large">
            <div class="container py-1">
               
                <a class="navbar-brand" href="{{ route('home') }}">
                    @php
                        $header_logo = get_setting('header_logo');
                    @endphp
                    @if ($header_logo != null)
                        <img src="{{ uploaded_asset($header_logo) }}" height="40" alt="{{ env('APP_NAME') }}">
                    @else
                        <img src="{{ static_asset('assets/img/logo.png') }}" height="40" alt="{{ env('APP_NAME') }}">
                    @endif
                </a>

                <div class="dropdown ms-3 order-last">
                    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                        <symbol id="check2" viewBox="0 0 16 16">
                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                        </symbol>
                        <symbol id="circle-half" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
                        </symbol>
                        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
                            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
                            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
                        </symbol>
                        <symbol id="sun-fill" viewBox="0 0 16 16">
                            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
                        </symbol>
                    </svg>

                   
                </div>

                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end border-0 rounded-start-0 rounded-start-sm-4" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
                    <div class="offcanvas-header" style="padding: 2rem 2rem 1.5rem 2rem;">
                        <h5 class="offcanvas-title m-0" id="offcanvasNavbar2Label">
                            <a class="navbar-brand" href="javascript:;">
                                <img src="{{ static_asset('assets/usdt/assets/logo/logo.png') }}" height="32" alt="logo">
                            </a>
                        </h5>
                        <button type="button" class="btn-close text-body-emphasis" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <ul class="navbar-nav align-items-xl-center flex-grow-1 column-gap-4 row-gap-4 row-gap-xl-2">
                            <li class="nav-item ms-xl-auto">
                                <a href="{{ asset('index.php') }}" class="px-3 text-body-emphasis bg-body-secondary-hover nav-link rounded-3 text-base leading-6 fw-semibold" aria-current="page">
                                    HOME
                                </a>
                            </li>
                            
                            @if (get_setting('header_menu_labels') != null)
                                    @foreach (json_decode(get_setting('header_menu_labels'), true) as $key => $value)
                                        <li class="nav-item">
                                            <a href="{{ json_decode(get_setting('header_menu_links'), true)[$key] }}" class="px-3 text-body-emphasis bg-body-secondary-hover nav-link rounded-3 text-base leading-6 fw-semibold" aria-current="page">
                                                {{ translate($value) }}
                                            </a>
                                        </li>
                                    @endforeach
                                @endif

                            <li class="nav-item ms-xl-auto">
                                @auth

                                        <div class="dropdown">
                                            
                                            <button class="btn w-100 text-start dropdown-toggle px-3 text-body-emphasis bg-body-secondary-hover nav-link rounded-3 text-base leading-6 fw-semibold" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="size-40px rounded-circle overflow-hidden border border-transparent nav-user-img" id="nav-user-info">
                                                    @if ($user->avatar != null)
                                                        <img src="{{ asset( 'public/' .$user->avatar) }}" 
                                                            class="img-fit h-100" 
                                                            alt="{{ translate('avatar') }}" 
                                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                                                    @else
                                                        <img src="{{ static_asset('assets/img/avatar-place.png') }}" 
                                                            class="image" 
                                                            alt="{{ translate('avatar') }}" 
                                                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                                                    @endif
                                                </span>
                                                
                                            {{ $user->name }}
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-hover end-0 text-sm shadow bg-body-tertiary" style="--bs-dropdown-min-width: 9rem;">
                                                <li class="d-none d-xl-block" style="color: var(--bs-tertiary-bg);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                                        class="mt-n1 d-inline-block position-absolute top-0 end-0 translate-middle" viewBox="0 0 16 16">
                                                        <path class="carret-dropdown-path" d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                                                    </svg>
                                                </li>
                                            @if (isAdmin())
                                                <li class="d-none d-xl-block" style="color: var(--bs-tertiary-bg);">
                                                    <a href="{{ route('admin.dashboard') }}"
                                                        class="dropdown-item text-body-emphasis bg-body-secondary-hover py-2 text-base leading-6 fw-semibold">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 16 16">
                                                            <path id="Path_2916" data-name="Path 2916"
                                                                d="M15.3,5.4,9.561.481A2,2,0,0,0,8.26,0H7.74a2,2,0,0,0-1.3.481L.7,5.4A2,2,0,0,0,0,6.92V14a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V6.92A2,2,0,0,0,15.3,5.4M10,15H6V9A1,1,0,0,1,7,8H9a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H11V9A2,2,0,0,0,9,7H7A2,2,0,0,0,5,9v6H2a1,1,0,0,1-1-1V6.92a1,1,0,0,1,.349-.76l5.74-4.92A1,1,0,0,1,7.74,1h.52a1,1,0,0,1,.651.24l5.74,4.92A1,1,0,0,1,15,6.92Z"
                                                                fill="#b5b5c0" />
                                                        </svg>
                                                        <span
                                                            class="user-top-menu-name has-transition ml-3">{{ translate('Dashboard') }}</span>
                                                    </a>
                                                </li>
                                            @else
                                            <li class="d-none d-xl-block" style="color: var(--bs-tertiary-bg);">
                                                <a href="{{ route('dashboard') }}"
                                                    class="dropdown-item text-body-emphasis bg-body-secondary-hover py-2 text-base leading-6 fw-semibold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 16 16">
                                                        <path id="Path_2916" data-name="Path 2916"
                                                            d="M15.3,5.4,9.561.481A2,2,0,0,0,8.26,0H7.74a2,2,0,0,0-1.3.481L.7,5.4A2,2,0,0,0,0,6.92V14a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V6.92A2,2,0,0,0,15.3,5.4M10,15H6V9A1,1,0,0,1,7,8H9a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H11V9A2,2,0,0,0,9,7H7A2,2,0,0,0,5,9v6H2a1,1,0,0,1-1-1V6.92a1,1,0,0,1,.349-.76l5.74-4.92A1,1,0,0,1,7.74,1h.52a1,1,0,0,1,.651.24l5.74,4.92A1,1,0,0,1,15,6.92Z"
                                                            fill="#b5b5c0" />
                                                    </svg>
                                                    <span
                                                        class="user-top-menu-name has-transition ml-3">{{ translate('Dashboard') }}</span>
                                                </a>
                                            </li>
                                        @endif

                                        @if (isCustomer())
                                           <!--  <li class="d-none d-xl-block" style="color: var(--bs-tertiary-bg);">
                                                <a href="{{ route('purchase_history.index') }}"
                                                    class="dropdown-item text-body-emphasis bg-body-secondary-hover py-2 text-base leading-6 fw-semibold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        viewBox="0 0 16 16">
                                                        <g id="Group_25261" data-name="Group 25261"
                                                            transform="translate(-27.466 -542.963)">
                                                            <path id="Path_2953" data-name="Path 2953"
                                                                d="M14.5,5.963h-4a1.5,1.5,0,0,0,0,3h4a1.5,1.5,0,0,0,0-3m0,2h-4a.5.5,0,0,1,0-1h4a.5.5,0,0,1,0,1"
                                                                transform="translate(22.966 537)" fill="#b5b5bf" />
                                                            <path id="Path_2954" data-name="Path 2954"
                                                                d="M12.991,8.963a.5.5,0,0,1,0-1H13.5a2.5,2.5,0,0,1,2.5,2.5v10a2.5,2.5,0,0,1-2.5,2.5H2.5a2.5,2.5,0,0,1-2.5-2.5v-10a2.5,2.5,0,0,1,2.5-2.5h.509a.5.5,0,0,1,0,1H2.5a1.5,1.5,0,0,0-1.5,1.5v10a1.5,1.5,0,0,0,1.5,1.5h11a1.5,1.5,0,0,0,1.5-1.5v-10a1.5,1.5,0,0,0-1.5-1.5Z"
                                                                transform="translate(27.466 536)" fill="#b5b5bf" />
                                                            <path id="Path_2955" data-name="Path 2955"
                                                                d="M7.5,15.963h1a.5.5,0,0,1,.5.5v1a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1-.5-.5v-1a.5.5,0,0,1,.5-.5"
                                                                transform="translate(23.966 532)" fill="#b5b5bf" />
                                                            <path id="Path_2956" data-name="Path 2956"
                                                                d="M7.5,21.963h1a.5.5,0,0,1,.5.5v1a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1-.5-.5v-1a.5.5,0,0,1,.5-.5"
                                                                transform="translate(23.966 529)" fill="#b5b5bf" />
                                                            <path id="Path_2957" data-name="Path 2957"
                                                                d="M7.5,27.963h1a.5.5,0,0,1,.5.5v1a.5.5,0,0,1-.5.5h-1a.5.5,0,0,1-.5-.5v-1a.5.5,0,0,1,.5-.5"
                                                                transform="translate(23.966 526)" fill="#b5b5bf" />
                                                            <path id="Path_2958" data-name="Path 2958"
                                                                d="M13.5,16.963h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"
                                                                transform="translate(20.966 531.5)" fill="#b5b5bf" />
                                                            <path id="Path_2959" data-name="Path 2959"
                                                                d="M13.5,22.963h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"
                                                                transform="translate(20.966 528.5)" fill="#b5b5bf" />
                                                            <path id="Path_2960" data-name="Path 2960"
                                                                d="M13.5,28.963h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"
                                                                transform="translate(20.966 525.5)" fill="#b5b5bf" />
                                                        </g>
                                                    </svg>
                                                    <span
                                                        class="user-top-menu-name has-transition ml-3">{{ translate('Purchase History') }}</span>
                                                </a>
                                            </li>
                                            <li class="d-none d-xl-block" style="color: var(--bs-tertiary-bg);">
                                                <a href="{{ route('digital_purchase_history.index') }}"
                                                    class="dropdown-item text-body-emphasis bg-body-secondary-hover py-2 text-base leading-6 fw-semibold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16.001" height="16"
                                                        viewBox="0 0 16.001 16">
                                                        <g id="Group_25262" data-name="Group 25262"
                                                            transform="translate(-1388.154 -562.604)">
                                                            <path id="Path_2963" data-name="Path 2963"
                                                                d="M77.864,98.69V92.1a.5.5,0,1,0-1,0V98.69l-1.437-1.437a.5.5,0,0,0-.707.707l1.851,1.852a1,1,0,0,0,.707.293h.172a1,1,0,0,0,.707-.293l1.851-1.852a.5.5,0,0,0-.7-.713Z"
                                                                transform="translate(1318.79 478.5)" fill="#b5b5bf" />
                                                            <path id="Path_2964" data-name="Path 2964"
                                                                d="M67.155,88.6a3,3,0,0,1-.474-5.963q-.009-.089-.015-.179a5.5,5.5,0,0,1,10.977-.718,3.5,3.5,0,0,1-.989,6.859h-1.5a.5.5,0,0,1,0-1l1.5,0a2.5,2.5,0,0,0,.417-4.967.5.5,0,0,1-.417-.5,4.5,4.5,0,1,0-8.908.866.512.512,0,0,1,.009.121.5.5,0,0,1-.52.479,2,2,0,1,0-.162,4l.081,0h2a.5.5,0,0,1,0,1Z"
                                                                transform="translate(1324 486)" fill="#b5b5bf" />
                                                        </g>
                                                    </svg>
                                                    <span
                                                        class="user-top-menu-name has-transition ml-3">{{ translate('Downloads') }}</span>
                                                </a>
                                            </li>
                                            @if (get_setting('conversation_system') == 1)
                                                <li class="d-none d-xl-block" style="color: var(--bs-tertiary-bg);">
                                                    <a href="{{ route('conversations.index') }}"
                                                        class="dropdown-item text-body-emphasis bg-body-secondary-hover py-2 text-base leading-6 fw-semibold">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 16 16">
                                                            <g id="Group_25263" data-name="Group 25263"
                                                                transform="translate(1053.151 256.688)">
                                                                <path id="Path_3012" data-name="Path 3012"
                                                                    d="M134.849,88.312h-8a2,2,0,0,0-2,2v5a2,2,0,0,0,2,2v3l2.4-3h5.6a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2m1,7a1,1,0,0,1-1,1h-8a1,1,0,0,1-1-1v-5a1,1,0,0,1,1-1h8a1,1,0,0,1,1,1Z"
                                                                    transform="translate(-1178 -341)" fill="#b5b5bf" />
                                                                <path id="Path_3013" data-name="Path 3013"
                                                                    d="M134.849,81.312h8a1,1,0,0,1,1,1v5a1,1,0,0,1-1,1h-.5a.5.5,0,0,0,0,1h.5a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2h-8a2,2,0,0,0-2,2v.5a.5.5,0,0,0,1,0v-.5a1,1,0,0,1,1-1"
                                                                    transform="translate(-1182 -337)" fill="#b5b5bf" />
                                                                <path id="Path_3014" data-name="Path 3014"
                                                                    d="M131.349,93.312h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"
                                                                    transform="translate(-1181 -343.5)" fill="#b5b5bf" />
                                                                <path id="Path_3015" data-name="Path 3015"
                                                                    d="M131.349,99.312h5a.5.5,0,1,1,0,1h-5a.5.5,0,1,1,0-1"
                                                                    transform="translate(-1181 -346.5)" fill="#b5b5bf" />
                                                            </g>
                                                        </svg>
                                                        <span
                                                            class="user-top-menu-name has-transition ml-3">{{ translate('Conversations') }}</span>
                                                    </a>
                                                </li>
                                            @endif

                                            @if (get_setting('wallet_system') == 1)
                                                <li class="d-none d-xl-block" style="color: var(--bs-tertiary-bg);">
                                                    <a href="{{ route('wallet.index') }}"
                                                        class="dropdown-item text-body-emphasis bg-body-secondary-hover py-2 text-base leading-6 fw-semibold">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="16"
                                                            height="16" viewBox="0 0 16 16">
                                                            <defs>
                                                                <clipPath id="clip-path1">
                                                                    <rect id="Rectangle_1386" data-name="Rectangle 1386"
                                                                        width="16" height="16" fill="#b5b5bf" />
                                                                </clipPath>
                                                            </defs>
                                                            <g id="Group_8102" data-name="Group 8102"
                                                                clip-path="url(#clip-path1)">
                                                                <path id="Path_2936" data-name="Path 2936"
                                                                    d="M13.5,4H13V2.5A2.5,2.5,0,0,0,10.5,0h-8A2.5,2.5,0,0,0,0,2.5v11A2.5,2.5,0,0,0,2.5,16h11A2.5,2.5,0,0,0,16,13.5v-7A2.5,2.5,0,0,0,13.5,4M2.5,1h8A1.5,1.5,0,0,1,12,2.5V4H2.5a1.5,1.5,0,0,1,0-3M15,11H10a1,1,0,0,1,0-2h5Zm0-3H10a2,2,0,0,0,0,4h5v1.5A1.5,1.5,0,0,1,13.5,15H2.5A1.5,1.5,0,0,1,1,13.5v-9A2.5,2.5,0,0,0,2.5,5h11A1.5,1.5,0,0,1,15,6.5Z"
                                                                    fill="#b5b5bf" />
                                                            </g>
                                                        </svg>
                                                        <span
                                                            class="user-top-menu-name has-transition ml-3">{{ translate('My Wallet') }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                            <li class="d-none d-xl-block" style="color: var(--bs-tertiary-bg);">
                                                <a href="{{ route('support_ticket.index') }}"
                                                    class="dropdown-item text-body-emphasis bg-body-secondary-hover py-2 text-base leading-6 fw-semibold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16.001"
                                                        viewBox="0 0 16 16.001">
                                                        <g id="Group_25259" data-name="Group 25259"
                                                            transform="translate(-316 -1066)">
                                                            <path id="Subtraction_184" data-name="Subtraction 184"
                                                                d="M16427.109,902H16420a8.015,8.015,0,1,1,8-8,8.278,8.278,0,0,1-1.422,4.535l1.244,2.132a.81.81,0,0,1,0,.891A.791.791,0,0,1,16427.109,902ZM16420,887a7,7,0,1,0,0,14h6.283c.275,0,.414,0,.549-.111s-.209-.574-.34-.748l0,0-.018-.022-1.064-1.6A6.829,6.829,0,0,0,16427,894a6.964,6.964,0,0,0-7-7Z"
                                                                transform="translate(-16096 180)" fill="#b5b5bf" />
                                                            <path id="Union_12" data-name="Union 12"
                                                                d="M16414,895a1,1,0,1,1,1,1A1,1,0,0,1,16414,895Zm.5-2.5V891h.5a2,2,0,1,0-2-2h-1a3,3,0,1,1,3.5,2.958v.54a.5.5,0,1,1-1,0Zm-2.5-3.5h1a.5.5,0,1,1-1,0Z"
                                                                transform="translate(-16090.998 183.001)" fill="#b5b5bf" />
                                                        </g>
                                                    </svg>
                                                    <span
                                                        class="user-top-menu-name has-transition ml-3">{{ translate('Support Ticket') }}</span>
                                                </a>
                                            </li>-->
                                        @endif 
                                        <li class="d-none d-xl-block" style="color: var(--bs-tertiary-bg);">
                                            <a href="{{ route('logout') }}"
                                                class="dropdown-item text-body-emphasis bg-body-secondary-hover py-2 text-base leading-6 fw-semibold">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15.999"
                                                    viewBox="0 0 16 15.999">
                                                    <g id="Group_25503" data-name="Group 25503"
                                                        transform="translate(-24.002 -377)">
                                                        <g id="Group_25265" data-name="Group 25265"
                                                            transform="translate(-216.534 -160)">
                                                            <path id="Subtraction_192" data-name="Subtraction 192"
                                                                d="M12052.535,2920a8,8,0,0,1-4.569-14.567l.721.72a7,7,0,1,0,7.7,0l.721-.72a8,8,0,0,1-4.567,14.567Z"
                                                                transform="translate(-11803.999 -2367)" fill="#d43533" />
                                                        </g>
                                                        <rect id="Rectangle_19022" data-name="Rectangle 19022" width="1"
                                                            height="8" rx="0.5" transform="translate(31.5 377)"
                                                            fill="#d43533" />
                                                    </g>
                                                </svg>
                                                <span
                                                    class="user-top-menu-name text-primary has-transition ml-3">{{ translate('Logout') }}</span>
                                            </a>
                                        </li>
                                            </ul>
                                        </div>
                                @else
                                    <!--Login & Registration -->

                                    <li class="nav-item ms-xl-auto">
                                        <a href="{{ route('user.registration') }}" class="px-3 text-body-emphasis bg-body-secondary-hover border nav-link rounded-3 text-base leading-6 fw-semibold text-center">
                                            {{ translate('Registration') }}
                                        </a></li>
                                         <li class="nav-item">
                                        <a href="{{ route('user.login') }}" class="px-3 text-body-emphasis bg-body-secondary-hover border nav-link rounded-3 text-base leading-6 fw-semibold text-center">
                                            {{ translate('Login') }}
                                        </a>
                                    </li>

                                @endauth
                            
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>