<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Models\Order;
use App\Domains\Auth\Models\Cart;
use App\Domains\Auth\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use App\Domains\Auth\Http\Requests\Frontend\Order\StoreOrderRequest;
/**
 * Class UserController.
 */
class OrderController
{
    /**
     * @var orderService
     */
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('frontend.auth.index');
    }

    /**
     * @return mixed
     */
    public function create(StoreOrderRequest $request)
    {
        $userid = Auth::user()->id;
        // dd($userid);
        $cart = Cart::where('user_id',$userid)->get()->toArray();
        // dd($cart);
        $this->orderService->store($request->validated(),$cart);
        return view('frontend.auth.checkout');
    }

    /**
     * @param  StoreUserRequest  $request
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
   
}
