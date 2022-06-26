<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Http\Service\Country\CountryService;
use Illuminate\Support\Facades\Cache;

class CountryController extends Controller{

    private $countryService;

    public function __construct()
    {
        $this->countryService = CountryService::getInstance();
    }

    public function getCountries()
    {
        $countries= Cache::remember('countries', 7200, function () {
            return $this->countryService->getCountries();
        });

       return view('index',compact('countries'));
    }

    /**
     * @param $country
     * @return array
     */
    public function getState($country)
    {
        $responseStateArray = Cache::remember('state_'.$country, 7200, function () use($country){
            return ['state' => $this->countryService->getState($country)->state];
        });

        return $responseStateArray;
    }

}
