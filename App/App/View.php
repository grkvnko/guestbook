<?php
namespace App\App;

class View
{
    public static function render($view, $data = []) {
        require_once 'App/Views/header.php';
        require_once 'App/Views/' . $view . '.php';
        require_once 'App/Views/footer.php';
    }
}