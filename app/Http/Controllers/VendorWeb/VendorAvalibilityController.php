<?php

namespace App\Http\Controllers\VendorWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Vendor_services;
use App\Models\Services;
use App\Models\VandorAvailibility;
use Mail;

class VendorAvalibilityController extends Controller
{
    


/** 
*   Description : vandor available page
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function availibility_page(){
        $srch=VandorAvailibility::where('vandor_id',Auth()->user()->id)->first();
        if($srch){
            //edit page
            $data['data']=$srch;
            return view('vandor.available.available_edit')->with($data);
        }else{
            //add page
            return view('vandor.available.available_add');
        }
    }







/** 
*   Description : vandor available insert
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function availibility_insert(Request $request){
        // dd($request->all());

        $insData=new VandorAvailibility;

        $insData->mon=$request->mon;
        $insData->mon_day=$request->mon_day;
        $insData->mon_night=$request->mon_night;

        $insData->tues=$request->tues;
        $insData->tues_day=$request->tues_day;
        $insData->tues_night=$request->tues_night;

        $insData->wed=$request->wed;
        $insData->wed_day=$request->wed_day;
        $insData->wed_night=$request->wed_night;

        $insData->thurs=$request->thurs;
        $insData->thurs_day=$request->thurs_day;
        $insData->thurs_night=$request->thurs_night;

        $insData->fri=$request->fri;
        $insData->fri_day=$request->fri_day;
        $insData->fri_night=$request->fri_night;

        $insData->sat=$request->sat;
        $insData->sat_day=$request->sat_day;
        $insData->sat_night=$request->sat_night;

        $insData->sun=$request->sun;
        $insData->sun_day=$request->sun_day;
        $insData->sun_night=$request->sun_night;

        $insData->vandor_id=Auth()->user()->id;
        $insData->save();

        return back()->with('success','Added');

    }






/** 
*   Description : vandor available update
*   Author      : JEET
*   Date        : 2022-02-06
**/ 
    public function availibility_update(Request $request){
        // dd($request->all());
        $upd=[];

       $upd['mon']=$request->mon;
       $upd['mon_day']=$request->mon_day;
       $upd['mon_night']=$request->mon_night;

       $upd['tues']=$request->tues;
       $upd['tues_day']=$request->tues_day;
       $upd['tues_night']=$request->tues_night;

       $upd['wed']=$request->wed;
       $upd['wed_day']=$request->wed_day;
       $upd['wed_night']=$request->wed_night;

       $upd['thurs']=$request->thurs;
       $upd['thurs_day']=$request->thurs_day;
       $upd['thurs_night']=$request->thurs_night;

       $upd['fri']=$request->fri;
       $upd['fri_day']=$request->fri_day;
       $upd['fri_night']=$request->fri_night;

       $upd['sat']=$request->sat;
       $upd['sat_day']=$request->sat_day;
       $upd['sat_night']=$request->sat_night;

       $upd['sun']=$request->sun;
       $upd['sun_day']=$request->sun_day;
       $upd['sun_night']=$request->sun_night;

       $update=VandorAvailibility::where('vandor_id',Auth()->user()->id)->update($upd);
        return back()->with('success','Updated');
    }










}
