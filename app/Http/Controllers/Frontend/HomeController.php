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
        $product = Product::with('category')->get();
        $category = Category::pluck('cat_name','id');
        $userid = Auth::user()->id;
        $userCart = User::with('cart')->where('id',$userid)->get();
        // dd($userCart);
        return view('frontend.index',compact('product','category','userCart'));
    }
}
