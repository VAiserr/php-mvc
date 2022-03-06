<?php

namespace Core;

use Exception;

/**
 * Класс маршрутизатора
 */

class Router
{

    /**
     * Ассоциативный массив маршрутов
     * 
     * @var array
     */
    protected $routes = [];

    /**
     * Параметры текущего маршрута
     * 
     * @var array
     */
    protected $parameters = [];

    /**
     * Добаваляет путь в маршрутизатор
     *
     * @param string $route Маршрут
     * @param array $params Параметры маршрута (Контроллер, действие и т.д)
     */
    public function add($route, $params = [])
    {

        $this->routes[$route] = $params;
    }

    /**
     * Проверяет наличие маршрута в маршрутизаторе
     * 
     * @param string $url URL адресс
     * 
     * @return boolean
     */
    protected function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if ($route == $url) {
                foreach ($params as $key => $value) {
                    $this->parameters[$key] = $value;
                }
                return true;
            }
        }

        return false;
    }

    /**
     * Парсит URL адресс, запускает соответствующий ему маршрут
     * 
     * @param string $url URL адресс
     */
    public function start($url)
    {
        // 
        $route = explode('?', $url)[0];
        echo 'Маршрут: ' . $route . '<br>';

        if ($this->match($route)) {
            $controller = $this->parameters['controller'];
            $controller = ucfirst($controller);
            $controller = 'App\Controllers\\' . $controller . 'Controller';

            if (class_exists($controller)) {
                $controller_object = new $controller($this->parameters);

                $action = $this->getAction();
                $action = lcfirst($action);

                if (!preg_match('/action$/i', $action)) {
                    echo 'controller: ' . $controller . '<br>';
                    echo 'action: ' . $action . '<br>';
                    $controller_object->$action();
                } else {
                    throw new \Exception("Method $action in controller $controller cannot be called directly - remove the Action suffix to call this method");
                }
            } else {
                throw new \Exception("Controller $controller does not exist");
            }
        } else {
            throw new \Exception("No route matched");
        }
    }

    /**
     * Возвращает действие маршрута, если есть или 'index'
     * 
     * @return string
     */
    protected function getAction()
    {
        if (isset($this->parameters['action']))
            return $this->parameters['action'];
        return 'index';
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
