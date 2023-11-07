<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileDetails;
use App\Models\QualificationMast;
use App\Models\CategoryQualMast;
class QualiController extends Controller
{
    public function index(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $allquals = QualificationMast::all();
            return view('admin.education.index', compact('allquals', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function create(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $catgQual = CategoryQualMast::all();
            return view('admin.education.create', compact('catgQual', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
    public function store(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $request->validate([
                'qual_desc' => 'required'
            ]);
            $qualCatg = CategoryQualMast::where('qual_catg_code',$request->qual_catg_code)->first();
            $qualCodeType = QualificationMast::orderBy('qual_code', 'DESC')->get()->first();
            $qualCode = $qualCodeType->qual_code + 1;
            $qualData = new QualificationMast();
            $qualData->qual_code = str_pad($qualCode, 3, '0', STR_PAD_LEFT);
            $qualData->qual_catg_code = $request->qual_catg_code;
            $qualData->qual_catg_desc = $qualCatg->qual_catg_desc;
            $qualData->qual_desc = $request->qual_desc;
            $qualData->shrt_desc = $request->shrt_desc;
            $qualData->save();
            return redirect()->route('admin.qual')->with('success', 'Education added successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function edit(Request $request, $qual_code){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId =$data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $getCatgQual = CategoryQualMast::all();
            $qualEdit = QualificationMast::where('qual_code',$qual_code)->first();
            return view('admin.education.edit', compact('qualEdit', 'getCatgQual', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function update(Request $request, $qual_code){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $qualCatg = CategoryQualMast::where('qual_catg_code',$request->qual_catg_code)->first();
            $getCountry = QualificationMast::where('qual_code', $request->qual_code)->get()->first();   
            QualificationMast::where('qual_code',$qual_code)->update([
                'qual_catg_code' => $request->qual_catg_code,
                'qual_catg_desc' => $qualCatg->qual_catg_desc,
                'qual_desc' => $request->qual_desc,
                'shrt_desc' => $request->shrt_desc
            ]);
        
            return redirect()->route('admin.qual')->with('success', 'Education updated successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function delete(Request $request, $qual_code){
        $deletequal = QualificationMast::where('qual_code',$qual_code)->delete();
        return redirect()->back()->with('success', 'Education deleted successfully!');
    }
}
