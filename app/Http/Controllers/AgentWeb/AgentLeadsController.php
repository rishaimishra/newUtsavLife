<?php

namespace App\Http\Controllers\AgentWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Mail;
use App\Models\Lead_management;
use App\Models\Category_Crud;
use App\Models\Service_Crud;
use App\Models\Services;



class AgentLeadsController extends Controller
{
    





/** 
*   Description : Agent lead list
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function list(){
        $data['list']=Lead_management::where('agent_id',Auth()->user()->id)->get();
        return view('Agent.lead.lead_list')->with($data);
    }







/** 
*   Description : Agent lead add view
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function add(){
        $data['category']=Category_Crud::where('category_status',1)->get();
        return view('Agent.lead.lead_add')->with($data);
    }








/** 
*   Description : Agent lead get service from category ajax
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function get_service(Request $request){
        $find=Service_Crud::where('category_id',$request->category_id)->pluck('service_id')->toArray();
         // return response()->json(['msg'=>$find]);
        $data['allService']=Services::whereIn('id',$find)->get();
        return view('Agent.lead.get_service')->with($data);
    }









/** 
*   Description : Agent lead insert
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function ins(Request $request){
        // dd($request->all());

          $request->validate([
            'category_id' => 'required',
            'service_id' => 'required',
            'lead_name' => 'required',
            'lead_address' => 'required',
            'lead_city' => 'required',
            'lead_pin' => 'required',
            'lead_email' => 'required',
            'lead_phone' => 'required',
        ]);

          $insLead=new Lead_management;
          $insLead->category_id=$request->category_id;
          $insLead->services=$request->service_id;
          $insLead->lead_name=$request->lead_name;
          $insLead->lead_address=$request->lead_address;
          $insLead->lead_city=$request->lead_city;
          $insLead->lead_pin=$request->lead_pin;
          $insLead->lead_email=$request->lead_email;
          $insLead->lead_phone=$request->lead_phone;
          $insLead->agent_id=Auth()->user()->id;
          $insLead->save();

          return back()->with('success','Leads added');
    }









/** 
*   Description : Agent lead edit page
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function edit($id){
        // dd($id);
        $srch=Lead_management::where('agent_id',Auth()->user()->id)->where('id',$id)->first();
        if(!$srch){
            return redirect()->back()->with('error','Id not matching');
        }
        $data['data']=Lead_management::where('id',$id)->first();
        $find=Service_Crud::where('category_id',$data['data']->category_id)->pluck('service_id')->toArray();
        $data['allService']=Services::whereIn('id',$find)->get();
        $data['category']=Category_Crud::where('category_status',1)->get();
       return view('Agent.lead.lead_edit')->with($data);
    }








/** 
*   Description : Agent lead update
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function update(Request $request){
        // dd($request->all());
        $request->validate([
            'category_id' => 'required',
            'service_id' => 'required',
            'lead_name' => 'required',
            'lead_address' => 'required',
            'lead_city' => 'required',
            'lead_pin' => 'required',
            'lead_email' => 'required',
            'lead_phone' => 'required',
        ]);

          $upd=[];

          //srch
          $srch=Lead_management::where('id',$request->id)->where('agent_id',Auth()->user()->id)->first();
          // dd($srch);
          if(!$srch){
            return back()->with('error','id not matching');
          }

          $upd['category_id']=$request->category_id;
          $upd['services']=$request->service_id;
          $upd['lead_name']=$request->lead_name;
          $upd['lead_address']=$request->lead_address;
          $upd['lead_city']=$request->lead_city;
          $upd['lead_pin']=$request->lead_pin;
          $upd['lead_email']=$request->lead_email;
          $upd['lead_phone']=$request->lead_phone;

          $update=Lead_management::where('id',$request->id)->where('agent_id',Auth()->user()->id)->update($upd);
          return back()->with('success','Leads updated');
    }









}
