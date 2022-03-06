<?php

namespace App\Controllers;

use Core\View;

/**
 * Home controller
 */
class HomeController extends \Core\Controller
{

    public function indexAction()
    {
        View::render('home');
    }

    public function backAction()
    {
        echo 'назад';
    }
}
