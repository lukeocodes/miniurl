<?php

namespace App\Lib;

abstract class Views
{
    public $header = "header";
    public $footer = "footer";
    public $dir;
    public $ext = ".tpl";

    public $data = array();

    public function __construct()
    {
        $this->setTemplate();
        $this->dir = realpath(dirname($_SERVER['SCRIPT_FILENAME']))."/App/View/Templates/";
    }


    abstract public function setTemplate();

    public function render()
    {
        echo $this->getFile($this->header).$this->getFile($this->template).$this->getFile($this->footer);
    }


    private function getFile($file)
    {
        return $this->parseFile(file_get_contents($this->dir.$file.$this->ext));
    }


    private function parseFile($input)
    {
        return preg_replace_callback('!\{\{(\w+)\}\}!', array($this, 'stringMatch'), $input);
    }


    private function stringMatch($matches)
    {
        if (isset($this->data[$matches[1]])) {
            return $this->data[$matches[1]];
        } else {
            return $matches[1];
        }
    }

    public function setData($key, $value) {
        $this->data[$key] = $value;
    }
}