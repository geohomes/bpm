<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    /**
     * Agent types.
     *
     * @var []
     */
    public static $types = [
        'red' => 'Real Estate Developer', 
        'rea' => 'Real Estate Agent',
        'prd' => 'Property Developer',
    ],

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'certified', 
        'website', 
        'status',
        'code', 
        'services', 
        'description',
        'phone',
        'type',
        'reference',
    ];

}
