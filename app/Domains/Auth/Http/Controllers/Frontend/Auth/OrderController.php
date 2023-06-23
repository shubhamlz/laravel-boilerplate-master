<?php

namespace App\Domains\Auth\Http\Controllers\Frontend\Auth;

use App\Domains\Auth\Models\Order;
use App\Domains\Auth\Services\OrderService;


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
        return view('frontend.auth.appointment.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.user.create');
    }

    /**
     * @param  StoreUserRequest  $request
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
   
}
