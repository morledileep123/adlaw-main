<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileDetails;
use App\Models\SpclMast;
class SpclController extends Controller
{
    public function index(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $allspcls = SpclMast::all();
            return view('admin.specialization.index', compact('allspcls', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function create(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            return view('admin.specialization.create', compact('userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
    public function store(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $request->validate([
                'spcl_desc' => 'required'
            ]);
            $spclCodeType = SpclMast::orderBy('spcl_code', 'DESC')->get()->first();
            $spclCode = $spclCodeType->spcl_code + 1;
            $spclData = new SpclMast();
            $spclData->spcl_code = str_pad($spclCode, 3, '0', STR_PAD_LEFT);
            $spclData->spcl_desc = $request->spcl_desc;
            $spclData->short_desc = $request->short_desc;
            $spclData->description = $request->description;
            $spclData->save();
            return redirect()->route('admin.spcl')->with('success', 'Spcl added successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function edit(Request $request, $spcl_code){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $getCountry = SpclMast::all();
            $spclEdit = SpclMast::where('spcl_code',$spcl_code)->first();
            return view('admin.specialization.edit', compact('spclEdit', 'getCountry', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function update(Request $request, $spcl_code){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $getCountry = SpclMast::where('spcl_code', $request->spcl_code)->get()->first();   
            SpclMast::where('spcl_code',$spcl_code)->update([
                'spcl_desc' => $request->spcl_desc,
                'short_desc' => $request->short_desc,
                'description' => $request->description
            ]);
        
            return redirect()->route('admin.spcl')->with('success', 'Spcl updated successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function delete(Request $request, $spcl_code){
        $deleteSpcl = SpclMast::where('spcl_code',$spcl_code)->delete();
        return redirect()->back()->with('success', 'Spcl deleted successfully!');
    }
}
