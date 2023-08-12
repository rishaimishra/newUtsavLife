<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use App\Mail\VandorActiveMail;
use App\Mail\AgentVerifyMail;
use App\Models\VandorRejectOrder;
use App\Models\Order;
use App\Models\Vendor_services;
use App\Models\VendorBankDetailsModel;
use App\Models\VandorDetailsModel;

class AllUserListController extends Controller
{

    //1-admin, 2= user, 3=vandor, 4=agent
    


//--------------VANDOR-------------------//


    public function vandor_list(){
        $data['vandors']=User::where('role_id',3)->orderBy('id','desc')->get();
        return view('admin.all_users.vandors.vandor_list')->with($data);
    }



    public function vandor_active($id){
       $obj=User::where('id','=',$id)->update(['status'=>'A','reg_complete'=>"Y"]);
       $srch=User::where('id',$id)->first();
            $data = [
                  'email'=>$srch->email,
                  'name'=>$srch->name,
                  'id'=>$srch->id,
              ];
       //activation mail
       Mail::send(new VandorActiveMail($data));
        return back()->with("success",'vandor successfully activated');
    }



    public function vandor_deactive($id){
     $obj=User::where('id','=',$id)->update(['status'=>'I']);
        return back()->with("success",'vandor successfully activated');
    }




     public function vandor_delete($id){
     $obj=User::where('id','=',$id)->update(['status'=>'D']);
        return back()->with("success",'vandor successfully activated');
    }


    public function vandor_view($id){
        $data['vandor']=User::where('id','=',$id)->first();
        $data['list']=Vendor_services::where('vendor_user_id',$id)->where('status','!=','D')->get();
        return view('admin.all_users.vandors.vandor_view')->with($data);
    }



    public function vandor_orders($id){
        $RejectedOrderIds=VandorRejectOrder::where('vandor_id',$id)->pluck('order_id')->toArray();
        $data['rejected']=Order::whereIn('id',$RejectedOrderIds)->where('payment_status','S')->with('serviceDetails','categoryDetails','CustomerDetails')->get();
        $data['accepted']=Order::where('vendor_user_id',$id)->where('payment_status','S')->where('vandor_order_status','AP')->with('serviceDetails','categoryDetails','CustomerDetails')->get();
        $data['vandorDetails']=User::where('id',$id)->first();
        // dd($data);
        return view('admin.all_users.vandors.orders_list')->with($data);

    }




public function bank_edit_page($id){
    $find=VendorBankDetailsModel::where('vandor_id',$id)->first();
    if(!@$find){
        return back()->with('error','id not found');
    }
    $data['data']=$find;
    return view('admin.all_users.vandors.bank_edit')->with($data);
}




public function bank_update(Request $request){
    $request->validate([
            'bank_name' => 'required',
            'acc_no' => 'required',
            'ifsc_no' => 'required',
            'holder_name' => 'required',
            'branch_name' => 'required',
            'acc_type' => 'required',
        ]);
     //update Bank details
    $srchBank=VendorBankDetailsModel::where('vandor_id',$request->vandor_id)->first();
        if($srchBank){
            //update
            $upd2=[];
            $upd2['bank_name']=$request->bank_name;
            $upd2['acc_no']=$request->acc_no;
            $upd2['ifsc_no']=$request->ifsc_no;
            $upd2['holder_name']=$request->holder_name;
            $upd2['branch_name']=$request->branch_name;
            $upd2['acc_type']=$request->acc_type;
            
              if($request->img1){
              $image = $request->img1;
              $fileSizeMb=filesize($image)/1024*0.0009765625;
              if($fileSizeMb>2){
                return back()->with('error','Image is more than 2 Mb');
              }
              // dd(filesize($image)/1024*0.0009765625);
              $filename = time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
              $image->move("storage/app/public/vandor/checkbookOrPassbookImage",$filename);

              $upd2['checkbookOrPassbookImage']=$filename;
            }

            $updateBank=VendorBankDetailsModel::where('vandor_id',$request->vandor_id)->update($upd2);
            return back()->with('success','Bank updated.');
        }
         return back()->with('error','id mismatch.');
}








// 1 - vendor details edit
public function edit_one_get($id){
    $find=User::where('id',$id)->where('role_id',3)->first();
    if(!@$find){
        return back()->with('error','id not found');
    }
    $data['data']=$find;
    return view('admin.all_users.vandors.vandor_details_edit')->with($data);
}




public function edit_one_post(Request $request){
    // dd($request->all());
    $request->validate([
          "pan_card" => "required",
          "kyc_type" => "required",
          "kyc_no" =>"required",
        ]);
     //update Bank details
    $srchBank=VandorDetailsModel::where('vandor_id',$request->vandor_id)->first();
        if($srchBank){
            //update
            $upd2=[];
            $upd2['pan_card']=$request->pan_card;
            $upd2['kyc_type']=$request->kyc_type;
            $upd2['kyc_no']=$request->kyc_no;
            $upd2['calling_no']=$request->calling_no;
            $upd2['gst_no']=$request->gst_no;
            $updateBank=VandorDetailsModel::where('vandor_id',$request->vandor_id)->update($upd2);
            return back()->with('success','Vendor Details updated.');
        }
         return back()->with('error','id mismatch.');
}












// 2-address edit
public function edit_two_get($id){
    $find=User::where('id',$id)->where('role_id',3)->first();
    if(!@$find){
        return back()->with('error','id not found');
    }
    $data['data']=$find;
    return view('admin.all_users.vandors.vandor_address_edit')->with($data);
}




public function edit_two_post(Request $request){
    // dd($request->all());
    $request->validate([
              "pin_code" =>"required",             
              "house_no" => "required",
              "area" => "required",
              "landmark" => "required",
              "city" => "required",
              "state" => "required",
        ]);
     //update Bank details
    $srchBank=VandorDetailsModel::where('vandor_id',$request->vandor_id)->first();
        if($srchBank){
            //update
            $upd2=[];
            $upd2['pin_code']=$request->pin_code;
            $upd2['house_no']=$request->house_no;
            $upd2['area']=$request->area;
            $upd2['landmark']=$request->landmark;
            $upd2['city']=$request->city;
            $upd2['state']=$request->state;
            $updateBank=VandorDetailsModel::where('vandor_id',$request->vandor_id)->update($upd2);
            return back()->with('success','Vendor Address updated.');
        }
         return back()->with('error','id mismatch.');
}













//3 - office address
public function edit_three_get($id){
    $find=User::where('id',$id)->where('role_id',3)->first();
    if(!@$find){
        return back()->with('error','id not found');
    }
    $data['data']=$find;
    return view('admin.all_users.vandors.office_address_edit')->with($data);
}




public function edit_three_post(Request $request){
    // dd($request->all());
    $request->validate([
              "office_pincode" => "required",
              "office_house_no" => "required",
              "office_area" => "required",
              "office_landmark" => "required",
              "office_city" => "required",
              "office_state" => "required",
              "office_mobile" => "required",
        ]);
     //update Bank details
    $srchBank=VandorDetailsModel::where('vandor_id',$request->vandor_id)->first();
        if($srchBank){
            //update
            $upd2=[];
            $upd2['office_pincode']=$request->office_pincode;
            $upd2['office_house_no']=$request->office_house_no;
            $upd2['office_area']=$request->office_area;
            $upd2['office_landmark']=$request->office_landmark;
            $upd2['office_city']=$request->office_city;
            $upd2['office_state']=$request->office_state;
             $upd2['office_mobile']=$request->office_mobile;
            $updateBank=VandorDetailsModel::where('vandor_id',$request->vandor_id)->update($upd2);
            return back()->with('success','Office Address updated.');
        }
         return back()->with('error','id mismatch.');
}



































//--------CUSTOMERS-----------//

    public function customer_list(){
        $data['customers']=User::where('role_id',2)->orderBy('id','desc')->get();
        return view('admin.all_users.customers.customer_list')->with($data);
    }



    public function customer_active($id){
       $obj=User::where('id','=',$id)->update(['status'=>'A']);
        return back()->with("success",'customer successfully activated');
    }



    public function customer_deactive($id){
     $obj=User::where('id','=',$id)->update(['status'=>'I']);
     return back()->with("success",'customer successfully activated');
    }




     public function customer_delete($id){
     $obj=User::where('id','=',$id)->update(['status'=>'D']);
        return back()->with("success",'customer successfully activated');
    }


    public function customer_view($id){
        $data['customer']=User::where('id','=',$id)->first();
        return view('admin.all_users.customers.customer_view')->with($data);
    }










    //----------AGENT PANEL-----------//


    public function agent_list(){
        $data['agents']=User::where('role_id',4)->orderBy('id','desc')->get();
        return view('admin.all_users.agent.agent_list')->with($data);
    }



    public function agent_active($id){
       $obj=User::where('id','=',$id)->update(['status'=>'A']);
       $srch=User::where('id',$id)->first();
            $data = [
                  'email'=>$srch->email,
                  'name'=>$srch->name,
                  'id'=>$srch->id,
              ];
       //activation mail
       Mail::send(new AgentVerifyMail($data));
        return back()->with("success",'Agent successfully activated');
    }



    public function agent_deactive($id){
     $obj=User::where('id','=',$id)->update(['status'=>'I']);
     return back()->with("success",'Agent successfully activated');
    }




     public function agent_delete($id){
     $obj=User::where('id','=',$id)->update(['status'=>'D']);
        return back()->with("success",'Agent successfully activated');
    }


    public function agent_view($id){
        $data['agent']=User::where('id','=',$id)->first();
        return view('admin.all_users.agent.agent_view')->with($data);
    }


}
