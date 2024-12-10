@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="align-items-center">
        <h1 class="h3">{{translate('All Withdrawal Request')}}</h1>
    </div>
</div>


<div class="card">

        <form class="" id="filter_form" action="{{ route('pay-request') }}" method="GET">
            <div class="card-header row gutters-5  text-right" >
                <div class="col">
                    <h5 class="mb-0 h6">{{translate('Withdrawal Request')}}</h5>
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
                        <th>{{translate('SR No.')}}</th>
                        <th>{{translate('Name')}}</th>
                        <th>{{translate('Email Address')}}</th>
                        <th>{{translate('Wallet USDT')}}</th>
                        <th>{{translate('Package Amount')}}</th>
                        
                        <th>{{translate('Type')}}</th>
                        <th>{{translate('Comments')}}</th>
                        <th>{{translate('Start Date')}}</th>
                        <th>{{translate('Approved Date')}}</th>
                        <th>{{translate('Transaction Type')}}</th>
                        <th>{{translate('Status')}}</th>
                        <th>{{translate('Amount')}}</th>
                        <th>{{translate('Approval')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        @if ($user->withdrawalRequests)
                            @foreach($user->withdrawalRequests as $request)
                                <tr data-id="{{ $request->id }}">
                                    <td>{{ $loop->parent->iteration + $loop->index + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td>{{ $request->user->name }}</td>
                                    <td>{{ $request->user->email }}</td>
                                    <td>{{ $request->user->wallet_usdt }}</td>
                                    <td>{{ $request->user->package_amount }}</td>
                                    <td>{{ $request->type }}</td>
                                    <td>{{ $request->comments }}</td>
                                    <td>{{ $request->start_date }}</td>
                                    <td>{{ $request->approved_date }}</td>
                                    <td>{{ $request->transaction_type }}</td>
                                    <td class="action-text">{{ ucfirst($request->status) }}</td>
                                    <td>{{ $request->amount }}</td>
                                    <td>
                                        @if($request->status == 'pending')
                                            <button class="btn btn-primary" onclick="if(confirm('Are you sure you want to approve?')) updateWithStatus(this, 'approved')">Approve</button>
                                            <!-- 
                                            <select class="form-control form-control-sm status-dropdown" onclick="updateWithStatus(this, this.value)">
                                                <option value="">Select Action</option>
                                                <option value="approved" {{ $request->status == 'approved' ? 'selected' : '' }}>Approve</option>
                                                <option value="rejected" {{ $request->status == 'rejected' ? 'selected' : '' }}>Reject</option>
                                                <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            </select> -->
                                        @endif
                                    </td>
                                    
                                </tr>
                            @endforeach
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

    function updateWithStatus(el, status) {

        if (!status) {
            console.warn('No status selected.');
            return;
        }

        console.log('Update called with status:', status);
        

        const requestId = $(el).closest('tr').data('id');
        if (!requestId) {
            console.error('Request ID is missing. Verify `data-id` in table rows.');
            return;
        }
        // Disable the dropdown to prevent multiple submissions
        $(el).prop('disabled', true);

        $.ajax({
            url: '{{ route('customers_updateWithStatus') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: requestId,
                trn_status: status
            },
            success: function (response) {
                console.log('Server Response:', response);
                //alert(response.success);
                if (response.success) {
                    AIZ.plugins.notify('success', '{{ translate(' Transaction status updated successfully') }}');

                    const statusCapitalized = status.charAt(0).toUpperCase() + status.slice(1);
                    $(el).closest('tr').find('.action-text').text(statusCapitalized);

                    // Update approved_date dynamically
                    if (status === 'approved') {
                        $(el).closest('tr').find('.approved-date-text').text(new Date().toLocaleString());
                    } else {
                        $(el).closest('tr').find('.approved-date-text').text('');
                    }
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
                location.reload();
            },
            error: function (xhr) {
                console.error('Request failed:', xhr.responseText);
                AIZ.plugins.notify('danger', 'An error occurred while updating status.');
            },
            complete: function () {
                // Re-enable the dropdown after processing
                $(el).prop('disabled', false);
            }
        });
}




    </script>
@endsection


