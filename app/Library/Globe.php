<?php

namespace App\Library;
use Illuminate\Support\Facades\Http;
use \Exception;
use MenaraSolutions\Geographer\Earth;
use MenaraSolutions\Geographer\Country;


class Globe
{

    /**
     * @var object
     */
    public $earth;

    /**
     * @var object
     */
    public $countries;

    /**
     * Call Earth Api 
     */
    public function __construct($earth, array $countries) 
    {
        $this->earth = $earth;
        $this->countries = $countries;
    }

	/**
	 * Query Earth api
	 */
	public static function get()
	{
        $earth = (new Earth);
        $countries = $earth->getCountries();
        return (new Globe($earth, $countries->toArray()));
	}

    /**
     * List of all countries
     */
    public function countries()
    {
        return $this->countries;
    }

    /**
     * A country
     */
    public function country($code = 'NG')
    {
        return Country::build($code);
    }

    /**
     * A country currency code
     */
    public function currency($code = 'NG')
    {
        $this->country($code)->getCurrencyCode();
    }

}