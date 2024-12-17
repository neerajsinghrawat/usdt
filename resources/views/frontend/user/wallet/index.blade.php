@extends('frontend.layouts.user_panel')
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


</style>
@section('panel_content')
    <div class="aiz-titlebar mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="fs-20 fw-700 text-dark">{{ translate('My Wallet') }}</h1>
            </div>
        </div>
    </div>

    <div class="row gutters-16 mb-2">
        <!-- Wallet Balance -->
        <div class="col-md-4 mx-auto mb-4">
            <div class="bg-dark text-white overflow-hidden text-center p-4 h-100">
                <img src="{{ static_asset('assets/img/wallet-icon.png') }}" alt="">
                <div class="py-2">
                    <div class="fs-14 fw-400 text-center">{{ translate('Wallet Balance') }}</div>
                    <div class="fs-30 fw-700 text-center">{{ single_price(Auth::user()->wallet_usdt) }}</div>
                </div>
            </div>
        </div>

        <!-- Recharge Wallet -->
        
        <div class="col-md-4 mx-auto mb-4">
            <div class="bg-light text-dark overflow-hidden text-center p-4 h-100">
                <img src="{{ static_asset('assets/img/wallet-icon.png') }}" alt="">
                <div class="py-2">
                    <div class="fs-14 fw-400 text-center">{{ translate('Pending USDT') }}</div>
                    <div class="fs-30 fw-700 text-center">{{ single_price(Auth::user()->pending_usdt) }}</div>
                </div>
            </div>
        </div>

        
    </div>

    <!-- Wallet Recharge History -->
    {{-- <div class="card rounded-0 shadow-none border">
        <div class="card-header border-bottom-0">
            <h5 class="mb-0 fs-20 fw-700 text-dark text-center text-md-left">{{ translate('History (Wallet/Pending)') }}</h5>
        </div>
        <div class="card-body py-0">
            <table class="table  mb-4">
                <thead class="text-gray fs-12">
                    <tr>
                        <th class="pl-0">#</th>
                        <th data-breakpoints="lg">{{ translate('Date') }}</th>
                        <th data-breakpoints="lg">{{ translate('Approved Date') }}</th>
                        <th data-breakpoints="lg">{{ translate('Comment') }}</th>
                        <th>{{ translate('Amount') }}</th>
                        <th class="text-center pr-0">{{ translate('Status') }}</th>
                    </tr>
                </thead>
                <tbody class="fs-14">
                    @foreach ($wallets as $key => $wallet)
                        <tr>
                            <td class="pl-0">{{ sprintf('%02d', ($key+1)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($wallet->approved_date)) }}</td>
                            <td>{{ $wallet->comments }}</td>
                            <td class="fw-700">{{ single_price($wallet->coins_added) }}</td>
                            <td class="text-center pr-0">
                             
                                @if ($wallet->trn_status == 'approved')
                                    <span class="badge badge-inline badge-success p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;">{{ translate('Approved') }}</span>
                                @else
                                    <span class="badge badge-inline badge-info p-3 fs-12" style="border-radius: 25px; min-width: 80px !important;">{{ translate('Pending') }}</span>
                                @endif
                                
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <!-- Pagination -->
            <div class="aiz-pagination mb-4">
                {{ $wallets->links() }}
            </div>
        </div>
    </div> --}}


    

    <div class="card rounded-0 shadow-none border">
        <div class="card-header border-bottom-0">
            <h5 class="mb-0 fs-20 fw-700 text-dark text-center text-md-left">
                {{ translate('History (Wallet/Pending)') }}
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
                            <div>
                                <h6 class="mb-1 fs-14 fw-700">
                                    {{ $wallet->comments }}
                                </h6>
                                <p class="mb-0 text-muted fs-12">
                                    {{ translate('Approved Date') }}:
                                    
                                    @if (!empty($wallet->approved_date))
                                        {{ date('d-m-Y', strtotime($wallet->approved_date)) }}
                                    @else
                                        {{ translate('Not Approved') }}
                                    @endif
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
            <!-- Pagination -->
            <div class="aiz-pagination mb-4">
                {{ $wallets->links() }}
            </div>
        </div>
    </div>
    
@endsection

@section('modal')
    <!-- Wallet Recharge Modal -->
    @include('frontend.partials.wallet_modal')

    <!-- Offline Wallet Recharge Modal -->
    <div class="modal fade" id="offline_wallet_recharge_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ translate('Offline Recharge Wallet') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="offline_wallet_recharge_modal_body"></div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        function show_wallet_modal() {
            $('#wallet_modal').modal('show');
        }

        function show_make_wallet_recharge_modal() {
            $.post('{{ route('offline_wallet_recharge_modal') }}', {
                _token: '{{ csrf_token() }}'
            }, function(data) {
                $('#offline_wallet_recharge_modal_body').html(data);
                $('#offline_wallet_recharge_modal').modal('show');
            });
        }
    </script>
@endsection
