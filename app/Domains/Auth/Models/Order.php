<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','product_id','payment_status','status','order_date','total_amount'];
    protected $table ="orders";
    public function product(){
        return $this->hasMany(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
