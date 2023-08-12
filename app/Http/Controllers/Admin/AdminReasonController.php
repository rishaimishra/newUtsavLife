<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\AdminReasonModel;

class AdminReasonController extends Controller
{
    
        public function list(){
        $data['reasons']=AdminReasonModel::where('status','!=','D')->orderBy('id','desc')->get();
        return view('admin.reason.reason_list')->with($data);
    }



    public function add_page(){
        return view('admin.reason.reason_add');
    }
    


    public function insert(Request $request){
        // dd($request->all());
            $request->validate([
            'reason' => 'required',
        ]);

            $ins_Reason=new AdminReasonModel;
            $ins_Reason->reason=$request->reason;
            $ins_Reason->save();
    
        return back()->with('success','Reason added successfully');
    }





    public function active($id){
        // dd($id);
        $obj=AdminReasonModel::where('id','=',$id)->update(['status'=>'A']);
        return back()->with("success",'Reason successfully activated');
    }


    public function deactive($id){
        // dd($id);
        $obj=AdminReasonModel::where('id','=',$id)->update(['status'=>'I']);
        return back()->with("success",'Reason successfully deactivated');
    }


      public function delete($id){
        // dd($id);
        $obj=AdminReasonModel::where('id','=',$id)->update(['status'=>'D']);
        return back()->with("success",'Reason successfully deleted');
    }






    public function edit($id){
        
        $data['reason']=AdminReasonModel::where('id',$id)->first();
        return view('admin.reason.reason_edit')->with($data);
    }




    public function update(Request $request){
        //dd($request->all());
           $request->validate([
            'reason' => 'required',
        ]);

            //search that same combination exist or not
            $srchAllReasonNameId=AdminReasonModel::where('reason',$request->reason)->where('id','!=',$request->id)->where('status','!=','D')->first();
     
            if(!$srchAllReasonNameId){


                $ins_Reason=[];
                $ins_Reason['reason']=$request->reason;
                    $u2=AdminReasonModel::where('id',$request->id)->update($ins_Reason);
                     return back()->with("success",'Reason successfully updated');
           }else{
             return back()->with("error",'Same Reason exists');
           }

           
    }
}
