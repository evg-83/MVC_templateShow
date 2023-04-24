<?php

/** Login class */
class LoginController
{
    use Controller;

    /** Common function */
    public function index()
    {
        $data = [];

        /** check for the uniqueness of the request (first reg or not) */
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User;

            /** any mail */
            $arr['email'] = $_POST['email'];

            /** I take a row from email */
            $row = $user->first($arr);

            /** if there is an entry, check the password */
            if ($row) {
                if ($row->password === $_POST['password']) {
                    $_SESSION['USER'] = $row;

                    redirect('home');
                }
            }
            
            $user->errors['email'] = "Неверный email или пароль";

            $data['errors'] = $user->errors;
        }

        $this->view('login', $data);
    }
}
