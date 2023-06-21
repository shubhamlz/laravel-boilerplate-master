<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','image','price','inStock','description','category_id'];

    // protected $table ="products";

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
