<?php

/** Signup class */
class SignupController
{
    use Controller;

    /** Common function */
    public function index()
    {
        $data = [];
        
        /** check for the uniqueness of the request (first reg or not) */
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $user = new User;
            /** confirmation check */
            if ($user->validate($_POST)) {
                $user->insert($_POST);
    
                redirect('login');
            }
            
            $data['errors'] = $user->errors;
        }

        $this->view('signup', $data);
    }
}
