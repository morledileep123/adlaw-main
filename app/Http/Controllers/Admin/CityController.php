<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileDetails;
use App\Models\CityTypeMast;
use App\Models\CityMast;
use App\Models\CountryMast;
use App\Models\StateMast;
class CityController extends Controller
{
    public function index(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $allcitys = CityMast::all();
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            return view('admin.city.index', compact('allcitys', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
         }
    }

    public function create(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $getCountry = CountryMast::all();
            $cityType = CityTypeMast::all();
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            return view('admin.city.create', compact('cityType', 'getCountry', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
         }
    }

   public function getState(Request $request){
       $data['stateMast'] = StateMast::where("country_code", $request->country_code)
       ->get(["state_name","state_code"]);
       return response()->json($data);
   }
    public function store(Request $request){
        // return $request;
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $request->validate([
            'city_name' => 'required'
            ]);
            $cityCodeType = CityMast::orderBy('city_code', 'DESC')->get()->first();
            $cityCode = $cityCodeType->city_code + 1;
            $stateData = StateMast::where("state_code", $request->state_code)->get()->first();
            $cityCreate = new CityMast();
            $cityCreate->city_code = $cityCode;
            $cityCreate->city_name = $request->city_name;
            $cityCreate->city_type = $request->city_type;
            $cityCreate->state_code = $request->state_code;
            $cityCreate->state_name = $stateData->state_name;
            $cityCreate->country_code = $request->country_code;
            $cityCreate->country_name = $stateData->country_name;
            $cityCreate->save();
            return redirect()->route('admin.cities')->with('success', 'City added successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
         }
    }

    public function edit(Request $request, $city_code){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $getCountry = CountryMast::all();
            $cityType = CityTypeMast::all();
            $cityEdit = CityMast::where('city_code',$city_code)->first();
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            return view('admin.city.edit', compact('cityEdit', 'getCountry', 'cityType', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function update(Request $request, $city_code){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $getCityData = CityMast::where('city_code', $request->city_code)->get()->first();   
            CityMast::where('city_code',$city_code)->update([
                'city_name' => $request->city_name,
                'city_type' => $request->city_type,
                'state_code' => $request->state_code,
                'state_name' => $getCityData->state_name,
                'country_code' => $request->country_code,
                'country_name' => $getCityData->country_name
            ]);
        
            return redirect()->route('admin.cities')->with('success', 'City updated successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function delete(Request $request, $city_code){
        $deleteState = CityMast::where('city_code',$city_code)->delete();
        return redirect()->back()->with('success', 'City deleted successfully!');
    }
    
}
