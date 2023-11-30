<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserTypeMast;
use App\Models\StateMast;
use App\Models\CountryMast;
use App\Models\UserQualMast;
use App\Models\PackageMast;
use App\Models\ProfileDetails;
use App\Models\CityMast;
use App\Models\UserStatusMast;
use App\Models\UserSpcl;
use App\Models\UserCourts;
class HomeController extends Controller
{
    public function dashboard()
    {
         $userId = Auth::user()->id;
         $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
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
         
        return view('dashboard', compact('userProfile', 'allUsers', 'allStateMast', 'allCityMast', 'allCountryMast'));
    }

    public function viewHome(Request $request)
    {
        $details = ProfileDetails::all();
        $states = UserSpcl::select('spcl_code', 'spcl_desc')->distinct()->get();
        $allStates = UserSpcl::select('user_id', 'spcl_code', 'spcl_desc')->groupBy('user_id', 'spcl_code', 'spcl_desc')->distinct()->get();
        return view('welcome', compact('states', 'allStates', 'details'));
    }

    public function showByState($spcl_code)
    {
          $spclCode = UserSpcl::where('spcl_code', $spcl_code)->get();
        //  return  $states = ProfileDetails::where('user_id', $spclCode->user_id)->distinct()->get();
         return response()->json($spclCode,);     
    }

    public function showByCity($spcl, $spcl_desc)
    {
          $spclCode = UserSpcl::where(['spcl_code'=>$spcl, 'spcl_desc'=> $spcl_desc])->pluck('user_id');
          $cityData = ProfileDetails::whereIn('user_id', $spclCode)->get();
          $qualData = UserQualMast::whereIn('user_id', $spclCode)->get();
          return view('usedata', compact('cityData', 'qualData'));
         
    }

    public function detailsOfLawyers($id)
    {
        $userProfile = ProfileDetails::where('user_id', $id)->get()->first();
        $qualification = UserQualMast::where('user_id', $id)->get()->first();
        $userCourtData = UserCourts::where('user_id', $id)->get();
        $specializationData = UserSpcl::where('user_id',$id)->get();
        return view('user-details', compact('userProfile', 'qualification', 'userCourtData', 'specializationData')); 
    }

    public function contactUs(Request $request)
    {
        return view('contact-us'); 
    }
    public function aboutUs(Request $request)
    {
        return view('about-us'); 
    }
}
