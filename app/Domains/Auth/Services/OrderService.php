<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Models\Order;
use App\Domains\Auth\Models\Cart;
use App\Domains\Auth\Models\Product;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Carbon\Carbon;
use Exception;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class orderService.
 */
class OrderService extends BaseService
{
    /**
     * orderService constructor.
     *
     * @param  Order  $order
     */
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    /**
     * @param  array  $data
     * @return Order
     *
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = [],$cart): Order
    {
        
        DB::beginTransaction();
       
        try {
         foreach($cart as $item){
          $transactionLevel = DB::transactionLevel();
            $product=Product::where('id',$item['product_id'])->get()->toArray();
            // dd($product[0]['inStock']);
            $cartquant=$item['quantity'];
            if($product[0]['inStock']>=$cartquant){
                 $amount = $cartquant*$product[0]['price'];
            }
        
            $order = $this->createOrder([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'payment_status' => "process",              
                'total_amount' =>$amount,
                'order_date' => Carbon::now(),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
                "status" =>"active",
            ]);
            if($transactionLevel>0){
                Cart::where('id',$item['id'])->delete();
              }
            }
            
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating this order. Please try again.'));
        }

        DB::commit();
       
        return $order;
    }

    /**
     * @param  Order  $order
     * @param  array  $data
     * @return Order
     *
     * @throws \Throwable
     */
    public function update(Order $order, array $data = [], $tdata): Order
    {
        DB::beginTransaction();
        try {
            $orderData = [
                'user_id' =>        $data['user_id'],
                'product_id' =>     $data['product_id'],
                'payment_status' => $data['payment_status'],              
                'total_amount' =>   $data['total_amount'],
                'order_date' =>     $data['order_date'],
                "created_at" =>     $data['created_at'],
                "status" =>         $data['status'],
            ];

            // Update the order
            
            $order = $this->update($orderData, $tdata->get('id'));
            // TODO: Handle order roles and permissions here
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this order. Please try again.'));
        }



        return $order;
    }

    /**
     * @param  array  $data
     * @return order
     */
    /**
     * @param  array  $data
     * @return order
     */
    /**
     * @param  array  $data
     * @return order
     */
    protected function updateOrder(array $data = [], $id): Order
    {   
        $order = $this->model->where('id', $id)->firstOrFail();
        $order->update([
            'user_id' =>        $data['user_id'],
            'product_id' =>     $data['product_id'],
            'payment_status' => $data['payment_status'],              
            'total_amount' =>   $data['total_amount'],
            'order_date' =>     $data['order_date'],
            "created_at" =>     $data['created_at'],
            "status" =>         $data['status'],
        ]);

        return $order;
    }
    protected function createOrder(array $data = []): Order
    {
        return $this->model::create([
            'user_id' =>        $data['user_id'],
            'product_id' =>     $data['product_id'],
            'payment_status' => $data['payment_status'],              
            'total_amount' =>   $data['total_amount'],
            'order_date' =>     $data['order_date'],
            "created_at" =>     $data['created_at'],
            "status" =>         $data['status'],
        ]);
    }
}
