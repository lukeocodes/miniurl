<?php

namespace App\View;

use \App\Lib\Views;

class Main extends Views
{
    public $template;

    public function setTemplate()
    {
        $this->template = "main";
    }


}