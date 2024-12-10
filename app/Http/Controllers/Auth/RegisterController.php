<?php

namespace App\Http\Controllers\Auth;

use Nexmo;
use Cookie;
use Session;
use App\Models\Cart;
use App\Models\User;
use Twilio\Rest\Client;

use App\Rules\Recaptcha;
use Illuminate\Validation\Rule;

use App\Models\Customer;
use App\Models\UserCoinAudit;
use App\OtpConfiguration;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\OTPVerificationController;
use App\Notifications\EmailVerificationNotification;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'package_no' => 'required|integer|min:1|max:10', // Validate package_no
            'id_document' => 'required|string|max:255', // Validate ID Document
            'document_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate document image
            'g-recaptcha-response' => [
                Rule::when(get_setting('google_recaptcha') == 1, ['required', new Recaptcha()], ['sometimes'])
            ]
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $parentId = null;
        
        if (isset($data['referral_by']) && !empty($data['referral_by'])) {
            $parentUser = User::where('referral_code', $data['referral_by'])->first();
            if ($parentUser) {
                $parentId = $parentUser->id;
            }
        }

        $idDocumentPath = null;
        if (request()->hasFile('id_document')) {
            $idDocumentPath = request()->file('id_document')->store('id_documents', 'public');
        }

        $documentImagePath = null;
        if (request()->hasFile('document_image')) {
            $documentImagePath = request()->file('document_image')->move(
                public_path('uploads/document_images'),
                uniqid() . '.' . request()->file('document_image')->getClientOriginalExtension()
            );


            \Log::info('Document Image Uploaded: ' . $documentImagePath);
        } else {
            \Log::error('Document Image not uploaded');
        }

        if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'referred_by' => $data['referral_by'],
                'parent_id' => $parentId,
                'package_no' => $data['package_no'], // Save package_no
                'id_document' => $data['id_document'], // Save ID Document
                'document_image' => $documentImagePath, // Store path in DB
                'password' => Hash::make($data['password']),

            ]);

            if (isset($user->id) && isset($user->parent_id) && isset($user->referred_by) && isset($user->package_no)) {
                $this->coindivided($user->id, $user->parent_id, $user->referred_by, $user->package_no);
            }

            if (isset($user->id) && isset($user->package_no)) {
                $this->coinpack($user->id, $user->parent_id ?? null, $user->referred_by ?? null, $user->package_no);
                $this->roiDistribution($user->id);
            }
        } else {
            if (addon_is_activated('otp_system')) {
                $user = User::create([
                    'name' => $data['name'],
                    'phone' => '+' . $data['country_code'] . $data['phone'],
                    'package_no' => $data['package_no'] ?? null, // Save package_no
                    'password' => Hash::make($data['password']),
                    'verification_code' => rand(100000, 999999)
                ]);

                $otpController = new OTPVerificationController;
                $otpController->send_code($user);
            }
        }

        if (session('temp_user_id') != null) {
            if (auth()->user()->user_type == 'customer') {
                Cart::where('temp_user_id', session('temp_user_id'))
                    ->update(
                        [
                            'user_id' => auth()->user()->id,
                            'temp_user_id' => null
                        ]
                    );
            } else {
                Cart::where('temp_user_id', session('temp_user_id'))->delete();
            }
            Session::forget('temp_user_id');
        }

        if (Cookie::has('referral_code')) {
            $referral_code = Cookie::get('referral_code');
            $referred_by_user = User::where('referral_code', $referral_code)->first();
            if ($referred_by_user != null) {
                $user->referred_by = $referred_by_user->id;
                $user->save();
            }
        }

        return $user;
    }

    public function coindivided($id, $parent_id, $referred_by, $package_no)
    {
        // Base total coins
        $baseCoins = 1000;

        $totalCoins = $baseCoins * $package_no;

        $percentForParent = 5; // 5% for the first parent
        $percentForAncestor2 = 3; // 3% for second ancestor
        $percentForAncestor3 = 2; // 2% for third ancestor

        // Fetch the user who is receiving the coins (this will be the newly created user)
        $user = User::find($id);

        if ($user) {
            // Step 1: Start distributing coins to parent(s) and ancestors
            $currentUser = $user;
            $remainingCoins = $totalCoins;

            // Loop to distribute coins to parents and ancestors
            $i = 1; // This counter will help us determine the percentage for each parent

            // While there is a parent and coins to distribute
            while ($currentUser->parent_id && $remainingCoins > 0) {
                // Fetch the parent user
                $parent = User::find($currentUser->parent_id);

                if ($parent) {
                    // Determine the percentage based on the parent level
                    if ($i == 1) {
                        // 5% for the first parent
                        $coinsToParent = ($remainingCoins * $percentForParent) / 100;
                    } elseif ($i == 2) {
                        // 3% for the second ancestor
                        $coinsToParent = ($remainingCoins * $percentForAncestor2) / 100;
                    } elseif ($i == 3) {
                        // 2% for the third ancestor
                        $coinsToParent = ($remainingCoins * $percentForAncestor3) / 100;
                    } else {
                        break; // Stop if there are more than 3 ancestors
                    }

                    // Update the parent's total coins
                    $parent->pending_usdt = $parent->pending_usdt + $coinsToParent;
                    $parent->save();

                    // Add an entry in the coin audit for the parent's coin addition
                    \DB::table('user_coin_audit')->insert([
                        'user_id' => $parent->id,
                        'coins_added' => $coinsToParent,
                        'action' => 'Parent Coin Distribution',
                        'created_at' => now(),
                        'parent_id' => $currentUser->parent_id, // Store the parent ID
                        'transaction_type' => 'credit', // Example transaction type
                        'type' => 'coins_distributed',
                        'referral_code' => $referred_by, // Store referral code if available
                        'trn_status' => 'pending', // Add relevant comments
                        'start_date' => date('Y-m-d H:m:s'), // Add relevant comments
                    ]);

                    // Move to the next parent in the chain
                    $currentUser = $parent;
                    $i++; // Increment the level counter
                }
            }
        }
    }

    public function roiDistribution($id)
    {
        
        $user = User::find($id);

        if ($user) {            
            $package_amount = $user->package_amount;
            $roi_per_month = 10/100;
            $month = 25;
            $total_amount = $package_amount*$roi_per_month;

            $roiCount = UserCoinAudit::where('user_id', $id)->where('type', 'roi')->count();

            if ($roiCount < $month) {
                \DB::table('user_coin_audit')->insert([
                        'user_id' => $id,
                        'coins_added' => $total_amount,
                        'action' => 'Returns on Investment',
                        'created_at' => now(),
                        'parent_id' => $user->parent_id, // Store the parent ID
                        'transaction_type' => 'credit', // Example transaction type
                        'type' => 'roi',
                        'trn_status' => 'pending',
                        'start_date' => date('Y-m-d H:m:s'),
                    ]);
            }

            $user->pending_usdt = $user->pending_usdt + $total_amount;
            $user->save();
            
        }
    }


  
    public function coinpack($id, $parent_id, $referred_by, $package_no)
    {
        // Base total coins
        $baseCoins = 1000;
        $package_amount = $baseCoins * $package_no;

        // Fetch the user
        $user = User::find($id);

        if ($user) {
            \DB::transaction(function () use ($user, $id, $parent_id, $referred_by, $package_amount) {
                // Update package_amount and team_value
                $user->package_amount = ($user->package_amount ?? 0) + $package_amount;
                

                if (!$user->save()) {
                    throw new \Exception("Failed to update user coins for user ID: {$id}");
                }

                // Log the coin addition in the audit table
                $coinAuditData = [
                    'user_id' => $id,
                    'coins_added' => $package_amount,
                    'action' => 'User Registration Coin Allocation',
                    'created_at' => now(),
                    'transaction_type' => 'credit',
                    'type' => 'registration_USDT',
                    'referral_code' => $referred_by,
                    'comments' => 'USDT registration',
                ];

                if ($parent_id) {
                    $coinAuditData['parent_id'] = $parent_id;
                }

                \DB::table('user_coin_audit')->insert($coinAuditData);

                // Insert into team_history
                $this->insertTeamHistory($id, $parent_id, $referred_by, $package_amount);
            });
        }
    }


    public function insertTeamHistory($userId, $parentId, $referredBy, $totalCoins)
    {
        $level = 1;
        $currentUserId = $userId;
      
        // Traverse up the hierarchy and insert records for ancestors
        while ($currentUserId > 0) {

            // // Fetch the parent user
            // $parent = \DB::table('users')->where('id', $currentUserId)->first();
            // $parent->team_value = ($parent->team_value ?? 0) + $totalCoins;
            // $parent->save();
            // if ($parent) {
               

            $parent = User::find($currentUserId);

            if ($parent) {
                // Update the parent's team value
                $parent->team_value = ($parent->team_value ?? 0) + $totalCoins;
                $parent->save();
    

                \DB::table('team_history')->insert([
                    'user_id' => $parent->id,
                    'parent_id' => $parent->parent_id ?? 0, // Move to the next ancestor
                    'referred_by' => $userId,
                    'level' => $level,
                    'amount' => $totalCoins,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null
                ]);
                // Move to the next ancestor
                $currentUserId = $parent->parent_id;
                $level++;
            } else {
                break; // No more parents in the hierarchy
            }
        }
    }



    public function register(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if (User::where('email', $request->email)->first() != null) {
                flash(translate('Email or Phone already exists.'));
                return back();
            }
        } elseif (User::where('phone', '+' . $request->country_code . $request->phone)->first() != null) {
            flash(translate('Phone already exists.'));
            return back();
        }

        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        //$this->guard()->login($user);

        if ($user->email != null) {
            if (BusinessSetting::where('type', 'email_verification')->first()->value != 1) {
                $user->email_verified_at = date('Y-m-d H:m:s');
                $user->save();
                offerUserWelcomeCoupon();
                flash(translate('Registration successful.'))->success();
            } else {
                try {
                    $user->sendEmailVerificationNotification();
                    flash(translate('Registration successful. Please verify your email.'))->success();
                } catch (\Throwable $th) {
                    $user->delete();
                    flash(translate('Registration failed. Please try again later.'))->error();
                }
            }
        }

        // return $this->registered($request, $user)
        //     ?: redirect($this->redirectPath());
        
        return redirect()->route('user.login_pay', ['id' => $user->id]);
    }

    protected function registered(Request $request, $user)
    {
        if ($user->email == null) {
            return redirect()->route('verification');
        } elseif (session('link') != null) {
            return redirect(session('link'));
        } else {
            return redirect()->route('home');
        }
    }
}
