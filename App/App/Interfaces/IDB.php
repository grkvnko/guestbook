<?php
namespace App\App\Interfaces;

interface IDB
{
    public function connect();

    public function query($sql);
}