<?php

namespace Brand\Controllers;

use Brand\Models\Brand;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class BrandController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function create(){
        return view('Brand::welcome');
    }

    public function store(Request $request){
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|min:2|max:15',
//            'slug' => 'required|min:2|max:25',
//        ]);
//        if ($validator->fails()){
//            return redirect()->back()->withErrors($validator->errors()->getMessages());
//        }
        try {
            DB::beginTransaction();
            $brand = Brand::create([
               'name' => $request->input('name'),
               'slug' => $request->input('slug')
            ]);
            dd('dfasdf');
            if ($brand){
                DB::commit();
                return redirect()->back()->with('success', 'Brand successfully added');
            }
            throw new \Exception('Invalid data');
        }catch (\Exception $ex){
            return redirect()->back()->withErrors($ex->getMessage());
        }
    }
}
