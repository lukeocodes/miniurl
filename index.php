<?php

namespace App;

require_once('config.php');

if (!empty($_POST)) {
    $_POST = \App\Lib\Secure::sanitizeArr($_POST);
}

if (!empty($_GET['r'])) {
    $app = new \App\Controller\Redirect();
} else {
    $app = new \App\Controller\Main();
}

$app->execute();