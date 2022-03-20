<?php

    namespace App\src\controller;

    use App\core\Controller;

    class HomeController extends Controller
    {
public function home(){
    $this->view->render('home');
}
    }