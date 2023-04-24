<?php

/** Home controller */
class HomeController
{
    use Controller;
    
    /** Common function */
    public function index()
    {
        /** Checking if the user is logged in */
        $data['username'] = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
        
        $this->view('home', $data);
    }
}
