<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;
use App\Domains\Auth\Http\Requests\Frontend\Cart\StoreCartRequest;
use App\Domains\Auth\Http\Requests\Frontend\Cart\UpdateCartRequest;
use App\Domains\Auth\Http\Requests\Frontend\Cart\DeleteCartRequest;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Models\Cart;
use App\Domains\Auth\Models\Category;
use App\Domains\Auth\Models\Product;
use App\Domains\Auth\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * Class UserController.
 */
class CartController
{
    /**
     * @var UserService
     */
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('frontend.auth.appointment.index');
    }

    /**
     * @return mixed
     */
    public function create(StoreCartRequest $request)
    {
        // echo Auth::user()->name;
      
         $this->cartService->store($request->all());
        //  $product =Product::with('category')->get();
        //  $category =Category::pluck('cat_name','id')->all();
         return redirect()->route('frontend.index')->withFlashSuccess(__('The Product was added to Cart successfully, please check your cart.'));
    }

    /**
     * @param  StoreUserRequest  $request
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store()
    {
        $user = $this->cartService->store();

        return redirect()->route('user.auth.show', $user)->withFlashSuccess(__('The user was successfully created.'));
    }

    public function update(UpdateCartRequest $request)
    {
        // dd($request->all());
        $id = $request->id;
        $type =$request->type;
        $quantity = $request->quantity;
        $subtotal = $request->subtotal;
        $amount = $request->perhead;
       $userCart = $this->cartService->update($request->validated());
       
    //    $user =Auth::user()->id;
    //    $userCart = Cart::Where('id',$id)->get()->toArray();
    // //    dd($userCart[0]['product_id']);
    //    $userProduct = Product::with('cart')->Where('id',$userCart[0]['product_id'])->get()->toArray();

       $data=['total'=> $subtotal,"perhead"=>$amount,'id'=>$id,'type'=>$type];
       
       return json_encode($data); die();
       //return view('frontend.user.dashboard',compact('userProduct','userCart'));
    }

    // /**
    //  * @param  DeleteUserRequest  $request
    //  * @param  User  $user
    //  * @return mixed
    //  *
    //  * @throws \App\Exceptions\GeneralException
    //  */
    public function destroy(DeleteCartRequest $request, Cart $cart)
    {
        $id= $request->id;
        $this->cartService->destroy($cart,$id);

        return redirect()->route('frontend.user.dashboard')->withFlashSuccess(__('Item was successfully deleted.'));
    }
    public function removeCart(DeleteCartRequest $request, Cart $cart){
        $id= $request->userid;
          $this->cartService->deleteCart($cart,$id);

        return redirect()->route('frontend.user.dashboard')->withFlashSuccess(__('Item was successfully deleted.'));
    }
}
