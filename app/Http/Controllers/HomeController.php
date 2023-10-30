<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserTypeMast;
use App\Models\StateMast;
use App\Models\CountryMast;
use App\Models\PackageMast;
use App\Models\ProfileDetails;
use App\Models\CityMast;
use App\Models\UserStatusMast;
class HomeController extends Controller
{
    public function dashboard()
    {
         $userId = Auth::user()->id;
         $profilePic = ProfileDetails::where('user_id', $userId)->get();
         $userProfile = ProfileDetails::where('user_id', $userId)->get();
         $users = User::all();
         $allUsers = count($users);
         $userTypeMast = UserTypeMast::all();
         $AllUserTypeMast = count($userTypeMast);
         $stateMast = StateMast::all();
         $allStateMast = count($stateMast);
         $userStatusMast = UserStatusMast::all();
         $allUserStatusMast = count($userStatusMast);
         $cityMast = CityMast::all();
         $allCityMast = count($cityMast);
         $packageMast = PackageMast::all();
         $allPackageMast = count($packageMast);
         $countryMast = CountryMast::all();
         $allCountryMast = count($countryMast);
         
        return view('dashboard', compact('userProfile', 'profilePic', 'allUsers', 'allStateMast', 'allCityMast', 'allCountryMast'));
    }

    public function viewHome(Request $request)
    {
        
        $states = ProfileDetails::select('state_code', 'state_name')->distinct()->get();
        $allStates = ProfileDetails::select('user_id','city_name', 'state_code', 'state_name')->groupBy('user_id','city_name', 'state_code', 'state_name')->get();
        return view('welcome', compact('states', 'allStates'));
    }

    public function showByState($state_code)
    {
         $states = ProfileDetails::where('state_code', $state_code)->distinct()->get();
         return response()->json($states);     
    }

    public function showByCity($state, $city_name)
    {
         $cityData = ProfileDetails::where(['state_code'=>$state, 'city_name'=> $city_name])->get();
        return view('usedata', compact('cityData'));
    }

    // public function viewCountry(){
    //     $countryMast = countryMast::all();
    //     return view('auth.country.countries', compact('countryMast'));
    // }
    // public function viewState(){
    //     $stateMast = StateMast::all();
    //     return view('auth.state.states', compact('stateMast'));
    // }
    // public function viewCity(){
    //     $cityMast = CityMast::all();
    //     return view('auth.city.cities', compact('cityMast'));
    // }

    
}
