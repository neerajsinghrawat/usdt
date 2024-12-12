@extends('frontend.layouts.user_panel')

@section('panel_content')

   

    <div class="row gutters-16">
       

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="bg-dark text-white overflow-hidden text-center p-4 h-100">
                
                <img src="{{ static_asset('assets/img/wallet-icon.png') }}" alt="">
                <div class="py-2">
                    {{-- <div class="fs-30 fw-700 text-center">{{ Auth::user()->users ->team_value }} <small>USDT</small></div> --}}
                    <div class="fs-30 fw-700 text-center">{{ $teamValue }} <small>USDT</small></div>


                    <div class="fs-14 fw-400 text-center">{{ translate('Team value') }}</div>
                </div>
            </div>
        </div>
    </div>
<!-- Wallet Recharge History -->
    {{-- <div class="card rounded-0 shadow-none border">
        <div class="card-header border-bottom-0">
            <h5 class="mb-0 fs-20 fw-700 text-dark text-center text-md-left">{{ translate('Team History') }}</h5>
        </div>
        <div class="card-body py-0">
           <table class="table mb-4">
                <thead class="text-gray fs-12">
                    <tr>
                        <th class="pl-0">#</th>
                        <th data-breakpoints="lg">{{ translate('Date') }}</th>
                        <th data-breakpoints="lg">{{ translate('User Name (Add new user)') }}</th>
                        <th>{{ translate('USDT') }}</th>
                        
                    </tr>
                </thead>
                <tbody class="fs-14">
                    @foreach ($history as $key => $his)
                        <tr>
                            <td class="pl-0">{{ sprintf('%02d', ($key+1)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($his->created_at)) }}</td>
                            <td class="fw-700">{{ $his['referreduser']->name }}</td>
                            <td class="fw-700" style="color: green;">+{{ $his->amount }}</td>
                            
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="aiz-pagination mb-4">
                {{ $history->links() }}
            </div> 
        </div>
    </div> --}}

    <div class="card rounded-0 shadow-sm border">
        <div class="card-header bg-white">
            <h5 class="mb-0 fs-20 fw-700 text-dark text-center text-md-left">
                {{ translate('Team History') }}
            </h5>
        </div>
        <div class="card-body p-3">
            <!-- List-style layout for mobile -->
            <ul class="list-group list-group-flush">
                @forelse ($history as $key => $his)
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap py-3">
                        <div class="w-100">
                            <!-- Row Header -->
                            <div class="d-flex justify-content-between">
                                <div class="text-dark fw-bold fs-14">
                                    {{ sprintf('%02d', ($key+1)) }}. {{ $his['referreduser']->name }}
                                </div>
                                <div class="fs-12 text-muted">
                                    {{ date('d-m-Y', strtotime($his->created_at)) }}
                                </div>
                            </div>
                            <!-- Row Content -->
                            <div class="mt-2 d-flex justify-content-between">
                                <div class="text-muted fs-12">
                                    {{ translate('User Name (Add New User)') }}
                                </div>
                                <div class="fw-bold text-success">
                                    +{{ $his->amount }} {{ translate('USDT') }}
                                </div>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-center text-muted py-4">
                        {{ translate('No Team History Found') }}
                    </li>
                @endforelse
            </ul>
            <!-- Pagination -->
            @if ($history->isNotEmpty())
                <div class="d-flex justify-content-center mt-3">
                    <div class="aiz-pagination">
                        {{ $history->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body gry-bg px-3 pt-3" style="overflow-y: inherit;">
                <form class="" action="{{ route('wallet.withdrawal') }}" method="post">
                    @csrf
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
                            <label>{{ translate('Amount') }} <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" lang="en" class="form-control mb-3 rounded-0" name="amount"
                                placeholder="{{ translate('Amount') }}" required>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit"
                            class="btn btn-sm btn-primary rounded-0 transition-3d-hover mr-1">{{ translate('Confirm') }}</button>
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
        function show_wallet_modal(){
            $('#wallet_modal').modal('show');
        }
    </script>
    @include('frontend.partials.address.address_js')

    @if (get_setting('google_map') == 1)
        @include('frontend.partials.google_map')
    @endif
@endsection
