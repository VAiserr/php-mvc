<?php

namespace Core;

/**
 * Класс представления
 */

class View
{
    /**
     * Подключает файл представления
     * 
     * @param string $view название представления
     * @param array $args массив данных передоваемые представлению (optional)
     * @param string $template шаблон файла представления (optional)
     */
    public static function render($view, $args = [], $template = 'main')
    {
        extract($args, EXTR_SKIP);

        $viewFile = dirname(__DIR__) . "/app/views/$view" . '_view.php';
        if (!empty($template)) {
            $templateFile = dirname(__DIR__) . "/app/views/$template" . '_template.php';
            if (is_readable($templateFile))
                require $templateFile;
            else throw new \Exception("Template $templateFile not found");
        } else {
            if (is_readable($viewFile))
                require $viewFile;
            else throw new \Exception("View $viewFile not found");
        }
    }
}
