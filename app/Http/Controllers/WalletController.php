<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WalletTransactions;
use App\Models\Order;
use App\Models\Wallet;
use DB;
use Validator;
use Auth;

class WalletController extends Controller
{
    public function vandor_list_wallet(){
        $data['vandors']=User::where('role_id',3)->orderBy('id','desc')->get();
        return view('admin.all_users.vandors.wallet_list')->with($data);

    }

    public function vandor_wallet_withdraw_approve($id){
        $obj=Wallet::where('id','=', $id)->update(['WithdrawReq'=>'Approved']);
        return back()->with("success",'withdrawl request disapproved');
    }
    
    public function vandor_wallet_withdraw_disapprove($id){
        $obj=Wallet::where('id','=', $id)->update(['WithdrawReq'=>'P']);
        return back()->with("success",'withdrawl request disapproved');
        // dd($id);
    }

    public function vandor_wallet_view($id){
        $data['wallet_total']=Wallet::where('user_id',$id)->where('status','A')->sum('balance');
        $data['withdraw']=Wallet::where('user_id',$id)->where('status','A')->where('WithdrawReq','Approved')->sum('balance');
        // dd($data);
        $data['vendor_id'] = $id;
        
        $data['wallet_total'] = $data['wallet_total'] - $data['withdraw'];

        $data['transaction_total']=WalletTransactions::where('user_id',$id)->sum('amount');
        $data['withdraw'] = $data['withdraw'] - $data['transaction_total'];

        $data['wallet']=DB::table('orders')->join('users', 'users.id', '=', 'orders.vendor_user_id')
            ->join('wallets', 'wallets.order_id', '=', 'orders.id')
            ->select('wallets.id','customer_email', 'customer_phone', 'total_price','event_address','event_pin','wallets.status','wallets.WithdrawReq')
            ->where('users.id',$id)
            ->get();

        // dd($data);
        // $data['orders']=Order::where('vendor_user_id',$id)->where('vandor_order_status',"AP")->get();
        return view('admin.all_users.vandors.wallet_view')->with($data);
    }
    
    
    public function wallet_view($id){
        $data['wallet_total']=Wallet::where('user_id',Auth::user()->id)->where('status','A')->sum('balance');
        // dd($data);
        $data['withdraw']=Wallet::where('user_id',Auth::user()->id)->where('status','A')->where('WithdrawReq','Approved')->sum('balance');
        
        $data['wallet_total'] = $data['wallet_total'] - $data['withdraw'];

        $data['transaction_total']=WalletTransactions::where('user_id',Auth::user()->id)->sum('amount');
        $data['withdraw'] = $data['withdraw'] - $data['transaction_total'];
        

        $data['transaction_total']=WalletTransactions::where('user_id',Auth::user()->id)->sum('amount');
        $data['wallet']=DB::table('orders')->join('users', 'users.id', '=', 'orders.vendor_user_id')
            ->join('wallets', 'wallets.order_id', '=', 'orders.id')
            ->select('wallets.id','customer_email', 'customer_phone', 'total_price','event_address','event_pin')
            ->where('users.id',Auth::user()->id)
            ->get();

        // dd($data);
        // $data['orders']=Order::where('vendor_user_id',$id)->where('vandor_order_status',"AP")->get();
        return view('vandor.wallet.wallet_view')->with($data);
    }

    public function WithDrawWallet(Request $request){
        $validator = Validator::make($request->all(), [ 
            'wallet_amount' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
       }
       $data=Wallet::where('user_id',Auth::user()->id)->where('status','A')->where('WithdrawReq','Approved')->sum('balance');
        $data = intval($data);
        // dd($request->wallet_amount);
        $amount = intval($request->wallet_amount);
       if ($data >= $amount) {
        $WalletTransaction=new WalletTransactions;
       $WalletTransaction->user_id=$request->user_id;
       $WalletTransaction->transaction_type='Bank Transfer';
       $WalletTransaction->amount=$request->wallet_amount;
       $WalletTransaction->transaction_date=date('Y-m-d H:i:s');
       $WalletTransaction->save();
       return back()->with("success",'withdrawl request sent');
       }else{
        return back()->with("success",'please enter right amount');
       }

       
        
    }

    public function TransactionList(){
        // dd(Auth::user()->id);
        $data['transaction_total']=WalletTransactions::where('user_id',Auth::user()->id)->sum('amount');
        $data['transactions']=WalletTransactions::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('vandor.wallet.transactions')->with($data);
    }
    
    public function TransactionListAdmin($id){
        // dd(Auth::user()->id);
        $data['transaction_total']=WalletTransactions::where('user_id',$id)->sum('amount');
        $data['transactions']=WalletTransactions::where('user_id',$id)->orderBy('id','desc')->get();
        return view('admin.all_users.vandors.transactions')->with($data);
    }
}
