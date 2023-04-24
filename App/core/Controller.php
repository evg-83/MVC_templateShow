<?php

trait Controller
{
    /** View function */
    public function view($name, $data=[])
    {
        /** If there is data, then extract */
        if (!empty($data)) {
            extract($data);
        }
        
        $filename = "../App/views/" . $name . ".view.php";
    
        if (file_exists($filename)) {
            require $filename;
        } else {
            $filename = "../App/views/404.view.php";
    
            require $filename;
        }
    }
}
