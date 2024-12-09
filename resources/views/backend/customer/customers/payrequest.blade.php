@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="align-items-center">
        <h1 class="h3">{{translate('All Requests ROI')}}</h1>
    </div>
</div>


<div class="card">
    {{-- <form class="" id="sort_customers" action="" method="GET"> --}}
        {{-- <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-0 h6">{{translate('Requests')}}</h5>
            </div>

            <div class="dropdown mb-2 mb-md-0">
                <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                    {{translate('Bulk Action')}}
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item confirm-alert" href="javascript:void(0)"  data-target="#bulk-delete-modal">{{translate('Delete selection')}}</a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group mb-0">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type email or name & Enter') }}">
                </div>
            </div>

            
        </div> --}}

        <form class="" id="filter_form" action="{{ route('pay-request') }}" method="GET">
            <div class="card-header row gutters-5  text-right" >
                <div class="col">
                    <h5 class="mb-0 h6">{{translate('Requests')}}</h5>
                </div>
        
                <div class="col-md-2">
                    <div class="form-group mb-0">
                        <input type="text" class="form-control" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type email or name & Enter') }}">
                    </div>
                </div>
        
                <div class="col-md-1">
                    <div class="form-group mb-0">
                        <input type="number" class="form-control" name="requested_usdt" value="{{ request('requested_usdt') }}" placeholder="{{ translate('USDT') }}">
                    </div>
                </div>
        
                <div class="col-md-2">
                    <div class="form-group mb-0">
                        <select name="approval" class="form-control">
                            <option value="">{{ translate('Select Approval Status') }}</option>
                            <option value="approved" {{ request('approval') == 'approved' ? 'selected' : '' }}>{{ translate('Approved') }}</option>
                            <option value="pending" {{ request('approval') == 'pending' ? 'selected' : '' }}>{{ translate('Pending') }}</option>
                        </select>
                    </div>
                </div>
                
        
                <!-- Start Date Filter -->
                <div class="col-md-2">
                    <div class="form-group mb-0">
                        <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}" placeholder="{{ translate('Start Date') }}">
                    </div>
                </div>
                 <!-- End Date Filter -->
                 <div class="col-md-2">
                    <div class="form-group mb-0">
                        <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}" placeholder="{{ translate('End Date') }}">
                    </div>
                </div>
        
          <!-- Filter Button -->
          <div class="col-md-2 ">
            <div class="form-group mb-0">
                <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>
            </div>
        </div>
                
        
              
            </div>
        </form>
        
        
        

        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                       
                        <th>{{translate('SR No.')}}</th> <!-- SR No. Column -->
                        <th>{{translate('Name')}}</th>
                        <th data-breakpoints="lg">{{translate('Email Address')}}</th>
                        <th data-breakpoints="lg">{{translate('Phone')}}</th>
                        <th data-breakpoints="lg">{{translate('referral Code')}}</th>
                        <th data-breakpoints="lg">{{translate('Package')}}</th>
                        <th data-breakpoints="lg">{{translate('Wallet Balance')}}</th>
                        <th>{{ translate('Requested USDT') }}</th>
                        <th>{{ translate('Start Date') }}</th>
                        <th>{{ translate('Approved Date') }}</th>
                        <th data-breakpoints="lg">{{translate('Approval')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                        @if ($user != null)
                            <tr>
                                <td>{{ ($key + 1) + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                
                                <td>@if($user->banned == 1) <i class="fa fa-ban text-danger" aria-hidden="true"></i> @endif {{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->referral_code}}</td>
                                <td>{{single_price($user->package_amount)}}</td>
                                <td>{{single_price($user->wallet_usdt)}}</td>
                                                
                        

                        <td>
                            @php
                                $requestedCoins = $user->userCoinAudit
                                    ->where('type', 'roi') // Filter only 'roi' type records
                                    ->sum('coins_added'); // Sum the 'coins_added' for 'roi'
                            @endphp
                            {{single_price( $requestedCoins) }}
                        </td>
                      
                        
                        <td>
                            @foreach ($user->userCoinAudit as $audit)
                                {{ $audit->created_at->format('d-m-Y h:i A') }}<br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($user->userCoinAudit as $audit)
                                {{ $audit->updated_at->format('d-m-Y h:i A') }}<br>
                            @endforeach
                        </td>
                        

                        <td>
                            <label class="aiz-switch aiz-switch-success mb-0">
                                <input onchange="updateTrnStatus(this)" value="{{ $audit->id }}" type="checkbox" 
                                       @if ($audit->trn_status === 'approved') checked @endif>
                                <span class="slider round"></span>
                            </label>
                        </td>
                        
                        
                             
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $users->appends(request()->input())->links() }}
            </div>
        </div>
    </form>
</div>


<div class="modal fade" id="confirm-ban">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h6">{{translate('Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>{{translate('Do you really want to ban this Customer?')}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{translate('Cancel')}}</button>
                <a type="button" id="confirmation" class="btn btn-primary">{{translate('Proceed!')}}</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-unban">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h6">{{translate('Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>{{translate('Do you really want to unban this Customer?')}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">{{translate('Cancel')}}</button>
                <a type="button" id="confirmationunban" class="btn btn-primary">{{translate('Proceed!')}}</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    <!-- Delete modal -->
    @include('modals.delete_modal')
    <!-- Bulk Delete modal -->
    @include('modals.bulk_delete_modal')
@endsection

@section('script')
    <script type="text/javascript">

        $(document).on("change", ".check-all", function() {
            if(this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

        function sort_customers(el){
            $('#sort_customers').submit();
        }
        function confirm_ban(url)
        {
            if('{{env('DEMO_MODE')}}' == 'On'){
                    AIZ.plugins.notify('info', '{{ translate('Data can not change in demo mode.') }}');
                    return;
                }

            $('#confirm-ban').modal('show', {backdrop: 'static'});
            document.getElementById('confirmation').setAttribute('href' , url);
        }

        function confirm_unban(url)
        {
            if('{{env('DEMO_MODE')}}' == 'On'){
                    AIZ.plugins.notify('info', '{{ translate('Data can not change in demo mode.') }}');
                    return;
                }

            $('#confirm-unban').modal('show', {backdrop: 'static'});
            document.getElementById('confirmationunban').setAttribute('href' , url);
        }

        function bulk_delete() {
            var data = new FormData($('#sort_customers')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('bulk-customer-delete')}}",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response == 1) {
                        location.reload();
                    }
                }
            });
        }


            function updateTrnStatus(el) {
    if ('{{env('DEMO_MODE')}}' == 'On') {
        AIZ.plugins.notify('info', '{{ translate('Data cannot change in demo mode.') }}');
        return;
    }

    let status = el.checked ? 'approved' : 'Pending';

    $.post('{{ route('customers.updateTrnStatus') }}', 
        {
            _token: '{{ csrf_token() }}',
            id: el.value,
            trn_status: status
        }, 
        function(data) {
            if (data.success) {
                AIZ.plugins.notify('success', '{{ translate('Transaction status updated successfully') }}');
                // Optional: Update the display status dynamically
                $(el).closest('tr').find('.status-text').text(status);
            } else {
                AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
            }
        }
    );
}



    </script>
@endsection


