<?php

namespace App\Http\Service\Result;

use App\Http\Service\ServiceInterface;
use App\Repository\Result\ResultRepository;
use App\Trait\GetInstanceTrait;

class ResultService implements ServiceInterface{

    use GetInstanceTrait;

    /**
     * @return ResultRepository
     */
    public function getRepository():ResultRepository
    {
        return new ResultRepository();
    }

    /**
     * @param $params
     * @return mixed
     */
    public function insertResult($params)
    {
       return $this->getRepository()->insertResult($params);
    }

}
