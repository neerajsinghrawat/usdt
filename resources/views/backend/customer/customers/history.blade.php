@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="align-items-center">
        <h1 class="h3">{{translate('All History')}}</h1>
    </div>
</div>


<div class="card">
    <form class="" id="sort_customers" action="" method="GET">
        <div class="card-header row gutters-5">
            {{-- <div class="col">
                <h5 class="mb-0 h6">{{translate('History')}}</h5>
            </div> --}}

            <div class="col">
                <h5 class="mb-0 h6">{{ $userName }} History</h5>
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
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Coins Added</th>
                        <th>Action</th>
                        {{-- <th>Parent ID</th> --}}
                        <th>Transaction Type</th>
                        <th>Referral Code</th>
                        <th>Comments</th>
                        <th>Type</th>
                        <th>TRN Status</th>
                        <th>Start Date</th>
                        <th>Approved Date</th>
                        {{-- <th>Created At</th> --}}
                        {{-- <th>Updated At</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($history as $record)
                        <tr>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->coins_added }}</td>
                            <td>{{ $record->action }}</td>
                            {{-- <td>{{ $record->parent_id }}</td> --}}
                            <td>{{ $record->transaction_type }}</td>
                            <td>{{ $record->referral_code }}</td>
                            <td>{{ $record->comments }}</td>
                            <td>{{ $record->type }}</td>
                            <td>{{ $record->trn_status }}</td>
                            <td>{{ $record->start_date }}</td>
                            <td>{{ $record->approved_date }}</td>
                            {{-- <td>{{ $record->created_at }}</td> --}}
                            {{-- <td>{{ $record->updated_at }}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            
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

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">{{ translate('Transaction Image') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Transaction Image" class="img-fluid">
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


            function update_published(el){

                if('{{env('DEMO_MODE')}}' == 'On'){
                    AIZ.plugins.notify('info', '{{ translate('Data can not change in demo mode.') }}');
                    return;
                }

                if(el.checked){
                    var status = 1;
                }
                else{
                    var status = 0;
                }
                $.post('{{ route('customers.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                    if(data == 1){
                        AIZ.plugins.notify('success', '{{ translate('Published User updated successfully') }}');
                    }
                    else{
                        AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                    }
                });
                }

                function viewImage(imageUrl) {
                // Log the URL for debugging
                console.log(imageUrl);

                // Set the modal image source
                document.getElementById('modalImage').src = imageUrl;

                // Display the modal
                $('#imageModal').modal('show');
                }




    </script>
@endsection


