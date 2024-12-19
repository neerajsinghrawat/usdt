@extends('backend.layouts.app')

@section('content')

<div id="loader" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1050;">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<style>
    #loader {
    background: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1050; /* Ensure it stays above other elements */
    display: flex;
    justify-content: center;
    align-items: center;
}
.spinner-border {
    width: 3rem;
    height: 3rem;
}

</style>

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
                        
                        {{-- <th>{{translate('Type')}}</th> --}}
                        <th>{{translate('Comments')}}</th>
                        <th>{{translate('Wallet Url')}}</th>
                        <th>{{translate('Start Date')}}</th>
                        <th>{{translate('Approved Date')}}</th>
                        <th data-breakpoints="lg">{{translate('wallet image')}}</th>

                        {{-- <th>{{translate('Transaction Type')}}</th> --}}
                        <th>{{translate('Status')}}</th>
                        <th>{{translate('Amount')}}</th>
                        <th>{{translate('Transaction Charges')}}</th>
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
                                    <td>{{ single_price( $request->user->wallet_usdt) }}</td>
                                    <td>{{  single_price( $request->user->package_amount) }}</td>
                                    {{-- <td>{{ $request->type }}</td> --}}
                                    <td>{{ $request->comments }}</td>
                                    <td>{{ $request->wallet_url ?? 'No URL' }}</td>
                                    
                                    <td>{{ $request->start_date }}</td>
                                    <td>{{ $request->approved_date }}</td>

                                   <!-- Table Cell -->
                                    <td>
                                        @if($request->wallet_image)
                                            <button 
                                                class="btn btn-primary" type="button"
                                                onclick="viewImage('{{ asset('public/' . $request->wallet_image) }}')"
                                            >
                                                View Image
                                            </button>
                                        @else
                                            {{ translate('No image available') }}
                                        @endif
                                    </td>

                                    {{-- <td>{{ $request->transaction_type }}</td> --}}
                                    <td class="action-text">{{ ucfirst($request->status) }}</td>
                                    <td>{{  single_price( $request->amount-$request->transaction_charges )}}</td>
                                    <td>{{  single_price( $request->transaction_charges ) }}</td>
                                    {{-- <td>
                                        @if($request->status == 'pending')
                                            <button class="btn btn-primary" onclick="if(confirm('Are you sure you want to approve?')) updateWithStatus(this, 'approved')">Approve</button>
                                           
                                        @endif
                                    </td> --}}
                                    <td>
                                        @if($request->status == 'pending')
                                            <button class="btn btn-primary" onclick="openUploadModal(this)">Approve</button>
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


<!-- Image Upload Modal -->
<div id="uploadModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload translation Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="wallet-display">
                    <p style="font-size: 1.2rem; color: #4caf50; text-align: center; margin-bottom: 1rem;">
                        <strong>User Withdrawal Request TRC 20: 
                            <span>{{ single_price( $request->amount - $request->transaction_charges) }}</span>
                        </strong>
                    </p>
                </div>
            </div>
            

            <div class="modal-body">
                <form id="uploadImageForm" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" accept="image/*" required>
                    <input type="hidden" id="requestId" name="id">
                    <input type="hidden" id="status" name="trn_status" value="approved">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitImageAndUpdate()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Wallet Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Wallet Image" class="img-fluid" />
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


       
    function openUploadModal(el) {
        const requestId = $(el).closest('tr').data('id');
        $('#requestId').val(requestId);  // Set the request ID in the hidden field
        $('#uploadModal').modal('show'); // Show the modal
    }

    function submitImageAndUpdate() {
        const formData = new FormData($('#uploadImageForm')[0]);

        // Show loader before the AJAX request
        $('#loader').show();  

        $.ajax({
            url: '{{ route('customers_updateWithStatus') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#loader').hide();  // Hide the loader on successful response
                if (response.success) {
                    AIZ.plugins.notify('success', '{{ translate('Transaction status updated successfully') }}');
                    $('#uploadModal').modal('hide');  // Close the modal
                    location.reload();  // Reload the page to reflect the changes
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            },
            error: function(xhr) {
                $('#loader').hide();  // Hide the loader if an error occurs
                AIZ.plugins.notify('danger', 'An error occurred while uploading the image.');
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

        // Show loader before making the AJAX call
        $('#loader').show();

        $.ajax({
            url: '{{ route('customers_updateWithStatus') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: requestId,
                status: status
            },
            success: function(response) {
                $('#loader').hide();  // Hide loader after response
                if (response.success) {
                    AIZ.plugins.notify('success', '{{ translate('Status updated successfully') }}');
                    location.reload();  // Reload the page
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Failed to update status') }}');
                }
            },
            error: function(xhr) {
                $('#loader').hide();  // Hide loader if error
                AIZ.plugins.notify('danger', 'An error occurred while updating the status.');
            }
        });
    }



    
    function viewImage(imageUrl) {
    console.log(imageUrl); // Log the URL for debugging
    document.getElementById('modalImage').src = imageUrl; // Set the image URL in the modal
    $('#imageModal').modal('show'); // Show the modal
}



</script>

@endsection


