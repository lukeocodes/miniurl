<?php

namespace App\Controller;

use \App\Lib\Controllers;

class Main extends Controllers
{
    public $view;

    public function __construct()
    {
        $message = "";
        $url = "";

        if (!empty($_POST)) {
            if (!filter_var($_POST['url'], FILTER_VALIDATE_URL) === false) {
                $url = $_POST['url'];
            } else {
                $message = '<div class="alert alert-danger" role="alert">
          <i class="fa fa-exclamation"></i> Invalid URL
        </div>';
            }

            if (!empty($url)) {
                $urlObj = new \App\Model\URL();
                $urlObj->uniqueCheck($url);
                $urlObj->setData('url', $url);
                $urlObj->save();

                $this->view = new \App\View\Done();
                $this->view->setData('urlHash', "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."?r=".$urlObj->getHash());

                $message = '<div class="alert alert-success" role="alert">
          <i class="fa fa-tick"></i> Success!
        </div>';
            } else {
                $url = $_POST['url'];
                $this->view = new \App\View\Main();
            }
        } else {
            $this->view = new \App\View\Main();
        }

        $this->view->setData('url', $url);
        $this->view->setData('message', $message);
        $this->view->setData('title', 'Miniurl');
    }


    public function execute()
    {
        $this->view->render();
    }


}