<?php

namespace App\Repository\Result;

use App\Models\Result;
use App\Repository\AbstractRepository;

class ResultRepository extends AbstractRepository{

    protected function getModelClass(): string
    {
        return Result::class;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function insertResult(array $params)
    {
        return $this->startCondition()->create($params);
    }
}
