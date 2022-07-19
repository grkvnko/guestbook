<?php
namespace App\App;

class Router
{
    public function __construct() {

    }

    /**
     * Разбивает строку URI в массив, и проверяет
     * на наличие вызванного контроллера и метода контроллера
     * затем запускает указанный метод контроллера или контроллер по умолчанию
     */
    public static function resolve()
    {
        $cut_request_uri = mb_substr($_SERVER['REQUEST_URI'], 0, 50);

        if(strlen($cut_request_uri) > 1) {
            $routes_arr = explode('/', $cut_request_uri);
            array_shift($routes_arr);
            $route_way = 'App\Controllers\\' . array_shift($routes_arr) . 'Controller';
            $route_method = array_shift($routes_arr);
        } else {
            $route_way = 'App\Controllers\StartController';
            $route_method = 'action';
        }

        if(!class_exists($route_way)) {
            $route_way = 'App\Controllers\StartController';
            $route_method = 'error404';
        }

        $ch_controller = new $route_way;

        if(!method_exists($ch_controller, $route_method)) {
            $route_method = 'action';
        }

        return $ch_controller->$route_method(new Request());
    }
}