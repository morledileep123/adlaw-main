<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CityTypeMast;
use App\Models\CityMast;
class CityController extends Controller
{
    public function index(Request $request){
        $cityMast = CityMast::all();
        return view('admin.city.cities', compact('cityMast'));
    }

    public function create(Request $request){
        $cityType = CityTypeMast::all();
        return view('admin.city.create', compact('cityType'));
    }
    public function store(Request $request){
        $request->validate([
            'city_type' => 'required',
            'city_code' => 'required',
            'city_name' => 'required',
            'state_code' => 'required',
            'state_name' => 'required',
            'country_code' => 'required',
            'country_name' => 'required'
        ]);
       $cityCreate = new CityMast();
       $cityCreate->city_type = $request->city_type;
       $cityCreate->city_code = $request->city_code;
       $cityCreate->city_name = $request->city_name;
       $cityCreate->state_code = $request->state_code;
       $cityCreate->state_name = $request->state_name;
       $cityCreate->country_code = $request->country_code;
       $cityCreate->country_name = $request->country_name;
       $cityCreate->save();
       return redirect()->route('admin.cities')->with('success', 'City added successfully!');
    }

    public function edit(Request $request){
        $cityType = CityTypeMast::all();
        return view('admin.city.create', compact('cityType'));
    }
    
}
