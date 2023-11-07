<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\StateMast;
use App\Models\CityMast;
use App\Models\CountryMast;
use App\Models\ProfileDetails;
use App\Models\SpclMast;
use App\Models\UserSpcl;
use App\Models\UserCourts;
use App\Models\courtTypeMast;
use App\Models\CourtMast;
use App\Models\CategoryQualMast;
use App\Models\QualificationMast;
use App\Models\UserQualMast;
use File;
class ProfileController extends Controller
{
    public function viewProfile(){
        $user = Auth::user();
        if(isset($user) && $user->id !=''){
            $userId =$user->id;
            $profilePic = ProfileDetails::where('user_id',$userId)->get()->first();
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $qualification = UserQualMast::where('user_id', $userId)->get()->first();
            $userCourtData = UserCourts::where('user_id', $userId)->get();
            $specializationData = UserSpcl::where('user_id',$userId)->get();
            return view('auth.profile.profile', compact('profilePic', 'userProfile', 'qualification', 'user', 'userCourtData', 'specializationData'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }


    public function editProfilePic(Request $request, $id){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userProfile = ProfileDetails::where('user_id',$id)->get()->first();
            $profilePic = ProfileDetails::where('user_id',$id)->get()->first();
            return view('auth.profile.profile-image-edit', compact('profilePic', 'userProfile'));
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
            return redirect('/user/profile/')->with('success','Profile updated successfully');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function userBasicInfo(){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $id = $data->id;
            $userProfile = ProfileDetails::where('user_id',$id)->get()->first();
            $countries = CountryMast::get(["country_name","country_code"]);
            return view('auth.profile.add-basic-info', compact('userProfile','countries'));
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
            $countryName = CountryMast::where('country_code', $request->country_name)->get()->first();
            $stateName = StateMast::where('state_code', $request->state_name)->get()->first();
            $cityName = CityMast::where('city_code', $request->city_name)->get()->first();
            $basicInfoAdd = ProfileDetails::where('user_id',$userId)->get()->first(); 
            if(!empty($basicInfoAdd) && $basicInfoAdd->user_id !=''){
                return redirect('/user/profile/')->with('success','Basic information allready added');
                
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
                return redirect('/user/profile/')->with('success','Basic information added successfully');
            }
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
    

    

    public function editBasicinfo(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $id = $request->id;
            $userProfile = ProfileDetails::where('user_id',$id)->get()->first();
            $basicInfoData = ProfileDetails::where('user_id',$id)->get()->first();
            $countries = CountryMast::get(["country_name","country_code"]);
            if(!empty($basicInfoData) && $basicInfoData->user_id !=''){
                return view('auth.profile.basic-info-edit', ['countries'=>$countries, 'basicInfoData'=>$basicInfoData, 'userProfile'=>$userProfile]);
            }else{
                return redirect('/user/profile/')->with('success','Please add the basic information first');
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
            return redirect('/user/profile/')->with('success','Basic information updated succesfully');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
    

    public function specialization(){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $id = $data->id;
            $userProfile = ProfileDetails::where('user_id',$id)->get()->first();
            $spclMast = SpclMast::all();
            return view('auth.profile.specialization', compact('spclMast','userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function specializationAdd(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $this->validate($request, [
                'spcl_code'   => 'required',
            ]);

            $speci = $request->spcl_code;
            $countData = count($speci);
            $user_id = $data->id; 
            $spclDesc = SpclMast::whereIn('spcl_code',$speci)->pluck('spcl_desc');
            $spclShort = SpclMast::whereIn('spcl_code',$speci)->pluck('short_desc');
            $i = 0;
            while($i < $countData){   
                $newdata = new UserSpcl;     
                $newdata->user_id = $user_id;
                $newdata->spcl_code = $speci[$i];
                $newdata->spcl_desc = $spclDesc[$i];
                $newdata->short_desc = $spclShort[$i];
                $newdata->save();
                $i++;
            } 
            return redirect('/user/profile/')->with('success','Specilazation added successfully');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function editSpecialization($id){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userProfile = ProfileDetails::where('user_id',$id)->get()->first();
            $editSpecialData = UserSpcl::where('user_id', $id)->get();
            $spclMast = SpclMast::get();
            if(!empty($editSpecialData) && $editSpecialData !=''){
                return view('auth.profile.specilization-edit', compact('spclMast', 'editSpecialData', 'userProfile'));
            }else{
                return redirect('/user/profile/')->with('success','Please add the specialization first');
            }
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
    public function specializationUpdate(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $speci = $request->spclEdit;
            if ($speci !== null) {
                $user_id = $data->id;
                $spclData = SpclMast::whereIn('spcl_code', $speci)->get();

                if ($spclData->count() > 0) {
                    $userSpecializations = [];

                    foreach ($spclData as $specialization) {
                        $userSpecializations[] = [
                            'user_id' => $user_id,
                            'spcl_code' => $specialization->spcl_code,
                            'spcl_desc' => $specialization->spcl_desc,
                            'short_desc' => $specialization->short_desc,
                        ];
                    }

                    // Delete the existing user specializations (if any)
                    UserSpcl::where('user_id', $user_id)->delete();

                    // Insert the updated user specializations
                    UserSpcl::insert($userSpecializations);

                    return redirect('/user/profile')->with('success', 'Specializations updated successfully');
                } else {
                    return back()->with('error', 'No valid specializations selected');
                }
            } else {
                return back()->with('error', 'Please select at least one specialization');
            }
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
       
    }
    
    public function qualification(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $id = $data->id;
            $userProfile = ProfileDetails::where('user_id',$id)->get()->first();
            $catgQualMast = CategoryQualMast::all();
            return view('auth.profile.edgucation', compact('catgQualMast', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
    public function getEducation(Request $request){
        $data['educaMast'] = QualificationMast::where("qual_catg_code", $request->qual_catg_code)
        ->get(["qual_desc","qual_code"]);
        return response()->json($data);
    }
    
    public function qualificationAdd(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $this->validate($request, [
                'qual_catg_code'   => 'required',
                'qual_desc'   => 'required',
                'pass_year'        => 'required|min:4|max:4',
                'pass_perc'        => 'required',
                'pass_division'    => 'required|min:1|max:1'
            ]);
            $qualCode = $request->qual_desc;
            $qualDescMast = QualificationMast::where('qual_code',$qualCode)->get()->first();
            $user_id = $data->id; 
            $useData = UserQualMast::where('user_id',$user_id)->get()->first();
        
            if(!empty($useData) && $useData->user_id !=''){
                return redirect('/user/profile/')->with('success','You are allready add the education');
            }else{
                $UserQualMa = new UserQualMast;
                $UserQualMa->user_id = $user_id;
                $UserQualMa->qual_code = $qualDescMast->qual_code;
                $UserQualMa->qual_catg_code = $qualDescMast->qual_catg_code;
                $UserQualMa->qual_catg_desc = $qualDescMast->qual_catg_desc;
                $UserQualMa->qual_desc = $qualDescMast->qual_desc;
                $UserQualMa->pass_year = $request->pass_year;
                $UserQualMa->pass_perc = $request->pass_perc;
                $UserQualMa->pass_division = $request->pass_division;
                $UserQualMa->save();
                return redirect('/user/profile/')->with('success','Education added successfully');
            }
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
       

    }

    public function editQualification(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $id = $request->id;
            $userProfile = ProfileDetails::where('user_id',$id)->get()->first();
            $catgQualMast = CategoryQualMast::all();
            $qualEdit = UserQualMast::where('user_id',$id)->get()->first();
            if(!empty($qualEdit) && $qualEdit->user_id !=''){
                return view('auth.profile.education-edit', compact('qualEdit', 'catgQualMast', 'userProfile'));
            }else{
                return redirect('/user/profile/')->with('success','Please add the education first');
            }
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function updateQualification(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $qualCode = $request->qual_desc;
            $UserQualMast = QualificationMast::where('qual_code',$qualCode)->get()->first();
            $user_id = $data->id; 
            $UserQualMa =  UserQualMast::where('user_id', $user_id)->update([
                'qual_code' => $qualCode,
                'qual_catg_code' => $request->qualCode,
                'qual_catg_desc' => $UserQualMast->qual_catg_desc,
                'qual_desc' => $UserQualMast->qual_desc,
                'pass_year' => $request->pass_year,
                'pass_perc' => $request->pass_perc,
                'pass_division' => $request->pass_division,
            ]);
            return redirect('/user/profile/')->with('success','Education updated successfully');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function prectecingCourt(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $id = $data->id;
            $userProfile = ProfileDetails::where('user_id',$id)->get()->first();
            $getCourt = courtTypeMast::all();
            return view('auth.profile.practicecourt', compact('getCourt', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function getCourt(Request $request){
        $data['courtMast'] = CourtMast::where("court_type_code", $request->court_type_code)
        ->get()->first();
        return response()->json($data);
    }

    public function prectecingCourtAdd(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $this->validate($request, [
                'court_type_code'   => 'required',
                'court_code'   => 'required'
            ]);
            $user_id =$data->id; 
            $useData = UserCourts::where('user_id',$user_id)->get()->first();
            if(!empty($useData) && count($useData) > 0){
                return redirect('/user/profile/')->with('success','You are allready add the practecing court');
            }else{
                $courtCode = $request->court_code;
                $courtCount = count($courtCode);
                $courtTypeCode = $request->court_type_code;
                $courtTypeName = CourtMast::whereIn('court_code',$courtCode)->pluck('court_type_name');
                $courtDataMast = CourtMast::whereIn('court_code',$courtCode)->pluck('court_name');
                $i =0;
                while ($i < $courtCount) {
                    $data = new UserCourts;     
                    $data->user_id = $user_id;
                    $data->court_type_code = $courtTypeCode;
                    $data->court_type_name = $courtTypeName[$i];
                    $data->court_code = $courtCode[$i];
                    $data->court_name = $courtDataMast[$i];
                    $data->save();
                    $i++;
                }     
                return redirect('/user/profile/')->with('success','Practecing court added successfully');
            }
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function editPrectecingCourt(Request $request, $id){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userProfile = ProfileDetails::where('user_id',$id)->get()->first();
            $editCourtData = UserCourts::where(['user_id'=> $id])->get();
            $courtEdit = UserCourts::where(['user_id'=> $id])->get()->first();
            $getCourt = courtTypeMast::all();
            $getCourtMast = CourtMast::all();
            if(!empty($editCourtData) && $editCourtData !=''){
                return view('auth.profile.practecing-court-edit', compact('courtEdit', 'getCourt', 'userProfile', 'getCourtMast', 'editCourtData'));
            }else{
                return redirect('/user/profile/')->with('success','Please add the practecing court');
            }
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function editGetCourt(Request $request){
        
        $data['courtMastEdit'] = CourtMast::where("court_type_code", $request->court_code)
       ->get();
       return response()->json($data);
   }

    public function updatePrectecingCourt(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $courtCode = $request->court_code;
            if ($courtCode !== null) {
                $user_id = $data->id;
                $courtDataMast = CourtMast::whereIn('court_code',$courtCode)->get();

                if ($courtDataMast->count() > 0) {
                    $courtDataName = [];

                    foreach ($courtDataMast as $courtData) {
                        $courtDataName[] = [
                            'user_id' => $user_id,
                            'court_code' => $courtData->court_code,
                            'court_type_code' => $courtData->court_type_code,
                            'court_type_name' => $courtData->court_type_name,
                            'court_name' => $courtData->court_name,
                        ];
                    }

                    // Delete the existing user specializations (if any)
                    UserCourts::where('user_id', $user_id)->delete();

                    // Insert the updated user specializations
                    UserCourts::insert($courtDataName);

                    return redirect('/user/profile')->with('success', 'Specializations updated successfully');
                } else {
                    return back()->with('error', 'No valid specializations selected');
                }
            } else {
                return back()->with('error', 'Please select at least one specialization');
            }
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
       
    }
}
