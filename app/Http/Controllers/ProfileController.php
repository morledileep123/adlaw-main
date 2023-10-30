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
        $user =Auth::user();
        $userId =Auth::user()->id;
        $userProfile = ProfileDetails::where('user_id', $userId)->get();
        $profilePic = ProfileDetails::where('user_id', $userId)->get();
        $qualification = UserQualMast::where('user_id', $userId)->get();
        $userCourtData = UserCourts::where('user_id', $userId)->get();
        $specializationData = UserSpcl::where('user_id',$userId)->get();
        return view('auth.profile.profile', compact('userProfile', 'profilePic', 'qualification', 'user', 'userCourtData', 'specializationData'));
    }

    public function editProfilePic(Request $request){
        $id = $request->id;
         $profilePic = ProfileDetails::where('user_id',$id)->get();
        return view('auth.profile.profile-image-edit', ['profilePic'=>$profilePic]);
    }
    public function updateProfilePic(Request $request){
        $request->validate([
            'photo_path' => 'required|image|mimes:png,jpg,jpeg'
        ]);
        $id = $request->id;
        $updateData  = ProfileDetails::where('user_id',$id)->get();
        if($request->hasFile('photo_path') !=''){
            $destination = 'public/profile-image/'.$updateData[0]->photo_path;
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
    }

    public function userBasicInfo(){
        $id =Auth::user()->id;
        $profilePic = ProfileDetails::where('user_id',$id)->get();
        $countries = CountryMast::get(["country_name","country_code"]);
        return view('auth.profile.add-basic-info', compact('profilePic','countries'));
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
        $loggedUser =Auth::user();
        $userId = $loggedUser->id;
        $countryName = CountryMast::where('country_code', $request->country_name)->get();
        $stateName = StateMast::where('state_code', $request->state_name)->get();
        $cityName = CityMast::where('city_code', $request->city_name)->get();
        $basicInfoAdd = ProfileDetails::where('user_id',$userId)->get(); 
        if(!empty($basicInfoAdd) && count($basicInfoAdd) > 0){
            return redirect('/user/profile/')->with('success','Basic information allready added');
            
        }else{
            $user = new ProfileDetails;
            $user->user_id = $userId;
            $user->user_type_id = $loggedUser->user_type_id;
            $user->firstname = $request->firstname;
            $user->middlename = $request->middlename;
            $user->lastname = $request->lastname;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->email = $loggedUser->email;
            $user->alternate_email = $request->alternate_email;
            $user->mobile = $loggedUser->mobile;
            $user->alternate_mobile = $request->alternate_mobile;
            $user->country_code = $request->country_name;
            $user->country_name = $countryName[0]->country_name;
            $user->state_code = $request->state_name;
            $user->state_name = $stateName[0]->state_name;
            $user->city_code = $request->city_name;
            $user->city_name = $cityName[0]->city_name;
            $user->zip_code = $request->zip_code;
            $user->address = $request->address;
            $user->aadhar_numb = $request->aadhar_numb;
            $user->pan_numb = $request->pan_numb;
            $user->bar_regs_numb = $request->bar_regs_numb;
            $user->detl_profile = $request->detl_profile;
            $user->save();
            return redirect('/user/profile/')->with('success','Basic information added successfully');
        }
    }
    

    

    public function editBasicinfo(Request $request){
        $id = $request->id;
        // $id =Auth::user()->id;
        $profilePic = ProfileDetails::where('user_id',$id)->get();
        $basicInfoData = ProfileDetails::where('user_id',$id)->get();
        $countries = CountryMast::get(["country_name","country_code"]);
        if(!empty($basicInfoData) && count($basicInfoData) > 0){
            return view('auth.profile.basic-info-edit', ['countries'=>$countries, 'basicInfoData'=>$basicInfoData, 'profilePic'=>$profilePic]);
        }else{
            return redirect('/user/profile/')->with('success','Please add the basic information first');
        }
    }
    public function updateBasicinfo(Request $request){
        $id = $request->id;
        $countryName = CountryMast::where('country_code', $request->country_name)->get();
        $stateName = StateMast::where('state_code', $request->state_name)->get();
        $cityName = CityMast::where('city_code', $request->city_name)->get();
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
            'country_name' => $countryName[0]->country_name,
            'state_code' => $request->state_name,
            'state_name' => $stateName[0]->state_name,
            'city_code' => $request->city_name,
            'city_name' => $cityName[0]->city_name,
            'zip_code' => $request->zip_code,
            'address' => $request->address,
            'aadhar_numb' => $request->aadhar_numb,
            'pan_numb' => $request->pan_numb,
            'bar_regs_numb' => $request->bar_regs_numb,
            'detl_profile' => $request->detl_profile
        ]);
        return redirect('/user/profile/')->with('success','Basic information updated succesfully');
    }
    

    public function specialization(){
       
        $id =Auth::user()->id;
        $profilePic = ProfileDetails::where('user_id',$id)->get();
        $spclMast = SpclMast::get();
        return view('auth.profile.specialization', compact('spclMast','profilePic'));
    }

    public function specializationAdd(Request $request){
        $this->validate($request, [
            'spcl_code'   => 'required',
        ]);

        $speci = $request->spcl_code;
        $countData = count($speci);
        $user_id =Auth::user()->id; 
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
    }

    public function editSpecialization($id){
        // $id =Auth::user()->id;
        $profilePic = ProfileDetails::where('user_id',$id)->get();
        $editSpecialData = UserSpcl::where('user_id', $id)->get();
        $spclMast = SpclMast::get();
        if(!empty($editSpecialData) && count($editSpecialData) > 0){
            return view('auth.profile.specilization-edit', compact('spclMast', 'editSpecialData', 'profilePic'));
        }else{
            return redirect('/user/profile/')->with('success','Please add the specialization first');
        }
    }
    public function specializationUpdate(Request $request){
        $speci = $request->spclEdit;
        if ($speci !== null) {
            $user_id = Auth::user()->id;
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
       
    }
    
    public function qualification(Request $request){
         $id =Auth::user()->id;
         $profilePic = ProfileDetails::where('user_id',$id)->get();
        $catgQualMast = CategoryQualMast::all();
        return view('auth.profile.edgucation', compact('catgQualMast', 'profilePic'));
    }
    public function getEducation(Request $request){
        $data['educaMast'] = QualificationMast::where("qual_catg_code", $request->qual_catg_code)
        ->get(["qual_desc","qual_code"]);
        return response()->json($data);
    }
    
    public function qualificationAdd(Request $request){
        $this->validate($request, [
            'qual_catg_code'   => 'required',
            'qual_desc'   => 'required',
            'pass_year'        => 'required|min:4|max:4',
            'pass_perc'        => 'required',
            'pass_division'    => 'required|min:1|max:1'
        ]);
        $qualCode = $request->qual_desc;
        $qualDescMast = QualificationMast::where('qual_code',$qualCode)->get();
        $user_id =Auth::user()->id; 
        $useData = UserQualMast::where('user_id',$user_id)->get();
       
        if(!empty($useData) && count($useData) > 0){
            return redirect('/user/profile/')->with('success','You are allready add the education');
        }else{
            $UserQualMa = new UserQualMast;
            $UserQualMa->user_id = $user_id;
            $UserQualMa->qual_code = $qualDescMast[0]->qual_code;
            $UserQualMa->qual_catg_code = $qualDescMast[0]->qual_catg_code;
            $UserQualMa->qual_catg_desc = $qualDescMast[0]->qual_catg_desc;
            $UserQualMa->qual_desc = $qualDescMast[0]->qual_desc;
            $UserQualMa->pass_year = $request->pass_year;
            $UserQualMa->pass_perc = $request->pass_perc;
            $UserQualMa->pass_division = $request->pass_division;
            $UserQualMa->save();
            return redirect('/user/profile/')->with('success','Education added successfully');
        }
       

    }

    public function editQualification(Request $request){
        $id = $request->id;
        $profilePic = ProfileDetails::where('user_id',$id)->get();
        $catgQualMast = CategoryQualMast::all();
        $qualEdit = UserQualMast::where('user_id',$id)->get();
        if(!empty($qualEdit) && count($qualEdit) > 0){
            return view('auth.profile.education-edit', compact('qualEdit', 'catgQualMast', 'profilePic'));
        }else{
            return redirect('/user/profile/')->with('success','Please add the education first');
        }
    }

    public function updateQualification(Request $request){
         
        $qualCode = $request->qual_desc;
        $UserQualMast = QualificationMast::where('qual_code',$qualCode)->get();
        $user_id =Auth::user()->id; 
        $UserQualMa =  UserQualMast::where('user_id', $user_id)->update([
            'qual_code' => $UserQualMast[0]->qual_code,
            'qual_catg_code' => $UserQualMast[0]->qual_catg_code,
            'qual_catg_desc' => $UserQualMast[0]->qual_catg_desc,
            'qual_desc' => $UserQualMast[0]->qual_desc,
            'pass_year' => $request->pass_year,
            'pass_perc' => $request->pass_perc,
            'pass_division' => $request->pass_division,
        ]);
        return redirect('/user/profile/')->with('success','Education updated successfully');
    }

    public function prectecingCourt(Request $request){
        $id =Auth::user()->id;
        $profilePic = ProfileDetails::where('user_id',$id)->get();
         $getCourt = courtTypeMast::all();
        return view('auth.profile.practicecourt', compact('getCourt', 'profilePic'));
    }

    public function getCourt(Request $request){
          $data['courtMast'] = CourtMast::where("court_type_code", $request->court_type_code)
        ->get();
        return response()->json($data);
    }

    public function prectecingCourtAdd(Request $request){
        $this->validate($request, [
            'court_type_code'   => 'required',
            'court_code'   => 'required'
        ]);
         $user_id =Auth::user()->id; 
         $useData = UserCourts::where('user_id',$user_id)->get();
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
    }

    public function editPrectecingCourt(Request $request){
        $id = $request->id;
        $profilePic = ProfileDetails::where('user_id',$id)->get();
        $courtEdit = UserCourts::where('user_id', $id)->get();
        $getCourt = courtTypeMast::all();
        if(!empty($courtEdit) && count($courtEdit) > 0){
            return view('auth.profile.practecing-court-edit', compact('courtEdit', 'getCourt', 'profilePic'));
        }else{
            return redirect('/user/profile/')->with('success','Please add the practecing court');
        }
    }

    public function editGetCourt(Request $request){
        
        $data['courtMastEdit'] = CourtMast::where("court_type_code", $request->court_type_code)
       ->get();
       return response()->json($data);
   }

    public function updatePrectecingCourt(Request $request){
        $courtCode = $request->court_code;
        if ($courtCode !== null) {
            $user_id = Auth::user()->id;
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
       
    }
}
