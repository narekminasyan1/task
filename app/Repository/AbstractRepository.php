<?php

namespace App\Repository;

abstract class AbstractRepository{

    protected $model;

    public function __construct()
    {
        $this->model = new ($this->getModelClass());
    }

    protected abstract function getModelClass():string;

    public function startCondition()
    {
        return clone $this->model;
    }

}
