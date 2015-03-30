<?php

namespace App\Controller;

use \App\Lib\Controllers;

class Redirect extends Controllers
{
    public $url;

    public function __construct()
    {
        $this->url = \App\Model\URL::fromHash($_GET['r']);
    }


    public function execute()
    {
        $url = $this->url->getData('url');
        if (!empty($url)) {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $url);
        } else {
            header("Location: .");
        }
    }


}