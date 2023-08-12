<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function agent_list(Request $r){
        $data=['type' => 'Upcoming Order'];
        return redirect('admin/users?type=agent');
    }

    function customer_list(Request $r){
        $data=['type' => 'Canceled Order'];
        return redirect('admin/users?type=customer');
    }

    function vendor_list(Request $r){
        $data=['type' => 'Completed Order'];
        return redirect('admin/users?type=vendor');
    }
}
