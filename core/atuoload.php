<?php

function autoload($className)
{
    $className = ltrim($className, '\\');
    $namespace = '';
    $fileName = '';

    if ($lastPos = strrpos($className, '\\')) {
        $namespace = strtolower(substr($className, 0, $lastPos + 1));
        $className = substr($className, $lastPos + 1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
    }

    $fileName .= $className . '.php';

    require_once $fileName;
}

spl_autoload_register('autoload');
