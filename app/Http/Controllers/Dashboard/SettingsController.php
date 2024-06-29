<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function editShippingMethods($type){
        if($type === 'free'){
            $shippingMethod=Setting::where('key','free_shipping_label')->first();
        }
        elseif($type === 'local'){
            $shippingMethod=Setting::where('key','local_label')->first();
        }
        elseif($type === 'external'){
            $shippingMethod=Setting::where('key','outer_label')->first();
        }
            return view('dashboard.settings.shippings.edit',compact('shippingMethod'));
    }
    public function updateShippingMethods(Request $request, $id){
        $shipping = Setting::findOrfail($id);
        $shipping -> update([
            'plain_value' => $request -> plain_value,
        ]);
        $shipping -> value = $request -> value;
        $shipping -> save();
    // الحل الاسهل لأنه يرجعنا لنفس الرابط السابق مع الارغيومينت وكلشي ومعه أيضا رسالة تنبيه بالنجاح
    return redirect() -> back() -> with(['success' => 'it was done successful']);
    // الحل الاسهل لأنه يرجعنا لنفس الرابط السابق مع الارغيومينت وكلشي ومعه أيضا رسالة تنبيه بالنجاح
    }
}
