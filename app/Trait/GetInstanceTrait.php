<?php

namespace App\Trait;

trait GetInstanceTrait{

    private static $instance;

    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
