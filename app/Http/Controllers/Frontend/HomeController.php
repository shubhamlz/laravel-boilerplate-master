<?php

namespace App\Http\Controllers\Frontend;

use App\Domains\Auth\Models\Cart;
use App\Domains\Auth\Models\Product;
use App\Domains\Auth\Models\Category;
use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\Auth;
/**
 * Class HomeController.
 */
class HomeController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if(Auth::user()){
            
            $userid = Auth::user()->id;
            $product = Product::with('category')->get();
            $category = Category::pluck('cat_name','id');
            $userCart = Cart::where('user_id',$userid)->get();
            return view('frontend.index',compact('product','category','userCart'));
        }else{
            return view('frontend.index');
        }
    
    }
}
