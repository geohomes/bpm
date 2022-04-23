<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'role',
        'description',
        'code',
        'status',
    ];

    public static $roles = [
        'admin' => '',
        'manager' => '',
        'blogger' => '',
        'acountant' => '',
    ];

    /**
     * Get main role
     */
    public function main($query)
    {
        return $query->where(['status' => 'active']);
    }
}
