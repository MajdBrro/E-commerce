<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;
use SebastianBergmann\Type\NullType;

class MainCategoriesController extends Controller
{
    public function index(){
        // $categories = Category::paginate(PAGINATION_COUNT);
        // $categories = Category:: orderBy('id','DESC')-> whereNull('parent_id') ->paginate(PAGINATION_COUNT);
        $categories = Category::orderBy('id','ASC')->get();
        return view('dashboard.categories.index',compact('categories'));
    }
    ###################################################################################################
    public function create(){
        $parent_cats=Category::where('parent_id',null)->get(); //حتى نظهر الاقسام الرئيسية في القائمة التي نختار منها القسم الرئيسي الذي يتبع له القسم الفرعي
        return view('dashboard.categories.create',compact('parent_cats'));
    }
    ###################################################################################################
    public function store(Request $request){
        $category=new Category();
        $category->name = $request -> name;
        $category -> slug  = str_replace($request -> name,$request -> name .'-'.$request -> name .'-'. $request -> name, $request -> name);
        $category->is_active = $request -> is_active == 1 ? "1" : "0";
        $category->parent_id = $request -> parent_id;
        $category->save();
        return redirect()->route('admin.maincategories') -> with(['success' => 'it was added successful']);
    }
    ###################################################################################################

    public function edit($id){
        $category = Category::findOrfail($id);
        $parent_cats=Category::where('parent_id',null)->get();//حتى نظهر الاقسام الرئيسية في القائمة التي نختار منها القسم الرئيسي الذي يتبع له القسم الفرعي
        return view('dashboard.categories.edit',compact('category','parent_cats'));
    }
    ###################################################################################################
    public function update(Request $request, $id){
        $category=Category::findorfail($id);
        if(!$category)
        return redirect()->route('admin.maincategories') -> with(['error' => 'it is not found']);
    $category->update([
        // 'slug' => $request->slug,
                'is_active' => $request -> is_active == 1 ? "1" : "0",
                $category->parent_id = $request -> parent_id,
                $category -> slug  = str_replace($request -> name,$request -> name .'-'.$request -> name .'-'. $request -> name, $request -> name),
            ]);
            $category -> name = $request -> name;// يونيك name هنا يوجد ملاحظة انو الباكج نفسها تعتبر ال
            $category -> save();
            return redirect()->route('admin.maincategories') -> with(['success' => 'it was done successful']);
    }
    ###################################################################################################

    public function delete($id)
    {
        try {
            //get specific categories and its translations
            $category = Category::find($id);

            if (!$category)
            return redirect()->route('admin.maincategories')->with(['error' => 'هذا الماركة غير موجود ']);
        else
        $category->delete();

            return redirect()->route('admin.maincategories')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }
    ###################################################################################################

}
