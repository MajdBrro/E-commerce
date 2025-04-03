<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\ProductPriceValidation;
use App\Http\Requests\ProductStockRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index()
    {
        // $products = Product::select('id','slug','price', 'created_at')->paginate(PAGINATION_COUNT);
        $products = Product::get();
        return view('dashboard.products.general.index', compact('products'));
    }
####################################################################################################
public function create()
{
    $data =[];
    $data['brands']=Brand::active()->get();
    $data['tags']=Tag::get();
    $data['categories']=Category::active()->get();
    return view('dashboard.products.general.create',$data);
    
}
####################################################################################################
public function store(Request $request)
{
    DB::beginTransaction();
    
    //validation
    
    if (!$request->has('is_active'))
    $request->request->add(['is_active' => 0]);
    else
    $request->request->add(['is_active' => 1]);

    $product = Product::create([
        'slug' => $request->slug,
        'brand_id' => $request->brand_id,
        'is_active' => $request->is_active,
    ]);
    //save translations
    $product->name = $request->name;
    $product->description = $request->description;
    $product->short_description = $request->short_description;
    $product->save();

    //save product categories
    
    $product->categories()->attach($request->categories);
    $product->tags()->attach($request->tags);
    
    //save product tags
    
    DB::commit();
    return redirect()->route('admin.products')->with(['success' => 'تم ألاضافة بنجاح']);

}
####################################################################################################
public function edit($id) {  
    // Find the product by its ID, or fail if not found  
    $product = Product::findOrFail($id);  
    
    // Get all active brands, tags, and categories  
    $data = [  
        'brands' => Brand::get(),  // Get active brands  
        'tags' => Tag::all(),      // Get all tags  
        'categories' => Category::get() // Get active categories  
    ];  
    
    // Retrieve the previously associated tags and categories for the product  
    $data2 = [  
        'tags2' => $product->tags,          // Get tags related to the product  
        'categories2' => $product->categories // Get categories related to the product  
    ];  

    // Return the edit view with the product and necessary data  
    return view('dashboard.products.general.edit', compact('product', 'data', 'data2'));  
}
###################################################################################################
public function update(Request $request){
    #validation
   
    
    $product=Product::findorfail($request -> producy_id);
    if(!$product)
    return redirect()->route('admin.products') -> with(['error' => 'it is not found']);

    else    
        $product->update([
            'slug' => $request->slug,
            'brand_id' => $request->brand_id,
        ]);
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->short_description = $request->short_description;


        $product->categories()->attach($request->categories);
        $product->tags()->attach($request->tags);

        $product->save();


        DB::commit();
        return redirect()->route('admin.products')->with(['success' => 'تم ألاضافة بنجاح']);
    

}


####################################################################################################
    
public function  getPrice($id)
{
    $product = Product::findOrfail($id);
    return view('dashboard.products.prices.create',compact('product'));
}
####################################################################################################

public function saveProductPrice(Request $request)
{
    $product=Product::findorfail($request -> producy_id);
           $product->update([
            'price' => $request -> price,
            'special_price' => $request -> special_price,
            'special_price_start' => $request -> special_price_start,
            'special_price_end' => $request -> special_price_end,
        ]);

    $product -> save();
    // Product::whereId($request -> product_id) -> update($request -> only(['price','special_price','special_price_start','special_price_end']));
    return redirect()->route('admin.products')->with(['success' => 'it was done successful']);
}
####################################################################################################
public function  getStock($id)
{
    $product = Product::findOrfail($id);
    return view('dashboard.products.stock.create', compact('product'));
}
####################################################################################################
public function saveProductStock (Request $request){

    $product=Product::findorfail($request -> producy_id);
    // return $request;
           $product->update([
            'sku' => $request -> sku,
            'manage_stock' => $request -> manage_stock,
            'in_stock' => $request -> in_stock,
            'qty' => $request -> qty,
            'is_active' => $request->is_active,
        ]);

    $product -> save();
    return redirect()->route('admin.products')->with(['success' => 'it was done successful']);
    // Product::whereId($request -> product_id) -> update($request -> except(['_token','product_id']));
    
    // return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);
    
}
####################################################################################################
public function addImages($product_id){
    return view('dashboard.products.images.create')->with('id',$product_id);
}
####################################################################################################

// to save images to folder only not to Data Base
public function saveProductImages(Request $request ){
    
    $file = $request->file('dzfile');
    $filename = uploadImage('products', $file);
    
    return response()->json([
        'name' => $filename,
        'original_name' => $file -> getClientOriginalName(),
    ]);
}
####################################################################################################
public function saveProductImagesDB(Request $request){
    if($request->has('document')&&count($request->document)>0){
        foreach($request -> document as $image){
            Image::create([
                'product_id' => $request -> product_id,
                'photo' => $image,
            ]);
        }
    }
    return redirect()->route('admin.products')->with(['success' => 'تم إضافة الصور بنجاح']);
    
}
####################################################################################################
public function delete($id)
{


        //get specific categories and its translations
        $product = Product::findOrfail($id);

        if (!$product)
            return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);
        else
        $product->forceDelete();

        return redirect()->route('admin.products')->with(['success' => 'تم  الحذف بنجاح']);



}

}