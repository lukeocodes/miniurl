<?php

namespace App\Lib;

class DBC
{

    public static function connect()
    {

        static $instance = null;
        if (null === $instance) {
            $instance = new \PDO(
                'mysql:host='.DBHOST.';dbname='.DBNAME,
                DBUSER,
                DBPASS);
        }

        return $instance;

    }


}