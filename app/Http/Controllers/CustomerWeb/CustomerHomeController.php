<?php

namespace App\Http\Controllers\CustomerWeb;

use App\Http\Controllers\Controller;
use App\Models\Category_Crud;
use App\Models\LastSearch;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Models\Category;

class CustomerHomeController extends Controller
{
    public static function HomePage($userId, $request)
    {
        // dd($userId,$request->all());
        if(@$request->searchme){
            $arr = [$request->searchme];
            $search_res = CustomerHomeController::searchData($arr);
            $data = (object)['category'=>$search_res->category, 'services'=>$search_res->services,];
            if(!empty($search_res->category) || !empty($search_res->services)){
                if($userId){
                $lastSearch = LastSearch::where('customer_id',$userId)->first();
                if($lastSearch == null){
                    $lastSearcharr = $arr;
                }else{
                    $lastSearcharr = json_decode($lastSearch->last_search);
                    if(count($lastSearcharr) > 4){
                        array_pop($lastSearcharr);
                    }
                    array_push($lastSearcharr,$request->searchme);
                    // dd($lastSearcharr);
                }
                // LastSearch::where('customer_id',$userId)->update(['last_search'=> $lastSearch]);
                LastSearch::updateOrCreate(
                    ['customer_id' => $userId],
                    ['last_search'=> json_encode($lastSearcharr)]
                );
            }
            }
            // dd($data);
            return $data;
        }

        $category = Category_Crud::where('category_status','A')->skip(0)->take(8)->get();   
        $services = Services::where('status','A')->skip(0)->take(8)->get();
        $lastSearch = LastSearch::where('customer_id',$userId)->first();
        // if($lastSearch == null){
        //     $lastSearch=(object)[];
        //     $lastSearch->last_search = ["marriage","Mandap","birthday","Catering"];
        // }
        if($lastSearch !== null){
            $featured =[]; /*CustomerHomeController::searchData(json_decode($lastSearch->last_search));*/
        }
        $data = (object)['category'=>$category, 'services'=>$services, 'featured'=>@$featured];
        // dd($data);
        return $data;
        // return redirect()->route("cust.dashboard")->with(['products'=>$products, 'services'=>$services, 'featured'=>$featured]);
    }





    public static function searchData($search)
    {
        $data = (object)[];
        $data->category =[];
        $data->services =[];
        $search = array_unique($search);
        foreach($search as $row){

            $category = Category_Crud::where('category_name', 'like', '%' .$row. '%')->where('category_status','A')->skip(0)->take(8)
            ->orWhere('category_description', 'like', '%' .$row. '%')->where('category_status','A')->skip(0)->take(8)->get();

            if(!empty($category)){
                foreach($category as $item){
                    array_push($data->category,$item);
                }
            }

            $services = Services::where('service', 'like', '%' .$row. '%')->where('status','A')->skip(0)->take(8)
            ->orWhere('description', 'like', '%' .$row. '%')->where('status','A')->skip(0)->take(8)->get();
            if(!empty($services)){
                foreach($services as $item){
                    array_push($data->services,$item);
                }
            }
        }
        return $data;
    }

    public static function detailPage(Request $request)
    {
        return view("Customer.Dashboard.details");
    }

    public static function servicePage(Request $request)
    {
        $data['services'] = Services::join('service__cruds','service__cruds.service_id','=','services.id')
                            ->where('service__cruds.category_id',$request->cat_id)->get();
        $data['category'] = Category_Crud::all();
        $data['userDetails']=User::where('id',Auth()->user()->id)->first();
        return view('Customer.Dashboard.service')->with($data);
    }

    
}
