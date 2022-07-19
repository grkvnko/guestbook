<?php
namespace App\App;

class DBProvider
{
    private $dbProvider;

    public function __construct(Interfaces\IDB $dbProvider)
    {
        $this->dbProvider = $dbProvider->connect();
    }

    public function provider()
    {
        return $this->dbProvider;
    }
}