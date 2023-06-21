<?php

namespace App\Domains\Auth\Models\Traits\Relationship;

use App\Domains\Auth\Models\PasswordHistory;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->morphMany(PasswordHistory::class, 'model');
    }
    public function cart(){
        return $this->hasOne(Cart::class,'model');
    }
    public function order(){
        return $this->hasMany(Order::class,'model');
    }
}
