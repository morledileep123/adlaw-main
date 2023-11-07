<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StateMast;
use App\Models\CityMast;
use App\Models\CountryMast;
use App\Models\ProfileDetails;
use File;
class AdminProfileController extends Controller
{
    public function viewProfile(){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId =$data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            if(empty($userProfile || empty($userProfile->user_id))){
                return view('admin.profile.profile')->with('success' , 'Profile details not found');
            }else{
                return view('admin.profile.profile', compact('userProfile'));
            }
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function editProfilePic(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $id = $request->id;
            $userProfile = ProfileDetails::where('user_id', $id)->get()->first();
            if(empty($userProfile) && $userProfile->user_id ==null){
                return redirect()->back()->with('success','Admin details not available please add basic information for update image');
            }else{
                return view('admin.profile.profile-image-edit', compact('userProfile'));
            }
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
    public function updateProfilePic(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $request->validate([
                'photo_path' => 'required|image|mimes:png,jpg,jpeg'
            ]);
            $id = $request->id;
            $updateData  = ProfileDetails::where('user_id',$id)->get()->first();
            if($request->hasFile('photo_path') !=''){
                $destination = 'public/profile-image/'.$updateData->photo_path;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                
                $file = $request->file('photo_path');
                $extension = $file->getClientOriginalExtension();
                $filename  = time().'.'.$extension;
                $file->move('public/profile-image/', $filename);
                $updateData->photo_path = $filename;
            }
            ProfileDetails::where('user_id',$id)->update([
                'photo_path' => $filename,
            ]);
            return redirect()->route('admin.profile')->with('success','Profile updated successfully');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function basicInfo(){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $id =$data->id;
            $profilePic = ProfileDetails::where('user_id',$id)->get();
            $countries = CountryMast::get(["country_name","country_code"]);
            return view('admin.profile.add-basic-info', compact('profilePic','countries'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function getState(Request $request)
    {
        $data['states'] = StateMast::where("country_code",$request->country_code)
                    ->get(["state_name","state_code"]);
        return response()->json($data);
    }
    public function getCity(Request $request)
    {
        $data['cities'] = CityMast::where("state_code",$request->state_code)
                    ->get(["city_name","city_code"]);
        return response()->json($data);
    }

    public function basicinfoAdd(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $countryName = CountryMast::where('country_code', $request->country_name)->get();
            $stateName = StateMast::where('state_code', $request->state_name)->get();
            $cityName = CityMast::where('city_code', $request->city_name)->get();
            $basicInfoAdd = ProfileDetails::where('user_id',$userId)->get(); 
            if(!empty($basicInfoAdd)){
                return redirect()->back()->with('success','Basic information allready added');
                
            }else{
                $user = new ProfileDetails;
                $user->user_id = $userId;
                $user->user_type_id = $data->user_type_id;
                $user->firstname = $request->firstname;
                $user->middlename = $request->middlename;
                $user->lastname = $request->lastname;
                $user->dob = $request->dob;
                $user->gender = $request->gender;
                $user->email = $data->email;
                $user->alternate_email = $request->alternate_email;
                $user->mobile = $data->mobile;
                $user->alternate_mobile = $request->alternate_mobile;
                $user->country_code = $request->country_name;
                $user->country_name = $countryName->country_name;
                $user->state_code = $request->state_name;
                $user->state_name = $stateName->state_name;
                $user->city_code = $request->city_name;
                $user->city_name = $cityName->city_name;
                $user->zip_code = $request->zip_code;
                $user->address = $request->address;
                $user->aadhar_numb = $request->aadhar_numb;
                $user->pan_numb = $request->pan_numb;
                $user->bar_regs_numb = $request->bar_regs_numb;
                $user->detl_profile = $request->detl_profile;
                $user->save();
                return redirect()->back()->with('success','Basic information added successfully');
            }
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
    

    

    public function editBasicinfo(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $id = $request->id;
            $userProfile = ProfileDetails::where('user_id', $id)->get()->first();
            $basicInfoData = ProfileDetails::where('user_id',$id)->get()->first();
            $countries = CountryMast::get(["country_name","country_code"]);
            if(!empty($basicInfoData)){
                return view('admin.profile.basic-info-edit', ['countries'=>$countries, 'basicInfoData'=>$basicInfoData, 'userProfile'=>$userProfile]);
            }else{
                return redirect()->back()->with('success','Please add the basic information first');
            }
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
    public function updateBasicinfo(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $id = $request->id;
            $countryName = CountryMast::where('country_code', $request->country_name)->get()->first();
            $stateName = StateMast::where('state_code', $request->state_name)->get()->first();
            $cityName = CityMast::where('city_code', $request->city_name)->get()->first();
            ProfileDetails::where('user_id',$id)->update([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'alternate_email' => $request->alternate_email,
                'mobile' => $request->mobile,
                'alternate_mobile' => $request->alternate_mobile,
                'country_code' => $request->country_name,
                'country_name' => $countryName->country_name,
                'state_code' => $request->state_name,
                'state_name' => $stateName->state_name,
                'city_code' => $request->city_name,
                'city_name' => $cityName->city_name,
                'zip_code' => $request->zip_code,
                'address' => $request->address,
                'aadhar_numb' => $request->aadhar_numb,
                'pan_numb' => $request->pan_numb,
                'bar_regs_numb' => $request->bar_regs_numb,
                'detl_profile' => $request->detl_profile
            ]);

            return redirect()->route('admin.profile')->with('success','Basic information updated succesfully');
        }else{
           return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
}
