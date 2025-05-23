<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandTranslation;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function index(){
        $brands = Brand::get();
        // $brands = Brand::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        // return $brands;
        return view('dashboard.brands.index',compact('brands'));
    }
###################################################################################################
public function create(){
    return view('dashboard.brands.create');
}
###################################################################################################
public function store(Request $request){
    // return $request;
    $filename=uploadImage('brands',$request->photo);
    $brand=new Brand();
    $brand->name = $request -> name;
    $brand->is_active = $request -> status == 0 ? "0" : "1";
    $brand->photo=$filename;
    $brand->save();
        return redirect()->route('admin.brands') -> with(['success' => 'it was added successful']);
}
###################################################################################################
public function edit($id){
    $brands=Brand::findorfail($id);
    return view('dashboard.brands.edit',compact('brands'));
}
###################################################################################################
public function update(Request $request, $id){
    #validation
    $brands=Brand::findorfail($id);
    if(!$brands)
    return redirect()->route('admin.brands') -> with(['error' => 'it is not found']);

    if($request -> has('photo')){
        $filename=uploadImage('brands',$request->photo);
            $brands->update([
                'photo'=> $filename,
            ]);
        }


        $brands->update([
            'is_active' => $request -> status == 1 ? "1" : "0",
        ]);
        $brands -> name = $request -> name;// يونيك name هنا يوجد ملاحظة انو الباكج نفسها تعتبر ال

    $brands -> save();
    return redirect()->route('admin.brands') -> with(['success' => 'it was done successful']);

}

###################################################################################################
// public function delete($id)
// {
//     $del=Brand::Find($id);
//     // return $del;
//     $del -> delete();
//     return redirect()->route('admin.brands') -> with(['success' =>'تم الحذف بنجاح']);
// }
###################################################################################################
public function delete($id)
{
    try {
        //get specific categories and its translations
        $brand = Brand::find($id);

        if (!$brand)
            return redirect()->route('admin.brands')->with(['error' => 'هذا الماركة غير موجود ']);
        else
            $brand->delete();

        return redirect()->route('admin.brands')->with(['success' => 'تم  الحذف بنجاح']);

    } catch (\Exception $ex) {
        return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }

}
###################################################################################################
}
