<?php

namespace App\Http\Controllers\Frontend\User;
use App\Domains\Auth\Models\Product;
use App\Domains\Auth\Models\Cart;
use App\Domains\Auth\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user =Auth::user()->id;
        $userCart = User::with('cart')->Where('id',$user)->get();
        // dd($userCart);
        $productid=[];
        foreach($userCart as $cartid){
            $productid=$cartid->cart->product_id;
        }
        $userProduct = Product::with('cart')->Where('id',$productid)->get();
        // dd($userProduct);
        return view('frontend.user.dashboard',compact('userProduct','userCart'));
    }
}
