<div class="aiz-user-sidenav-wrap position-relative z-1 rounded-0">
    <div class="aiz-user-sidenav overflow-auto c-scrollbar-light px-4 pb-4">
        <!-- Close button -->
        <div class="d-xl-none">
            <button class="btn btn-sm p-2 " data-toggle="class-toggle" data-backdrop="static"
                data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb">
                <i class="las la-times la-2x"></i>
            </button>
        </div>
        @php
            $user = auth()->user();
            $user_avatar = null;
            $carts = [];
            if ($user && $user->avatar_original != null) {
                $user_avatar = uploaded_asset($user->avatar_original);
            }
        @endphp
        <!-- Customer info -->
        <div class="p-4 text-center mb-4 border-bottom position-relative">
            <!-- Image -->
            <span class="avatar avatar-md mb-3">
                @if ($user->avatar != null)
                    <img src="{{ asset('public/' . $user->avatar) }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                @else
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="image rounded-circle"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                @endif
            </span>
        
            <!-- Name -->
            <h4 class="h5 fs-14 mb-1 fw-700 text-dark">{{ $user->name }}</h4>
            <!-- Phone, Email, or Referral Code -->
                <div class="text-truncate opacity-60 fs-12">
                    @if ($user->phone != null)
                        {{ $user->email }}
                    @elseif ($user->email != null)
                    {{ $user->phone }}
                    @endif
                <br>

                <!-- Always show the referral code if it's available -->

                <span id="referralCode">{{ $user->referral_code }}</span>

                <!-- Use an icon for copying the referral URL -->
                <i class="las la-copy ms-2" id="copyReferralCode" onclick="copyReferralCode()" style="cursor: pointer;"></i>
                
                </div>
                
                
    </div>
            

        <!-- Menus -->
        <div class="sidemnenu">
            <ul class="aiz-side-nav-list mb-3 pb-3 border-bottom" data-toggle="aiz-side-menu">

                <!-- Dashboard -->
                <li class="aiz-side-nav-item">
                    <a href="{{ route('dashboard') }}" class="aiz-side-nav-link {{ areActiveRoutes(['dashboard']) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <g id="Group_24768" data-name="Group 24768" transform="translate(3495.144 -602)">
                              <path id="Path_2916" data-name="Path 2916" d="M15.3,5.4,9.561.481A2,2,0,0,0,8.26,0H7.74a2,2,0,0,0-1.3.481L.7,5.4A2,2,0,0,0,0,6.92V14a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V6.92A2,2,0,0,0,15.3,5.4M10,15H6V9A1,1,0,0,1,7,8H9a1,1,0,0,1,1,1Zm5-1a1,1,0,0,1-1,1H11V9A2,2,0,0,0,9,7H7A2,2,0,0,0,5,9v6H2a1,1,0,0,1-1-1V6.92a1,1,0,0,1,.349-.76l5.74-4.92A1,1,0,0,1,7.74,1h.52a1,1,0,0,1,.651.24l5.74,4.92A1,1,0,0,1,15,6.92Z" transform="translate(-3495.144 602)" fill="#b5b5bf"/>
                            </g>
                        </svg>
                        <span class="aiz-side-nav-text ml-3">{{ translate('Dashboard') }}</span>
                    </a>
                </li>

                @php
                    $delivery_viewed = get_count_by_delivery_viewed();
                    $payment_status_viewed = get_count_by_payment_status_viewed();
                @endphp

               

                

               

                <!-- Manage Profile -->
                @if (Auth::user()->status == 1 && Auth::user()->payment_status == 'completed') 
                <li class="aiz-side-nav-item">
                    <a href="{{ route('team') }}" class="aiz-side-nav-link {{ areActiveRoutes(['team']) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                          <!-- First User Icon -->
                          <circle cx="8" cy="8" r="4" fill="#b5b5bf" />
                          <!-- Second User Icon -->
                          <circle cx="16" cy="8" r="4" fill="#b5b5bf" />
                          <!-- First User's Group Base -->
                          <ellipse cx="8" cy="16" rx="6" ry="3" fill="#b5b5bf" />
                          <!-- Second User's Group Base -->
                          <ellipse cx="16" cy="16" rx="6" ry="3" fill="#b5b5bf" />
                        </svg>

                        <span class="aiz-side-nav-text ml-3">{{ translate(' Team') }}</span>
                    </a>
                </li>
                @endif
                <li class="aiz-side-nav-item">
                    <a href="{{ route('profile') }}" class="aiz-side-nav-link {{ areActiveRoutes(['profile']) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <g id="Group_8094" data-name="Group 8094" transform="translate(3176 -602)">
                              <path id="Path_2924" data-name="Path 2924" d="M331.144,0a4,4,0,1,0,4,4,4,4,0,0,0-4-4m0,7a3,3,0,1,1,3-3,3,3,0,0,1-3,3" transform="translate(-3499.144 602)" fill="#b5b5bf"/>
                              <path id="Path_2925" data-name="Path 2925" d="M332.144,20h-10a3,3,0,0,0,0,6h10a3,3,0,0,0,0-6m0,5h-10a2,2,0,0,1,0-4h10a2,2,0,0,1,0,4" transform="translate(-3495.144 592)" fill="#b5b5bf"/>
                            </g>
                        </svg>
                        <span class="aiz-side-nav-text ml-3">{{ translate('Manage Profile') }}</span>
                    </a>
                </li>

                <!-- Delete My Account -->
                <!-- <li class="aiz-side-nav-item">
                    <a href="javascript:void(0)" onclick="account_delete_confirm_modal('{{ route('account_delete') }}')" class="aiz-side-nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                            <g id="Group_25000" data-name="Group 25000" transform="translate(-240.535 -537)">
                            <path id="Path_2961" data-name="Path 2961" d="M221.069,0a8,8,0,1,0,8,8,8,8,0,0,0-8-8m0,15a7,7,0,1,1,7-7,7,7,0,0,1-7,7" transform="translate(27.466 537)" fill="#b5b5bf"/>
                            <rect id="Rectangle_18942" data-name="Rectangle 18942" width="8" height="1" rx="0.5" transform="translate(244.535 544.5)" fill="#b5b5bf"/>
                            </g>
                        </svg>
                        <span class="aiz-side-nav-text ml-3">{{ translate('Delete My Account') }}</span>
                    </a>
                </li> -->

            </ul>

            <!-- logout -->
            <a href="{{ route('logout') }}" class="btn btn-primary btn-block fs-14 fw-700 mb-5 mb-md-0" style="border-radius: 25px;">{{ translate('Sign Out') }}</a>
        </div>

    </div>
</div>


<!-- Script to copy referral code -->
<script>
    function copyReferralCode() {
        // Get the referral code from the element
        var referralCode = document.getElementById('referralCode').innerText;

        // Construct the registration URL with the referral code
        var referralUrl = window.location.origin + '/usdt/users/registration?referral_code=' + referralCode;

        // Create a temporary textarea element to copy the URL to clipboard
        var textarea = document.createElement('textarea');
        textarea.value = referralUrl;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);

        // Notify the user that the URL has been copied
        alert('Referral URL copied to clipboard! You can now share this link to register with your referral code.');
    }
</script>