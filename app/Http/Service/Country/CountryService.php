<?php

namespace App\Http\Service\Country;

use App\Http\Service\ServiceInterface;
use App\Repository\Country\CountryRepository;
use App\Trait\GetInstanceTrait;
use Illuminate\Support\Facades\Http;

class CountryService implements ServiceInterface {

    use GetInstanceTrait;

    /**
     * @return mixed
     */
    public function getCountries()
    {
        if(!$this->getRepository()->checkCountriesTableValues())
        {
            $response = Http::get('https://api.worldbank.org/v2/countries?format=json');
            $body = collect(json_decode($response->body(),true)[1]);

            $insertInfoCollection = $body->map(fn($val) => ['code' =>$val['iso2Code'] ,
                'country' =>$val['name'] , 'state' =>$val['capitalCity']]);
            $insertData = $insertInfoCollection->toArray();

            $this->insertCountries($insertData);
        }

        return $this->getRepository()->getCountries();
    }

    /**
     * @return CountryRepository
     */
    public function getRepository():CountryRepository
    {
        return CountryRepository::getInstance();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function insertCountries(array $data)
    {

        if(!$this->getRepository()->insertCountriesFromArray($data))
        {
            abort(400);
        }
        return true;
    }

    /**
     * @param string $country
     * @return mixed
     */
    public function getState(string $country)
    {
       return $this->getRepository()->getState($country);
    }

}
