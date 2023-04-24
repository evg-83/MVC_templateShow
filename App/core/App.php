<?php

/** Application class */
class App
{
    private $controller = 'HomeController';
    private $method     = 'index';

    /** Split url function */
    private function splitUrl()
    {
        $URL = $_GET['url'] ?? 'home';
        $URL = explode('/', trim($URL, '/'));

        return $URL;
    }

    /** Controller loading function */
    public function loadController()
    {
        $URL = $this->splitUrl();
        $filename = '../App/Controllers/' . ucfirst($URL[0]) . 'Controller.php';

        if (file_exists($filename)) {
            require $filename;

            $this->controller = ucfirst($URL[0]) . 'Controller';

            unset($URL[0]);
        } else {
            $filename = '../App/Controllers/_404Controller.php';

            require $filename;

            $this->controller = '_404Controller';
        }
        
        $controller = new $this->controller;

        /** Checking if there is a second element after the first element of the url */
        if (!empty($URL[1])) {
            if (method_exists($controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }
        
        call_user_func_array([$controller, $this->method], $URL);
    }
}
