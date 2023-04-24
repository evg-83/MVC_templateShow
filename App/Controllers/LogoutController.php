<?php

/** Logout class */
class LogoutController
{
    use Controller;

    /** Common function */
    public function index()
    {
        /** check if there is a registered user, then delete */
        if (!empty($_SESSION['USER'])) {
            unset($_SESSION['USER']);
        }

        redirect('home');
    }
}
