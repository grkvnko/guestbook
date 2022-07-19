<?php
define("GUESTBOOK_ON", true);
define('ROOTPATH', __DIR__);

require ROOTPATH . '/vendor/autoload.php';

$settings = include_once('settings.php');

$app = new \App\App\App($settings);
$app->route();
