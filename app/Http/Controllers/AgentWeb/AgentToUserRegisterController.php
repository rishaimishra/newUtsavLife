<?php

namespace App\Http\Controllers\AgentWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class AgentToUserRegisterController extends Controller
{
    


/** 
*   Description : Agent register user list
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function list(){
        $data['data']=User::where('reg_by_agent_id',Auth()->user()->id)->get();
         return view('Agent.reg_user.list')->with($data);
    }



    public function register_page_for_customer($id,$email){
        // dd($id,$email);
        $data['id']=$id;
        $data['email']=$email;
        return view('Customer.Auth.registration')->with($data);
    }












}
