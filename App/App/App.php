<?php
namespace App\App;

class App
{
    public function __construct($settings)
    {
        DB::$dbProvider = new DBProvider(new dbmysql($settings['db']));
    }

    public function route()
    {
        return Router::resolve();
    }
}