<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Attribute;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // public function productDetail(){
    //     $product_detail= Product::get();
    //     return $product_detail;
    //     // return view('front.pages.product_detail')->with('product_detail',$product_detail);
    // }

    public function productsBySlug($slug)
    {
        $data=[];
        $data['product'] = Product::where('slug',$slug) -> first();  //improve select only required fields
        if (!$data['product']){ ///  redirect to previous page with message
              }
              return $data['product'];
        $product_id = $data['product'] -> id ;
        $product_categories_ids =  $data['product'] -> categories ->pluck('id'); // [1,26,7] get all categories that product on it
            //   return $product_categories_ids;
       $data['product_attributes'] =  Attribute::whereHas('options' , function ($q) use($product_id){
            $q -> whereHas('product',function ($qq) use($product_id){
                $qq -> where('product_id',$product_id);
            });
        })->get();

         $data['related_products'] = Product::whereHas('categories',function ($cat) use($product_categories_ids){
           $cat-> whereIn('categories.id',$product_categories_ids);
       }) -> limit(20) -> latest() -> get();

        return view('front.products-details', $data);
    }
}
