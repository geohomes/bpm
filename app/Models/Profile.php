<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * Profile designations.
     *
     * @var []
     */
    public static $designations = ['corporate', 'individual'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'image',
        'description',
        'companyname',
        'document',
        'phone',
        'type',
        'companylogo',
        'address',
        'country_id',
        'code',
        'website',
        'idnumber',
        'status',
        'role',
        'rcnumber',
        'iscertified',
        'email',
        'reference',
        'designation',
        'user_id',
        'state',
        'city',
        'certified',
    ];

    /**
     * Profile documents.
     *
     * @var []
     */
    public static $documents = [
        'National Identity Card',
        'International Passport',
        'NIN',
        'Voters Card', 
        'Drivers Liscence',
    ];

    /**
     * Profile status.
     *
     * @var []
     */
    public static $status = ['active', 'inactive'];


    /**
     * To deserialize it from JSON into a PHP array
     */
    protected $casts = [];

    /**
     * Profile roles.
     *
     * @var []
     */
    public static $roles = [
        'agent' => 'Property Developer',
        'artisan' => 'Artisan',
        'agent' => 'Real Estate Agent',
        'dealer' => 'Building Materials Dealer',
        'agent' => 'Real Estate Developer',
    ];

    /**
     * Profile types.
     *
     * @var []
     */
    public static $types = ['normal', 'partner'];

    /**
     * Profile educational qualifications.
     *
     * @var []
     */
    public static $qualifications = [
        'BSc' => 'Bachelor\'s Degree', 
        'SSCE' => 'Senior School Certificate', 
        'OND' => 'National Diploma',
        'HND' => 'Higher National Diploma',
    ];

    /**
     * A user may have a profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A profile belongs to a country
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * A user profile may have many reviews
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
