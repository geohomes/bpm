<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'skill_id',
        'user_id',
        'description',
        'price',
        'image',
        'status',
    ];

    /**
     * A service is created with a particular skill
     */
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    /**
     * A service is created by a perticular user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
