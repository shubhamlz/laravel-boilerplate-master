<?php

namespace App\Domains\Auth\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory,SoftDeletes;

    public const TYPE_ADMIN = 'admin';
    public const TYPE_USER = 'user';

    protected $table='teams';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'img',
        'designation',
        'available_from',
        'available_till',        
    ];

}
