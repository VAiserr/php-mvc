<?php

namespace Core;

/**
 * Базовый класс реализующий контроллеры
 */
abstract class Controller
{

    /**
     * Параметры текущего маршрута
     * @var array
     */
    protected $route_params = [];

    /**
     * Конструктор класса
     * 
     * @param array $route_params Параметры из маршрута
     */
    public function __construct($route_params)
    {
        $this->route_params = $route_params;
    }

    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            } else {
                throw new \Exception('Access denied');
            }
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     * Вызывается до любого действия контроллера  
     * Если возвращает false , отменяет след. действие
     */
    protected function before()
    {
    }

    /**
     * Вызывается после любого действия контроллера
     */
    protected function after()
    {
    }
}
