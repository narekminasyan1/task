<?php

namespace App\Repository\Country;

use App\Models\Country;
use App\Repository\AbstractRepository;
use App\Trait\GetInstanceTrait;
use Illuminate\Support\Facades\DB;

class CountryRepository extends AbstractRepository{

    use GetInstanceTrait;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
       return Country::class;
    }

    /**
     * @return bool
     */
    public function checkCountriesTableValues():bool
    {
        return !!$this->startCondition()::where('id','>',0)->first();
    }

    /**
     * @param array $data
     * @return bool
     */
    public function insertCountriesFromArray(array $data)
    {
        try {

            DB::table('countries')->insert($data);

        }catch (\Exception $exception)
        {
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getCountries()
    {
        return $this->startCondition()::select(['country','code'])->get();
    }

    /**
     * @param string $country
     * @return mixed
     */
    public function getState(string $country)
    {
        return $this->startCondition()::select('state')->where('country',$country)->first();
    }
}
