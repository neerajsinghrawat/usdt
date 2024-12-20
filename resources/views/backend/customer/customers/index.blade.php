@extends('backend.layouts.app')

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
@section('content')

<div id="loader" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1050;">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>


<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="align-items-center">
        <h1 class="h3">{{translate('All users')}}</h1>
    </div>
</div>


<div class="card">
    <form class="" id="sort_customers" action="" method="GET">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-0 h6">{{translate('users')}}</h5>
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
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <!--<th data-breakpoints="lg">#</th>-->
                        <th>
                            <div class="form-group">
                                <div class="aiz-checkbox-inline">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" class="check-all">
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                            </div>
                        </th>
                        <th>{{translate('Name')}}</th>
                        <th data-breakpoints="lg">{{translate('Email Address')}}</th>
                        <th data-breakpoints="lg">{{translate('Phone')}}</th>
                        <th data-breakpoints="lg">{{translate('referral Code')}}</th>
                        <th data-breakpoints="lg">{{translate('Team value')}}</th>
                        <th data-breakpoints="lg">{{translate('Package')}}</th>
                        <th data-breakpoints="lg">{{translate('Wallet Balance')}}</th>
                        <th data-breakpoints="lg">{{translate('transaction image')}}</th>
                        <th data-breakpoints="lg">{{translate('Active')}}</th>
                        <th class="text-right">{{translate('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                        @if ($user != null)
                            <tr>
                                <!--<td>{{ ($key+1) + ($users->currentPage() - 1)*$users->perPage() }}</td>-->
                                <td>
                                    <div class="form-group">
                                        <div class="aiz-checkbox-inline">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" class="check-one" name="id[]" value="{{$user->id}}">
                                                <span class="aiz-square-check"></span>
                                            </label>
                                        </div>
                                    </div>
                                </td>
                                <td>@if($user->banned == 1) <i class="fa fa-ban text-danger" aria-hidden="true"></i> @endif {{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->referral_code}}</td>
                                <td>{{$user->team_value}}</td>
                                <td>{{$user->package_amount}}</td>
                                
                                <td>{{single_price($user->wallet_usdt)}}</td>
                                {{-- <td>{{$userfsadf->transaction_image}}</td>
                                 --}}
                              
                                 <td>
                                    @if($user->transaction_image)
                                        <button 
                                            class="btn btn-primary" type="button"
                                            onclick="viewImage('{{ asset('public/' . $user->transaction_image) }}')"
                                        >
                                            View Image
                                        </button>
                                    @else
                                        {{ translate('No image available') }}
                                    @endif
                                </td>
                                  
                                
                                
                                
                                
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input onchange="update_published(this)" value="{{ $user->id }}" type="checkbox" <?php if ($user->status == 1) echo "checked"; ?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>



                            <td class="text-right">

                                {{-- View Members Button --}}
                                <a target="_blank" href="{{ route('users.member', $user->id )}}" 
                                    class="btn btn-soft-info btn-icon btn-circle btn-sm" 
                                    title="{{ 'Members' }}" 
                                    style="text-decoration: none;">
                                    <i class="las la-user"></i>
                                </a>

                                {{-- View Team Members Button --}}
                                <a target="_blank" href="{{ route('users.team_member', $user->id) }}" 
                                    class="btn btn-soft-info btn-icon btn-circle btn-sm" 
                                    title="{{ 'Team Members' }}" 
                                    style="text-decoration: none;">
                                    <i class="las la-users"></i>
</a>

                                    {{-- tree --}}
                                    {{-- @can('login_as_customer')
                                        <a href="{{route('customers.login', encrypt($user->id))}}" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="{{ translate('Log in as this Customer') }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                    @endcan --}}

                                    <a target="_blank" href="{{ route('users.history', $user->id) }}" 
                                        class="btn btn-soft-info btn-icon btn-circle btn-sm" 
                                        title="{{ 'View History' }}" 
                                        style="text-decoration: none;">
                                        <i class="las la-history"></i>
                                    </a>
                                      {{-- User Tree Button --}}

                                      <a target="_blank" href="{{ route('users.tree', $user->id) }}" 
                                        class="btn btn-soft-primary btn-icon btn-circle btn-sm" 
                                        title="{{ 'User Tree' }}" 
                                        style="text-decoration: none;">
                                        <i class="las la-sitemap"></i>
                                    </a>
                                    

                                    @can('ban_customer')
                                        @if($user->banned != 1)
                                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm" onclick="confirm_ban('{{route('customers.ban', encrypt($user->id))}}');" title="{{ translate('Ban this Customer') }}">
                                                <i class="las la-user-slash"></i>
                                            </a>
                                            @else
                                            <a href="#" class="btn btn-soft-success btn-icon btn-circle btn-sm" onclick="confirm_unban('{{route('customers.ban', encrypt($user->id))}}');" title="{{ translate('Unban this Customer') }}">
                                                <i class="las la-user-check"></i>
                                            </a>
                                        @endif
                                    @endcan
                                    
                                    {{-- @can('delete_customer')
                                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('customers.destroy', $user->id)}}" title="{{ translate('Delete') }}">
                                            <i class="las la-trash"></i>
                                        </a>
                                    @endcan --}}
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


        function update_published(el) {
            if ('{{ env("DEMO_MODE") }}' === 'On') {
                AIZ.plugins.notify('info', '{{ translate("Data cannot be changed in demo mode.") }}');
                return;
            }

            const status = el.checked ? 1 : 0;

            // Show the loader
            $('#loader').show(); // Assuming you have an element with id="loader"

            $.post('{{ route("customers.published") }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            })
            .done(function(data) {
                // Hide the loader once the request is done
                $('#loader').hide();

                if (data.success) {
                    AIZ.plugins.notify('success', '{{ translate("Published User updated successfully") }}');
                } else {
                    AIZ.plugins.notify('danger', data.message || '{{ translate("Something went wrong") }}');
                }
            })
            .fail(function(xhr) {
                // Hide the loader in case of failure
                $('#loader').hide();

                const error = xhr.responseJSON?.message || '{{ translate("An error occurred.") }}';
                AIZ.plugins.notify('danger', error);
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


