<?php

namespace App\Model;

use \App\Lib\Models;

class URL extends Models
{
    public $table = "urls";
    public $primaryKey = "id";
    public $uniqueVal = "url";

    public static function fromHash($hash)
    {
        return new self(self::unhashInt($hash));
    }


    public function getHash()
    {
        if ($this->data[$this->primaryKey] !== 0) {
            return self::hashInt($this->data[$this->primaryKey]);
        }
        return null;
    }


    public static function hashInt($int)
    {
        return base_convert($int, 10, 36);
    }


    public static function unhashInt($hash)
    {
        return intval($hash, 36);
    }


}