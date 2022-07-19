<?php
namespace App\App;

class Request
{
    private $paramPost = [];

    public function __construct() {
        foreach ($_POST as $paramKey => $paramValue) {
            $this->paramPost[$paramKey] = mysqli_real_escape_string(DB::$dbProvider->provider()->link(), $paramValue);
        }
    }

    public function post(string $key) {
        return $this->paramPost[$key] ?? null;
    }
}