<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead_management;
use App\Models\Category_Crud;
use App\Models\Service_Crud;
use App\Models\Services;

class AllLeadController extends Controller
{
    

     public function lead_list(){
        $data['list']=Lead_management::orderBy('id','desc')->get();
        return view('admin.lead.lead_list')->with($data);
    }
}
