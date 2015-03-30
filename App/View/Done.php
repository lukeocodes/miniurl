<?php

namespace App\View;

use \App\Lib\Views;

class Done extends Views
{
    public $template;

    public function setTemplate()
    {
        $this->template = "done";
    }
}