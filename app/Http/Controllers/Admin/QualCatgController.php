<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CategoryQualMast;
use App\Models\ProfileDetails;
class QualCatgController extends Controller
{
    public function index(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $catgQualMast = CategoryQualMast::all();
            return view('admin.educatgories.index', compact('catgQualMast', 'userProfile'));
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
            return view('admin.educatgories.create', compact('catgQual', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
    public function store(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $request->validate([
                'qual_catg_desc' => 'required',
                'shrt_desc' => 'required'
            ]);
            $qualCodeType = CategoryQualMast::orderBy('qual_catg_code', 'DESC')->get()->first();
            $qualCatgCode = $qualCodeType->qual_catg_code + 1;
            $qualData = new CategoryQualMast();
            $qualData->qual_catg_code =  $qualCatgCode;
            $qualData->qual_catg_desc = $request->qual_catg_desc;
            $qualData->shrt_desc = $request->shrt_desc;
            $qualData->save();
            return redirect()->route('admin.educatg')->with('success', 'Education category added successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function edit(Request $request, $qual_catg_code){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $qualCatgEdit = CategoryQualMast::where('qual_catg_code',$qual_catg_code)->first();
            return view('admin.educatgories.edit', compact('qualCatgEdit', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function update(Request $request, $qual_catg_code){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            CategoryQualMast::where('qual_catg_code',$qual_catg_code)->update([
                'qual_catg_desc' => $request->qual_catg_desc,
                'shrt_desc' => $request->shrt_desc
            ]);
            return redirect()->route('admin.educatg')->with('success', 'Education category updated successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function delete(Request $request, $qual_catg_code){
        $deletequal = CategoryQualMast::where('qual_catg_code',$qual_catg_code)->delete();
        return redirect()->back()->with('success', 'Education category deleted successfully!');
    }
}
