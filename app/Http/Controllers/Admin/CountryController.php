<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileDetails;
use App\Models\CountryMast;
class CountryController extends Controller
{
    public function index(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $countryMast = CountryMast::all();
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            return view('admin.country.index', compact('countryMast', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function create(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            return view('admin.country.create', compact('userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
    public function store(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $request->validate([
                'country_name' => 'required'
            ]);
            $countryCodeType = CountryMast::orderBy('country_code', 'DESC')->get()->first();
            $countryCode = $countryCodeType->country_code + 1;
            $countryData = new CountryMast();
            $countryData->country_code = $countryCode;
            $countryData->country_name = $request->country_name;
            $countryData->iso2 = $request->iso2;
            $countryData->iso3 = $request->iso3;
            $countryData->phone_code = $request->phone_code;
            $countryData->nationality = $request->nationality;
            $countryData->currency_code = $request->currency_code;
            $countryData->currency_name = $request->currency_name;
            $countryData->save();
            return redirect()->route('admin.countries')->with('success', 'Country added successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function edit(Request $request, $country_code){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $countryEdit = CountryMast::where('country_code',$country_code)->first();
            return view('admin.country.edit', compact('countryEdit', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function update(Request $request, $country_code){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            CountryMast::where('country_code',$country_code)->update([
                'country_name' =>$request->country_name,
                'iso2' =>$request->iso2,
                'iso3' =>$request->iso3,
                'phone_code' =>$request->phone_code,
                'nationality' =>$request->nationality,
                'currency_code' =>$request->currency_code,
                'currency_name' =>$request->currency_name
                
            ]);
            return redirect()->route('admin.countries')->with('success', 'Country updated successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function delete(Request $request, $country_code){
        $countryEdit = CountryMast::where('country_code',$country_code)->delete();
        return redirect()->back()->with('success', 'Country deleted successfully!');
    }
}
