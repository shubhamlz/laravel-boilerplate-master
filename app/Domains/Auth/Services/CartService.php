<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Models\Cart;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Models\Product;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CartService extends BaseService
{
    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }

    public function store(array $data = [])
    {
        DB::beginTransaction();

        try {
            $existingCarts = Cart::all();
            $product =Product::findorfail($data['product']);
            
            // if (!empty($existingCarts)) {
            //     foreach ($existingCarts as $cart) {
            //         if ($cart['user_id'] == Auth::user()->id && $cart['product_id'] == $data['product'] && $cart['quantity'] < $product->inStock) {
            //             $cartUpdateData = ['quantity' => $cart['quantity']+1,'updated_at'=>carbon::now()];
            //             $this->updateCart($cartUpdateData, $cart['id']);
            //         }
            //     }
            // }else{
                $cart = $this->createCart([
                    'user_id' => Auth::user()->id,
                    'product_id' => $data['product'],
                    'date_added' => Carbon::now(),
                    'quantity' => 1,
                ]);
            // }

           

        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            throw new GeneralException(__('There was a problem creating this team. Please try again.'));
        }

        DB::commit();

        return $cart;
    }

    public function update(array $data = []): Cart
    {
        DB::beginTransaction();

        try {
            $cartUpdateData = [
                'quantity' => $data['quantity'],
                'modified_at' => carbon::now(),
            ];
          $x=  $this->updateCart($cartUpdateData,$data['id']);
            DB::commit();
            // $userid = Auth::user()->id;
            // $userCart = User::with('cart')->where('id',$userid)->get();
            return $x;
        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralException(__('There was a problem adding this Product to cart. Please try again.'));
        }
    }

    protected function updateCart(array $data = [], $id): Cart
    {
        $cart = $this->model->where('id', $id)->firstOrFail();
        $cart->update($data); // Simplified update call
        return $cart;
    }

    protected function createCart(array $data = []): Cart
    {
        return $this->model::create([
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id'],
            'date_added' => $data['date_added'],
            'quantity' => $data['quantity'],
        ]);
    }

    public function destroy(Cart $cart,$id): bool
    {
        $deleted = $cart->findOrFail($id)->forceDelete();
        if ($deleted) {
            return true;;
        }
    
        throw new GeneralException(__('There was a problem deleting the item from the cart. Please try again.'));
    }
    public function deleteCart(Cart $cart,$id){
        $cart = $cart::where('user_id',$id);
        if(!empty($cart)){
            $cart->forceDelete();
            return true;
        }
        throw new GeneralException(__('There was a problem deleting the item from the cart. Please try again.'));
    }
}
