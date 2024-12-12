<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\UserCoinAudit;
use App\Models\WithdrawalRequest;
use App\Models\TeamHistory;

class CustomerController extends Controller
{
    public function __construct()
    {
        // Staff Permission Check
        $this->middleware(['permission:view_all_customers'])->only('index');
        $this->middleware(['permission:login_as_customer'])->only('login');
        $this->middleware(['permission:ban_customer'])->only('ban');
        $this->middleware(['permission:delete_customer'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $users = User::where('user_type', 'customer')->where('email_verified_at', '!=', null)->orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $users->where(function ($q) use ($sort_search) {
                $q->where('name', 'like', '%' . $sort_search . '%')->orWhere('email', 'like', '%' . $sort_search . '%');
            });
        }
        $users = $users->paginate(15);
        return view('backend.customer.customers.index', compact('users', 'sort_search'));
    }


    public function user_tree($id)
    {
        // Decrypt the user ID
        $userId = decrypt($id);
        
        // Fetch the user who clicked
        $user = User::find($userId);
    
        
    
        // Fetch the user tree
        $userTree = $this->getUsersUnder($user->referral_code);
        
        // Return a view to show the user tree
        return view('backend.customer.customers.user_tree', compact('user', 'userTree'));
    }
    
    
// Function to fetch all users under a given referral code (recursive approach)
    private function getUsersUnder($referralCode)
{
    // Fetch users with this referral code
    $users = User::with('referred_by_user')->where('referred_by', $referralCode)->get();

    // You can add more levels of recursion if needed to fetch all nested users
    foreach ($users as $user) {
        // Recursively find users under this user
        $user->descendants = $this->getUsersUnder($user->referral_code);
        
        // Calculate the number of descendants (users under this user)
        $user->descendant_count = $user->descendants->count();
        
        // Debugging - Print user details along with the referral code and descendant count
        // echo '<pre>';
        // print_r([
        //     'user' => $user->user_name,
        //     'referral_code' => $user->referral_code,
        //     'descendant_count' => $user->descendant_count
        // ]);
        // echo '</pre>';
    }

    return $users;
}


public function team_member($id)
{
    // Decrypt the user ID
    $userId = decrypt($id);

    // Fetch the user details
    $user = User::find($userId);

    if (!$user) {
        abort(404, 'User not found');
    }

    // Fetch the team history where the parent_id is the user's id
    $teamMembers = TeamHistory::with('referreduser')
        ->where('parent_id', $userId)
        ->get();

    // Fetch team value for the user
    $teamValue = $user->team_value;

    // Return the view with the required data
    return view('backend.customer.customers.team_member', compact('user', 'teamMembers', 'teamValue'));
}


/**
 * Recursive function to get all team members under a user.
 *
 * @param int $parentId
 * @return Collection
 */
private function getAllTeamMembers($parentId)
{
    // Fetch direct children of the user
    $directMembers = TeamHistory::with('referreduser')
        ->where('parent_id', $parentId)
        ->get();

    $allMembers = collect();

    foreach ($directMembers as $member) {
        // Add the current member to the collection
        $allMembers->push($member);

        // Recursively fetch and add children of the current member
        $allMembers = $allMembers->merge($this->getAllTeamMembers($member->user_id));
    }

    return $allMembers;
}




// echo '<pre>';
    // print_r($user);
    // echo '</pre>';
    // die();


    

    public function pay_request(Request $request)
    {
        $sort_search = null;
        
        $users = User::where('user_type', 'customer')
            ->whereNotNull('email_verified_at')
            ->whereHas('userCoinAudit', function ($query) {
                $query->where('type', 'roi'); // Ensure type = 'roi'
            })
            // ->with(['userCoinAudit' => function ($query) {
            //     $query->where('type', 'roi') // Fetch only 'roi' type records in the relationship
            //           ->where('trn_status', 'pending'); // Fetch only 'pending' status
            // }])
            ->with(['userCoinAudit' => function ($query) {
                $query->where('type', 'roi'); // Fetch only 'roi' type records in the relationship
                
            }])
            ->orderBy('created_at', 'desc');
    
        // Add search functionality
        if ($request->has('search')) {
            $sort_search = $request->search;
            $users->where(function ($q) use ($sort_search) {
                $q->where('name', 'like', '%' . $sort_search . '%')
                    ->orWhere('email', 'like', '%' . $sort_search . '%');
            });
        }
    
        // Add filter by requested_usdt
        if ($request->has('requested_usdt') && $request->requested_usdt != '') {
            $users->whereHas('userCoinAudit', function ($query) use ($request) {
                $query->where('coins_added', '>=', $request->requested_usdt); // Adjust condition as needed
            });
        }
    
        // Add filter by approval status
        if ($request->has('approval') && $request->approval != '') {
            $users->whereHas('userCoinAudit', function ($query) use ($request) {
                $query->where('trn_status', $request->approval); // Filtering by 'trn_status' field
            });
        }
    
        // Add filter by start and end date
        if ($request->has('start_date') && $request->start_date != '') {
            $users->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date != '') {
            $users->whereDate('created_at', '<=', $request->end_date);
        }
    
        // Paginate the results
        $users = $users->paginate(15);
    
        return view('backend.customer.customers.payrequest', compact('users', 'sort_search'));
    }
    
    
    
   
    public function updateTrnStatus(Request $request)
{
    try {
        // Validate the input to ensure only 'Pending' or 'approved' are accepted
        $request->validate([
            'trn_status' => 'required|in:Pending,approved',
        ]);

        // Find the record in the userCoinAudit table
        $audit = UserCoinAudit::findOrFail($request->id);

        // Check if the status is being updated to 'approved'
        if ($request->trn_status === 'approved') {
            // Fetch the associated user
            $user = User::findOrFail($audit->user_id);

            // Update the user's wallet_usdt field by adding the coins_added value
            $user->wallet_usdt += $audit->coins_added;

            $user->save();

               // Update the approved_date field with the current timestamp
               $audit->approved_date = now(); // or Carbon::now() if using Carbon
        }

        // Update the trn_status field
        $audit->trn_status = $request->trn_status;
        $audit->save();

        // Respond with success
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        // Handle errors
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}



public function Withdrawal_request(Request $request)
{
    $sort_search = null;
    $usersQuery = User::where('user_type', 'customer')
        ->whereNotNull('email_verified_at')
        ->orderBy('created_at', 'desc');

    // Search filter if present
    if ($request->has('search')) {
        $sort_search = $request->search;
        $usersQuery->where(function ($query) use ($sort_search) {
            $query->where('name', 'like', '%' . $sort_search . '%')
                  ->orWhere('email', 'like', '%' . $sort_search . '%');
        });
    }

    // Eager load the related withdrawal requests along with selected fields
    $users = $usersQuery->with(['withdrawalRequests' => function ($query) {
        $query->select(
            'id',
            'user_id',
            'type',
            'comments',
            'start_date',
            'approved_date',
            'transaction_type',
            'status',
            'amount',
            'wallet_url'
        );
    }])->paginate(15);

    return view('backend.customer.customers.Withdrawal', compact('users', 'sort_search'));
}

// public function updateWithStatus(Request $request)
// {
//     \Log::info('Request data:', $request->all());
    
//     $request->validate([
//         'id' => 'required|exists:withdrawal_requests,id',
//         'trn_status' => 'required|string|in:approved,rejected,pending',
//         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
//     ]);


//     try {
//         $withdrawalRequest = WithdrawalRequest::findOrFail($request->id);
//         $withdrawalRequest->status = $request->trn_status;

//         // Update approved_date only if status is 'approved'
//         if ($request->trn_status == 'approved') {
//             $withdrawalRequest->approved_date = now();
//         } else {
//             $withdrawalRequest->approved_date = null;
//         }

//         if ($withdrawalRequest->save()) {
//             if ($request->trn_status == 'approved') {

//                 $this->updateWallet($withdrawalRequest);
//             }
//             return response()->json(['success' => true, 'message' => 'Updated successfully.']);
//         } else {
//             return response()->json(['success' => false, 'message' => 'Failed to update .']);
//         }
        
//     } catch (\Exception $e) {
//         \Log::error('Error updating status:', ['message' => $e->getMessage()]);
//         return response()->json(['success' => false, 'message' => 'An error occurred.']);
//     }
// }


public function updateWithStatus(Request $request)
{
    \Log::info('Request data:', $request->all());

    // Validate the incoming request
    $request->validate([
        'id' => 'required|exists:withdrawal_requests,id',
        'trn_status' => 'required|string|in:approved,rejected,pending',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Optional image validation
    ]);

    try {
        // Find the withdrawal request
        $withdrawalRequest = WithdrawalRequest::findOrFail($request->id);
        $withdrawalRequest->status = $request->trn_status;

        // Handle image upload if status is 'approved'
        if ($request->trn_status == 'approved') {
            if ($request->hasFile('image')) {
                // Store the uploaded image
                $image = $request->file('image');
                $imagePath = $image->store('withdrawal_images', 'public'); // Store in the 'withdrawal_images' directory

                // Save the image path to the withdrawal request
                $withdrawalRequest->image = $imagePath;
            }
            $withdrawalRequest->approved_date = now();
        } else {
            $withdrawalRequest->approved_date = null;
        }

        // Save the withdrawal request
        if ($withdrawalRequest->save()) {
            if ($request->trn_status == 'approved') {
                // Call the method to update the wallet or any other logic
                $this->updateWallet($withdrawalRequest);
            }

            return response()->json(['success' => true, 'message' => 'Updated successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to update.']);
        }

    } catch (\Exception $e) {
        \Log::error('Error updating status:', ['message' => $e->getMessage()]);
        return response()->json(['success' => false, 'message' => 'An error occurred.']);
    }
}



public function updateWallet($withdrawalRequest='')
{   
    if (!empty($withdrawalRequest)) {
        $user = User::findOrFail($withdrawalRequest->user_id);
        if ($user->wallet_usdt >= $withdrawalRequest->amount) {
            $user->wallet_usdt -= $withdrawalRequest->amount;
            $user->save();
        }
        
    }

    return true;
}





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|unique:users|email',
            'phone'         => 'required|unique:users',
        ]);

        $response['status'] = 'Error';

        $user = User::create($request->all());

        $customer = new Customer;

        $customer->user_id = $user->id;
        $customer->save();

        if (isset($user->id)) {
            $html = '';
            $html .= '<option value="">
                        ' . translate("Walk In Customer") . '
                    </option>';
            foreach (Customer::all() as $key => $customer) {
                if ($customer->user) {
                    $html .= '<option value="' . $customer->user->id . '" data-contact="' . $customer->user->email . '">
                                ' . $customer->user->name . '
                            </option>';
                }
            }

            $response['status'] = 'Success';
            $response['html'] = $html;
        }

        echo json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->customer_products()->delete();

        User::destroy($id);
        flash(translate('Customer has been deleted successfully'))->success();
        return redirect()->route('customers.index');
    }

    public function bulk_customer_delete(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $customer_id) {
                $customer = User::findOrFail($customer_id);
                $customer->customer_products()->delete();
                $this->destroy($customer_id);
            }
        }

        return 1;
    }

    public function login($id)
    {
        $user = User::findOrFail(decrypt($id));

        auth()->login($user, true);

        return redirect()->route('dashboard');
    }

    public function ban($id)
    {
        $user = User::findOrFail(decrypt($id));

        if ($user->banned == 1) {
            $user->banned = 0;
            flash(translate('Customer UnBanned Successfully'))->success();
        } else {
            $user->banned = 1;
            flash(translate('Customer Banned Successfully'))->success();
        }

        $user->save();

        return back();
    }
    public function updatePublished(Request $request)
    {
        $customer = User::findOrFail($request->id);
        $customer->status = $request->status;
        $customer->save();

        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        return 1;
    }
}
