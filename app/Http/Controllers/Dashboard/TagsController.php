<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(){
        // $tags = tag::get();
        $tags = Tag::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        // return $tags;
        return view('dashboard.tags.index',compact('tags'));
    }
###################################################################################################
public function create(){
    return view('dashboard.tags.create');
}
###################################################################################################
public function store(Request $request){

    $tag=new Tag();
    $tag->name = $request -> name;
    $tag -> slug  = str_replace($request -> name,$request -> name .'-'.$request -> name .'-'. $request -> name, $request -> name);
    $tag->is_active = $request -> is_active == 1 ? "1" : "0";
    $tag->save();

    return redirect()->route('admin.tags') -> with(['success' => 'it was added successful']);
}
###################################################################################################
public function edit($id){
    $tags=Tag::findorfail($id);
    return view('dashboard.tags.edit',compact('tags'));
}
###################################################################################################
public function update(Request $request, $id){
    #validation
    $tag=Tag::findorfail($id);
    if(!$tag)
    return redirect()->route('admin.tags') -> with(['error' => 'it is not found']);

    $tag->update([
        'is_active' => $request -> is_active == 1 ? "1" : "0",
        $tag -> slug  = str_replace($request -> name,$request -> name .'-'.$request -> name .'-'. $request -> name, $request -> name),
    ]);
    $tag -> name = $request -> name;// يونيك name هنا يوجد ملاحظة انو الباكج نفسها تعتبر ال
    // $brands -> slug  = str_replace(' ', '-', $request -> name);
    $tag -> save();
    return redirect()->route('admin.tags') -> with(['success' => 'it was done successful']);

}
###################################################################################################
public function delete($id)
{
    try {
        //get specific categories and its translations
        $tag = Tag::find($id);

        if (!$tag)
            return redirect()->route('admin.tags')->with(['error' => 'هذا الماركة غير موجود ']);
        else
            $tag->delete();

        return redirect()->route('admin.tags')->with(['success' => 'تم  الحذف بنجاح']);

    } catch (\Exception $ex) {
        return redirect()->route('admin.tags')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }

}
###################################################################################################

}
