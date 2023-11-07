<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileDetails;
use App\Models\CountryMast;
use App\Models\StateMast;
class StateController extends Controller
{
    public function index(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $allStates = StateMast::all();
            return view('admin.state.index', compact('allStates', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function create(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId =$data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $getCountry = CountryMast::all();
            return view('admin.state.create', compact('getCountry', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
    public function store(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $request->validate([
                'state_name' => 'required'
            ]);
            $getCountry = CountryMast::where('country_code', $request->country_code)->get()->first();
            $stateCodeType = StateMast::orderBy('state_code', 'DESC')->get()->first();
            $stateCode = $stateCodeType->state_code + 1;
            $stateData = new StateMast();
            $stateData->state_code = $stateCode;
            $stateData->state_name = $request->state_name;
            $stateData->country_code = $request->country_code;
            $stateData->country_name = $getCountry->country_name;
            $stateData->save();
            return redirect()->route('admin.states')->with('success', 'State added successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function edit(Request $request, $state_code){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $getCountry = CountryMast::all();
            $stateEdit = StateMast::where('state_code',$state_code)->first();
            return view('admin.state.edit', compact('stateEdit', 'getCountry', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function update(Request $request, $state_code){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $getCountry = CountryMast::where('country_code', $request->country_code)->get()->first();   
            StateMast::where('state_code',$state_code)->update([
                'state_name' => $request->state_name,
                'country_code' => $request->country_code,
                'country_name'=> $getCountry->country_name,
            ]);
        
             return redirect()->route('admin.states')->with('success', 'State updated successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function delete(Request $request, $state_code){
        $deleteState = StateMast::where('state_code',$state_code)->delete();
        return redirect()->back()->with('success', 'State deleted successfully!');
    }
}
