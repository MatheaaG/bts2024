<?php

namespace Controllers;

class IndexController extends Controller
{
    public function index()
    {
        $connectUser="Mathéa";
        echo $this->twig->render('index.html',['connectUser'=>$connectUser]);
    }
}
