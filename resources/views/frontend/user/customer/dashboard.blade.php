@extends('frontend.layouts.user_panel')

<!-- Blur and Loader -->
<!-- Full-screen Loader -->
<div id="loader" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.8); z-index: 9999; align-items: center; justify-content: center;">
    <div style="font-size: 20px; font-weight: bold; color: #000;">Loading...</div>
</div>




<style>
    <style>
   .card-header h6 {
    font-size: 16px;
    font-weight: 700;
}
.card-body .d-flex {
    padding: 5px 0;
}
.badge {
    border-radius: 12px;
    min-width: 80px;
    text-align: center;
}

/* Blur effect for the screen content */
/* Blur effect for the main content */
.blur {
    filter: blur(8px); /* Adjust blur intensity */
    pointer-events: none; /* Disable interactions */
}

/* Loader styling */
#loader {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

#loader div {
    font-size: 20px;
    font-weight: bold;
    color: #fff; /* White text for the loader */
}




</style>
</style>
@section('panel_content')

   

<div class="row gutters-16">
    <!-- Wallet Balance Box -->
    <div class="col-lg-7 col-md-6 mb-4">
        <div class="h-100" style="background-image: url('{{ static_asset("assets/img/wallet-bg.png") }}'); background-size: cover; background-position: center center;">
            <div class="p-4 h-100 w-100 w-xl-50">
                <p class="fs-14 fw-400 text-gray mb-3">{{ translate('Wallet Balance') }}</p>
                <h1 class="fs-30 fw-700 text-white ">{{ single_price(Auth::user()->wallet_usdt) }}</h1>
                <hr class="border border-dashed border-white opacity-40 ml-0 mt-4 mb-4">
                @if(Auth::user()->status == 1 && Auth::user()->payment_status == 'completed')
                <button class="btn btn-block border border-soft-light hov-bg-dark text-white mt-4 py-1"  onclick="startLoader(); show_wallet_modal();" style="border-radius: 30px; background: rgba(255, 255, 255, 0.1);">

                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 48 48">
                        <g id="Group_25000" data-name="Group 25000" transform="translate(-926 -614)">
                            <rect id="Rectangle_18646" data-name="Rectangle 18646" width="48" height="48" rx="24" transform="translate(926 614)" fill="rgba(255,255,255,0.5)"/>
                            <g id="Group_24786" data-name="Group 24786" transform="translate(701.466 93)">
                                <path id="Path_32311" data-name="Path 32311" d="M122.052,10V8.55a.727.727,0,1,0-1.455,0V10a2.909,2.909,0,0,0-2.909,2.909v.727A2.909,2.909,0,0,0,120.6,16.55h1.455A1.454,1.454,0,0,1,123.506,18v.727a1.454,1.454,0,0,1-1.455,1.455H120.6a1.454,1.454,0,0,1-1.455-1.455.727.727,0,1,0-1.455,0,2.909,2.909,0,0,0,2.909,2.909V23.1a.727.727,0,1,0,1.455,0V21.641a2.909,2.909,0,0,0,2.909-2.909V18a2.909,2.909,0,0,0-2.909-2.909H120.6a1.454,1.454,0,0,1-1.455-1.455v-.727a1.454,1.454,0,0,1,1.455-1.455h1.455a1.454,1.454,0,0,1,1.455,1.455.727.727,0,0,0,1.455,0A2.909,2.909,0,0,0,122.052,10" transform="translate(127.209 529.177)" fill="#fff"/>
                            </g>
                        </g>
                    </svg>
                    {{ translate('Withdrawal') }}
                </button>
                @else
                    <button class="btn btn-block border border-soft-light hov-bg-dark text-white mt-4 py-1" style="border-radius: 30px; background: rgba(255, 255, 255, 0.1);"  onclick="alert_withdrawal();">

                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 48 48">
                            <g id="Group_25000" data-name="Group 25000" transform="translate(-926 -614)">
                                <rect id="Rectangle_18646" data-name="Rectangle 18646" width="48" height="48" rx="24" transform="translate(926 614)" fill="rgba(255,255,255,0.5)"/>
                                <g id="Group_24786" data-name="Group 24786" transform="translate(701.466 93)">
                                    <path id="Path_32311" data-name="Path 32311" d="M122.052,10V8.55a.727.727,0,1,0-1.455,0V10a2.909,2.909,0,0,0-2.909,2.909v.727A2.909,2.909,0,0,0,120.6,16.55h1.455A1.454,1.454,0,0,1,123.506,18v.727a1.454,1.454,0,0,1-1.455,1.455H120.6a1.454,1.454,0,0,1-1.455-1.455.727.727,0,1,0-1.455,0,2.909,2.909,0,0,0,2.909,2.909V23.1a.727.727,0,1,0,1.455,0V21.641a2.909,2.909,0,0,0,2.909-2.909V18a2.909,2.909,0,0,0-2.909-2.909H120.6a1.454,1.454,0,0,1-1.455-1.455v-.727a1.454,1.454,0,0,1,1.455-1.455h1.455a1.454,1.454,0,0,1,1.455,1.455.727.727,0,0,0,1.455,0A2.909,2.909,0,0,0,122.052,10" transform="translate(127.209 529.177)" fill="#fff"/>
                                </g>
                            </g>
                        </svg>
                        {{ translate('Withdrawal') }}
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Pending USDT Box -->
    <!-- <div class="col-lg-3 col-md-6 mb-4">
        <div class="bg-light text-dark overflow-hidden text-center p-4 h-100">
            <img src="{{ static_asset('assets/img/wallet-icon.png') }}" alt="">
            <div class="py-2">
                <div class="fs-14 fw-400 text-center">{{ translate('Pending USDT') }}</div>
                <div class="fs-30 fw-700 text-center">{{ single_price(Auth::user()->pending_usdt) }}</div>
            </div>
        </div>
    </div> -->

    <!-- Package Activated IDs Box -->
    <div class="col-lg-5 col-md-6 mb-4">
        <div class="bg-dark text-white overflow-hidden text-center p-4 h-100">
            <img src="{{ static_asset('assets/img/wallet-icon.png') }}" alt="">
            <div class="py-2">
                @if(Auth::user()->status == 1 && Auth::user()->payment_status == 'completed')
                    <div class="fs-30 fw-700 text-center">{{ single_price(Auth::user()->package_amount) }}</div>
                @else
                    <div class="fs-30 fw-700 text-center">{{ single_price(0) }}</div>

                @endif
                <div class="fs-14 fw-400 text-center">{{ translate('Package Activated IDs') }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Wallet Recharge History -->
        <div class="container mt-4">
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs" id="historyTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="withdrawal-tab" data-toggle="tab" href="#withdrawal" role="tab" aria-controls="withdrawal" aria-selected="true">
                        {{ translate('Withdrawal History') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="wallet-tab" data-toggle="tab" href="#wallet" role="tab" aria-controls="wallet" aria-selected="false">
                        {{ translate('Wallet') }}
                    </a>
                </li>
            </ul>
    
            <!-- Tab Content -->
            <div class="tab-content mt-3" id="historyTabsContent">
        
                <!-- Withdrawal History Tab -->
                <div class="tab-pane fade show active" id="withdrawal" role="tabpanel" aria-labelledby="withdrawal-tab">
                    <div class="card rounded-0 shadow-sm border">
                        <div class="card-header bg-white">
                            <h5 class="mb-0 fs-20 fw-700 text-dark text-center text-md-left">
                                {{ translate('Withdrawal History') }}
                            </h5>
                        </div>
                        <div class="card-body py-0">
                            @foreach ($wallets->groupBy(function($wallet) { 
                                return date('d-m-Y', strtotime($wallet->created_at)); 
                            }) as $date => $transactions)
                                <!-- Grouped Transactions by Date -->
                                <div class="card my-3 shadow-sm">
                                    <div class="card-header bg-light py-2">
                                        <h6 class="mb-0 fs-16 fw-700 text-dark">
                                            {{ $date }}
                                        </h6>
                                    </div>
                                    <div class="card-body py-2">
                                        @foreach ($transactions as $key => $wallet)
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <div >
                                                    <h6 class="mb-1 fs-14 fw-700 text-dark">
                                                        {{ sprintf('%02d', ($key + 1)) }}. {{ translate('Withdrawal') }}
                                                    </h6>
                                                    <p class="mb-0 text-muted fs-12">
                                                        {{ translate('Status') }}: 
                                                        <span class="badge badge-{{ $wallet->status == 'approved' ? 'success' : 'info' }} p-2 fs-12">
                                                            {{ $wallet->status == 'approved' ? translate('Approved') : translate('Pending') }}
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <h6 class="mb-1 fs-14 fw-700 text-success">
                                                        {{ single_price($wallet->amount) }}
                                                    </h6>
                                                </div>
                                            </div>
                                            <hr class="my-1">
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
            
                            <!-- Pagination -->
                            @if ($wallets->isNotEmpty())
                                <div class="aiz-pagination mb-4">
                                    {{ $wallets->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            
    
                <!-- Wallet Tab -->
                <div class="tab-pane fade" id="wallet" role="tabpanel" aria-labelledby="wallet-tab">
                    <div class="card rounded-0 shadow-none border">
                        <div class="card-header border-bottom-0">
                            <h5 class="mb-0 fs-20 fw-700 text-dark text-center text-md-left">
                                {{ translate('History (Wallet/Pending)') }}
                            </h5>
                        </div>
                        <div class="card-body py-0">
                            <?php //echo "<pre>";print_r($walletshis);die; ?>
                            @foreach ($walletshis->groupBy(function($walletshis) { 
                                return date('d-m-Y', strtotime($walletshis->created_at)); 
                            }) as $date => $transactions)
                                <!-- Grouped Transactions by Date -->
                                <div class="card my-3 shadow-sm">
                                    <div class="card-header bg-light py-2">
                                        <h6 class="mb-0 fs-16 fw-700 text-dark">
                                            {{ $date }}
                                        </h6>
                                    </div>
                                    <div class="card-body py-2">
                                        @foreach ($transactions as $key => $wallet)
                                        <?php //echo "<pre>";print_r(getuser($wallet->parent_id));die; ?>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <h6 class="mb-1 fs-14 fw-700">
                                            {{ $wallet->comments }}
                                        </h6>
                                        <p class="mb-0 text-muted fs-12">
                                            {{ translate('Received Date') }}: 
                                            @if (!empty($wallet->approved_date))
                                                {{ date('d-m-Y', strtotime($wallet->approved_date)) }}
                                            @else

                                                {{ translate('Not Approved') }}
                                            @endif
                                        </p>
                                        <p class="mb-0 text-muted fs-12">  
                                        <?php $datauser = getuser($wallet->parent_id); 
                                        if (isset($datauser->name)) { ?>
                                             
                                                                             
                                            From: <b>{{ ucfirst($datauser->name); }}</b> 
                                             <?php  } ?>   
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <h6 class="mb-1 fs-14 fw-700 {{ $wallet->trn_status == 'approved' ? 'text-success' : 'text-info' }}">
                                            {{ single_price($wallet->coins_added) }}
                                        </h6>
                                        <span class="badge badge-{{ $wallet->trn_status == 'approved' ? 'success' : 'info' }} p-2 fs-12">
                                            {{ $wallet->trn_status == 'approved' ? translate('Approved') : translate('Pending') }}
                                        </span>
                                    </div>
                                </div>
                                <hr class="my-1">
                            @endforeach

                                    </div>
                                </div>
                            @endforeach
                            <!-- Pagination --->
                            <div class="aiz-pagination mb-4">
                                {{ $wallets->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
     {{-- <div class="card rounded-0 shadow-none border">
        <div class="card-header border-bottom-0">
            <h5 class="mb-0 fs-20 fw-700 text-dark text-center text-md-left">{{ translate('Withdrawal History') }}</h5>
        </div>
        <div class="card-body py-0">
            <table class="table mb-4">
                <thead class="text-gray fs-12">
                    <tr>
                        <th class="pl-0">#</th>
                        <th data-breakpoints="lg">{{ translate('Date') }}</th>
                        <th>{{ translate('Amount') }}</th>
                        <th class="text-center pr-0">{{ translate('Status') }}</th>
                    </tr>
                </thead>
                <tbody class="fs-14">
                    @foreach ($wallets as $key => $wallet)
                        <tr>
                            <td class="pl-0">{{ sprintf('%02d', ($key+1)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                            <td class="fw-700">{{ single_price($wallet->amount) }}</td>
                            <td class="text-center pr-0">
                             
                                @if ($wallet->status == 'approved')
                                    <span class="badge badge-inline badge-success p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;">{{ translate('Approved') }}</span>
                                @else
                                    <span class="badge badge-inline badge-info p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;">{{ translate('Pending') }}</span>
                                @endif
                                
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="aiz-pagination mb-4">
                {{ $wallets->links() }}
            </div>
        </div>
    </div> --}}


    
    <!-- <div class="row gutters-16 mt-2">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="px-4 bg-white border h-100">
                <div class="d-flex align-items-center py-4 border-bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                        <g id="Group_25000" data-name="Group 25000" transform="translate(-1367 -427)">
                        <path id="Path_32314" data-name="Path 32314" d="M24,0A24,24,0,1,1,0,24,24,24,0,0,1,24,0Z" transform="translate(1367 427)" fill="#d43533"/>
                        <g id="Group_24770" data-name="Group 24770" transform="translate(1382.999 443)">
                            <path id="Path_25692" data-name="Path 25692" d="M294.507,424.89a2,2,0,1,0,2,2A2,2,0,0,0,294.507,424.89Zm0,3a1,1,0,1,1,1-1A1,1,0,0,1,294.507,427.89Z" transform="translate(-289.508 -412.89)" fill="#fff"/>
                            <path id="Path_25693" data-name="Path 25693" d="M302.507,424.89a2,2,0,1,0,2,2A2,2,0,0,0,302.507,424.89Zm0,3a1,1,0,1,1,1-1A1,1,0,0,1,302.507,427.89Z" transform="translate(-289.508 -412.89)" fill="#fff"/>
                            <g id="LWPOLYLINE">
                            <path id="Path_25694" data-name="Path 25694" d="M305.43,416.864a1.5,1.5,0,0,0-1.423-1.974h-9a.5.5,0,0,0,0,1h9a.467.467,0,0,1,.129.017.5.5,0,0,1,.354.611l-1.581,6a.5.5,0,0,1-.483.372h-7.462a.5.5,0,0,1-.489-.392l-1.871-8.433a1.5,1.5,0,0,0-1.465-1.175h-1.131a.5.5,0,1,0,0,1h1.043a.5.5,0,0,1,.489.391l1.871,8.434a1.5,1.5,0,0,0,1.465,1.175h7.55a1.5,1.5,0,0,0,1.423-1.026Z" transform="translate(-289.508 -412.89)" fill="#fff"/>
                            </g>
                        </g>
                        </g>
                    </svg>
                    <div class="ml-3 d-flex flex-column justify-content-between">
                        @php
                            $cart = get_user_cart();
                        @endphp
                        <span class="fs-20 fw-700 mb-1">{{ count($cart) > 0 ? sprintf("%02d", count($cart)) : 0 }}</span>
                        <span class="fs-14 fw-400 text-secondary">{{ translate('Products in Cart') }}</span>
                    </div>
                </div>

                <div class="d-flex align-items-center py-4 border-bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                        <g id="Group_25000" data-name="Group 25000" transform="translate(-1367 -499)">
                        <path id="Path_32309" data-name="Path 32309" d="M24,0A24,24,0,1,1,0,24,24,24,0,0,1,24,0Z" transform="translate(1367 499)" fill="#3490f3"/>
                        <g id="Group_24772" data-name="Group 24772" transform="translate(1383 515)">
                            <g id="Wooden" transform="translate(0 1)">
                            <path id="Path_25676" data-name="Path 25676" d="M290.82,413.6a4.5,4.5,0,0,0-6.364,0l-.318.318-.318-.318a4.5,4.5,0,1,0-6.364,6.364l6.046,6.054a.9.9,0,0,0,1.272,0l6.046-6.054A4.5,4.5,0,0,0,290.82,413.6Zm-.707,5.657-5.975,5.984-5.975-5.984a3.5,3.5,0,1,1,4.95-4.95l.389.389a.9.9,0,0,0,1.272,0l.389-.389a3.5,3.5,0,1,1,4.95,4.95Z" transform="translate(-276.138 -412.286)" fill="#fff"/>
                            </g>
                            <rect id="Rectangle_1603" data-name="Rectangle 1603" width="16" height="16" transform="translate(0)" fill="none"/>
                        </g>
                        </g>
                    </svg>
                    <div class="ml-3 d-flex flex-column justify-content-between">
                        <span class="fs-20 fw-700 mb-1">{{ count(Auth::user()->wishlists) > 0 ? sprintf("%02d", count(Auth::user()->wishlists)) : 0 }}</span>
                        <span class="fs-14 fw-400 text-secondary">{{ translate('Products in Wishlist') }}</span>
                    </div>
                </div>

                <div class="d-flex align-items-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                        <g id="Group_25000" data-name="Group 25000" transform="translate(-1367 -576)">
                        <path id="Path_32315" data-name="Path 32315" d="M24,0A24,24,0,1,1,0,24,24,24,0,0,1,24,0Z" transform="translate(1367 576)" fill="#85b567"/>
                        <path id="_2e746ddacacf202af82cf4480bae6173" data-name="2e746ddacacf202af82cf4480bae6173" d="M11.483,3h-.009a.308.308,0,0,0-.1.026L4.26,6.068A.308.308,0,0,0,4,6.376V15.6a.308.308,0,0,0,.026.127v0l.009.017a.308.308,0,0,0,.157.147l7.116,3.042a.338.338,0,0,0,.382,0L18.8,15.9a.308.308,0,0,0,.189-.243q0-.008,0-.017s0-.01,0-.015,0-.01,0-.015,0,0,0,0V6.376a.308.308,0,0,0-.255-.306L11.632,3.031l-.007,0a.308.308,0,0,0-.05-.017l-.009,0-.022,0h-.062Zm.014.643L13,4.287,6.614,7.02,6.6,7.029,5.088,6.383,11.5,3.643Zm2.29.979,1.829.782L9.108,8.188a.414.414,0,0,0-.186.349v3.291l-.667-1a.308.308,0,0,0-.393-.1l-.786.392V7.493l6.712-2.87ZM16.4,5.738l1.509.645L11.5,9.124,9.99,8.48l6.39-2.733.018-.009ZM4.615,6.85l1.846.789v3.975a.308.308,0,0,0,.445.275l.987-.494,1.064,1.595v0a.308.308,0,0,0,.155.14h0l.027.009a.308.308,0,0,0,.057.012h.036l.036,0,.025,0,.018,0,.015,0a.308.308,0,0,0,.05-.022h0a.308.308,0,0,0,.156-.309V8.955l1.654.707v8.56L4.615,15.411Zm13.765,0v8.56L11.8,18.223V9.662Z" transform="translate(1379.5 588.5)" fill="#fff" stroke="#fff" stroke-width="0.25" fill-rule="evenodd"/>
                        </g>
                    </svg>
                    <div class="ml-3 d-flex flex-column justify-content-between">
                        @php
                           $total =  get_user_total_ordered_products();
                        @endphp
                        <span class="fs-20 fw-700 mb-1">{{ $total > 0 ? sprintf("%02d", $total) : 0 }}</span>
                        <span class="fs-14 fw-400 text-secondary">{{ translate('Total Products Ordered') }}</span>
                    </div>
                </div>

            </div>
        </div>
    </div> -->

    
@endsection

@section('modal')
    <!-- Wallet Recharge Modal -->
<div class="modal fade" id="wallet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate(' Withdrawal Wallet') }}</h5>
                <button type="button"  onclick="closeModal('wallet_modal')" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>

          
            <div class="modal-body gry-bg px-3 pt-3" style="overflow-y: inherit;">
                <form class="" action="{{ route('wallet.withdrawal') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label>{{ translate('Code (Sent to your eamil )') }} <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" lang="en" class="form-control mb-3 rounded-0" name="code"
                                placeholder="{{ translate('6 Digit code') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>{{ translate('TRC20 USDT wallet URL') }} <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" lang="en" class="form-control mb-3 rounded-0" name="wallet_url"
                                placeholder="{{ translate('URL') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>{{ translate('TRC20 wallet QRCode(Image)') }} <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="file" name="image" class="form-control mb-3 rounded-0" accept="image/*" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>{{ translate('Amount') }} <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" lang="en" class="form-control mb-3 rounded-0" name="amount"
                                placeholder="{{ translate('Amount') }}" required min="10">
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between align-items-center">
                        <!-- Red Notification Banner (Left-Aligned) -->
                        <div style="color: red; font-weight: bold;">
                            {{ translate('3 USDT charge will be deducted') }}
                        </div>
                        
                        <!-- Button (Right-Aligned) -->
                        <button type="submit" onclick="startLoader();" 
                            class="btn btn-sm btn-primary rounded-0 transition-3d-hover">
                            {{ translate('Confirm') }}
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

    

    <!-- Address modal Modal -->
    @include('frontend.partials.address.address_modal')
@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
  
  function closeModal(modalId) {
    // Get the modal element
    const modal = document.getElementById(modalId);

    if (modal) { 
        // Remove the 'show' class   //
        modal.classList.remove('show');
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
    }

    // Remove the backdrop if exists  //
    const backdrop = document.querySelector('.modal-backdrop');
    if (backdrop) {
        backdrop.parentNode.removeChild(backdrop);
    }
}



function startLoader() {
    // Show the loader on button click
    document.getElementById('loader').style.display = 'flex';
    // ocument.getElementById('loader').style.display = 'none';
}

function alert_withdrawal() {
    AIZ.plugins.notify('warning', 'Please Complete Your Payment First');
}

function stopLoader() {
    // Hide the loader after the process completes
    document.getElementById('loader').style.display = 'none';
}

function show_wallet_modal() {
    var id = '<?php echo Auth::user()->id; ?>'; // Get the user's ID

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '{{ route('send-email-verify-withdrawal') }}',
        data: { id: id },
        dataType: 'json',
        success: function (data) {
            if (AIZ && AIZ.plugins && typeof AIZ.plugins.notify === 'function') {
                AIZ.plugins.notify('success', data.message); // Success notification
            } else {
                console.error('AIZ.plugins.notify is not defined.');
                alert(data.message); // Fallback to alert
            }
            $('#wallet_modal').modal('show'); // Show modal
        },
        error: function (xhr, status, error) {
            alert('Error: ' + error); // Show error message
        },
        complete: function () {
            stopLoader(); // Always hide the loader
        }
    });
}



    </script>


    @include('frontend.partials.address.address_js')

    @if (get_setting('google_map') == 1)
        @include('frontend.partials.google_map')
    @endif
@endsection
