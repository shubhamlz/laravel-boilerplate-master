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
        $userCart = Cart::where('user_id',$user)->get();
        // dd($userCart);
        $productid=[];
        foreach($userCart as $cartid){          
                $productid[]=$cartid->product_id;        
        }   
        if(!empty($userCart) && !empty($productid)){
            $userProduct = Product::with('cart')->whereIn('id',$productid)->get();
        }else{
            $userProduct =[];
        }

        return view('frontend.user.dashboard',compact('userProduct','userCart'));
    }
}
