<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\WithdrawalRequest;
use App\Models\UserCoinAudit;
use Auth;
use Session;

class WalletController extends Controller
{
    public function __construct()
    {
        // Staff Permission Check
        $this->middleware(['permission:view_all_offline_wallet_recharges'])->only('offline_recharge_request');
    }

    public function index()
    {
          
        //$wallets = Wallet::where('user_id', Auth::user()->id)->latest()->paginate(10);
        $wallets = 
        $wallets = UserCoinAudit::where('user_id', Auth::user()->id)->whereIn('type', ['coins_distributed', 'roi'])->latest()->paginate(50);
        
           
        return view('frontend.user.wallet.index', compact('wallets'));
    }

    
        // public function withdrawal(Request $request)
        // {
        //     $charge = 3;
        //     $min_withdrawal_amount = 10;
        //     $data['wallet_url'] = $request->wallet_url;
        //     $data['amount'] = $request->amount;
        //     $data['withdrawal_code'] = $request->code;
        //     if (Auth::check()) {
        //         if (Auth::user()->status == 1 && Auth::user()->payment_status == 'completed') {
        //             $user = Auth::user();

        //             if ($user->withdrawal_code == $request->code) {
        //                 if ($user->wallet_usdt >= $request->amount && $min_withdrawal_amount <= $request->amount){
        //                     $wallet_image='';
        //                     if ($request->hasFile('image')) {
        //                         $file = $request->file('image');
        //                         $filename = time() . '_' . $file->getClientOriginalName();
        //                         $filePath = 'uploads/transactions/withdrawal/';                                
        //                         // Move the file to the desired location
        //                         $file->move(public_path($filePath), $filename);
        //                         $wallet_image = $filePath . $filename;

        //                     }
        //                     //$user->wallet_usdt -= $request->amount;
        //                     $withdrawalRequest = WithdrawalRequest::create([
        //                         'user_id' =>  $user->id,
        //                         'comments' => 'Withdrawal request for manual transaction',
        //                         'start_date' => now(),
        //                         'status' => 'pending',
        //                         'wallet_url' => $data['wallet_url'],
        //                         'amount' => $request->amount,            
        //                         'transaction_charges' => $charge,            
        //                         'wallet_image' => $wallet_image,            
        //                     ]);
        //                     //$user->save();
        //                     flash(translate('Withdrawal Request sent successfully'))->success();
        //                 }else{
        //                     flash(translate('Withdrawal Request failed. Insufficient wallet balance.'))->error();
        //                 }
        //             }else{
        //                 flash(translate('Your code is wrong please enter code from email.'))->error(); 
        //             } 
                    
        //         }else{
        //            flash(translate('Your not active user and your package payment is pending'))->error(); 
        //         }
                
        //     }else{
        //         flash(translate('Please Login First!'))->error();
        //     }
        //     return redirect()->route('dashboard');
    
        // }


        public function withdrawal(Request $request)
{
    $charge = 3;
    $min_withdrawal_amount = 10;
    $data['wallet_url'] = $request->wallet_url;
    $data['amount'] = $request->amount;
    $data['withdrawal_code'] = $request->code;

    if (Auth::check()) {
        if (Auth::user()->status == 1 && Auth::user()->payment_status == 'completed') {
            $user = Auth::user();

            if ($user->withdrawal_code == $request->code) {
                // Calculate the total of all pending withdrawal requests by the user
                $totalPendingAmount = WithdrawalRequest::where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->sum('amount');

                // Check if the requested amount plus pending requests exceeds wallet balance
                if ($user->wallet_usdt >= ($totalPendingAmount + $request->amount) && $min_withdrawal_amount <= $request->amount) {
                    $wallet_image = '';
                    if ($request->hasFile('image')) {
                        $file = $request->file('image');
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $filePath = 'uploads/transactions/withdrawal/';
                        $file->move(public_path($filePath), $filename);
                        $wallet_image = $filePath . $filename;
                    }

                    // Create the withdrawal request
                    WithdrawalRequest::create([
                        'user_id' => $user->id,
                        'comments' => 'Withdrawal request for manual transaction',
                        'start_date' => now(),
                        'status' => 'pending',
                        'wallet_url' => $data['wallet_url'],
                        'amount' => $request->amount,
                        'transaction_charges' => $charge,
                        'wallet_image' => $wallet_image,
                    ]);

                    flash(translate('Withdrawal Request sent successfully'))->success();
                } else {
                    flash(translate('Withdrawal Request failed. Insufficient wallet balance or total requested amount exceeds wallet balance.'))->error();
                }
            } else {
                flash(translate('Your code is wrong, please enter the code from email.'))->error();
            }
        } else {
            flash(translate('You are not an active user, and your package payment is pending.'))->error();
        }
    } else {
        flash(translate('Please login first!'))->error();
    }

    return redirect()->route('dashboard');
}


    public function recharge(Request $request)
    {
        $data['amount'] = $request->amount;
        $data['payment_method'] = $request->payment_option;

        $request->session()->put('payment_type', 'wallet_payment');
        $request->session()->put('payment_data', $data);

        $decorator = __NAMESPACE__ . '\\Payment\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $request->payment_option))) . "Controller";
        if (class_exists($decorator)) {
            return (new $decorator)->pay($request);
        }
    }


    public function wallet_payment_done($payment_data, $payment_details)
    {
        $user = Auth::user();
        $user->balance = $user->balance + $payment_data['amount'];
        $user->save();

        $wallet = new Wallet;
        $wallet->user_id = $user->id;
        $wallet->amount = $payment_data['amount'];
        $wallet->payment_method = $payment_data['payment_method'];
        $wallet->payment_details = $payment_details;
        $wallet->save();

        Session::forget('payment_data');
        Session::forget('payment_type');

        flash(translate('Recharge completed'))->success();
        return redirect()->route('wallet.index');
    }

    public function offline_recharge(Request $request)
    {
        $wallet = new Wallet;
        $wallet->user_id = Auth::user()->id;
        $wallet->amount = $request->amount;
        $wallet->payment_method = $request->payment_option;
        $wallet->payment_details = $request->trx_id;
        $wallet->approval = 0;
        $wallet->offline_payment = 1;
        $wallet->reciept = $request->photo;
        $wallet->save();
        flash(translate('Offline Recharge has been done. Please wait for response.'))->success();
        return redirect()->route('wallet.index');
    }

    public function offline_recharge_request(Request $request)
    {
        $wallets = Wallet::where('offline_payment', 1);
        $type = null;
        if ($request->type != null) {
            $wallets = $wallets->where('approval', $request->type);
            $type = $request->type;
        }
        $wallets = $wallets->orderBy('id','desc')->paginate(10);
        return view('manual_payment_methods.wallet_request', compact('wallets', 'type'));
    }

    public function updateApproved(Request $request)
    {
        $wallet = Wallet::findOrFail($request->id);
        $wallet->approval = $request->status;
        if ($request->status == 1) {
            $user = $wallet->user;
            $user->balance = $user->balance + $wallet->amount;
            $user->save();
        } else {
            $user = $wallet->user;
            $user->balance = $user->balance - $wallet->amount;
            $user->save();
        }
        if ($wallet->save()) {
            return 1;
        }
        return 0;
    }
}
