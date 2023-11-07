<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ProfileDetails;
use App\Models\PackageMast;
class PackageController extends Controller
{
    public function index(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $allPackages = PackageMast::all();
            return view('admin.package.index', compact('allPackages', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function create(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            return view('admin.package.create', compact('userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }
    public function store(Request $request){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $request->validate([
                'package_desc' => 'required',
                'valid' => 'required',
                'rate' => 'required'
            ]);
            $packageId = PackageMast::orderBy('package_id', 'DESC')->get()->first();
            $packagesId= $packageId->package_id + 1;
            $qualData = new PackageMast();
            $qualData->package_id =  $packagesId;
            $qualData->package_desc = $request->package_desc;
            $qualData->valid = $request->valid;
            $qualData->rate = $request->rate;
            $qualData->save();
            return redirect()->route('admin.package')->with('success', 'Package added successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function edit(Request $request, $package_id){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            $userId = $data->id;
            $userProfile = ProfileDetails::where('user_id', $userId)->get()->first();
            $packageEdit = PackageMast::where('package_id',$package_id)->first();
            return view('admin.package.edit', compact('packageEdit', 'userProfile'));
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function update(Request $request, $package_id){
        $data = Auth::user();
        if(isset($data) && $data->id !=''){
            PackageMast::where('package_id',$package_id)->update([
                'package_desc' => $request->package_desc,
                'valid' => $request->valid,
                'rate' => $request->rate
            ]);
            return redirect()->route('admin.package')->with('success', 'Package updated successfully!');
        }else{
            return redirect()->route('login')->with('success','Session destroy please login');
        }
    }

    public function delete(Request $request, $package_id){
        $deletequal = PackageMast::where('package_id',$package_id)->delete();
        return redirect()->back()->with('success', 'Package deleted successfully!');
    }
}
