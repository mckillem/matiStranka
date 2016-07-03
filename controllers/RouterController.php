<?php

/**
 * Created by PhpStorm.
 * User: matej
 * Date: 08/06/16
 * Time: 07:53
 */
class RouterController extends Controller
{
    protected $controller;

    public function compile($parameters)
    {
        $parsedURL = $this->parseURL($parameters[0]);

        if (empty($parsedURL[0]))
            $this->redirect('article/introduction');
        $controllerClass = $this->dashesToCamelCase(array_shift($parsedURL)) . 'Controller';
        if (file_exists('controllers/' . $controllerClass . '.php'))
            $this->controller = new $controllerClass;
        else
            $this->redirect('error');
        $this->controller->compile($parsedURL);
        $this->data['title'] = $this->controller->head['title'];
        $this->data['description'] = $this->controller->head['description'];
        $this->data['keywords'] = $this->controller->head['keywords'];

        $this->view = 'layout';
        $this->data['messages'] = $this->returnMessages();


    }

    private function parseURL($url)
    {
        $parsedURL = parse_url($url);
        $parsedURL["path"] = ltrim($parsedURL["path"], "/");
        $parsedURL["path"] = trim($parsedURL["path"]);
        $separatedPath = explode("/", $parsedURL["path"]);
        return $separatedPath;
    }

    private function dashesToCamelCase($text)
    {
        $sentence = str_replace('-', ' ', $text);
        $sentence = ucwords($sentence);
        $sentence = str_replace(' ', '', $sentence);
        return $sentence;
    }

}