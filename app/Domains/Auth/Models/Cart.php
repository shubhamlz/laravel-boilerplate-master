<?php

namespace App\Domains\Auth\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;
    protected $fillable=['id','user_id','product_id','quantity','date_added'];

    public function product(){
        return $this->hasMany(Product::class);
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
