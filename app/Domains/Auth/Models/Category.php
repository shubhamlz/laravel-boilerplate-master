<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $fillable=['cat_name','cat_description'];
    public function Product():HasMany
    {
        return $this->hasMany(Product::class);
    }
}
