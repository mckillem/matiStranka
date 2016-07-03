<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 08/06/16
 * Time: 08:34
 */
class ErrorController extends Controller
{
    public function compile($parameters)
    {
        header("HTTP/1.0 404 Not Found");
        $this->head['title'] = 'Chyba 404';
        $this->view = 'error';
    }
}