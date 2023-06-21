<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=['name','image','price','inStock','description','category_id'];
    
    protected $table ="products";

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
