<?php

/** User class */
class User
{
    use Model;

    /** Default table name */
    protected $table = 'users';

    /** Summary of allowed columns */
    protected $allowedColumns = [
        'email',
        'password',
    ];

    /** Validate function */
    public function validate($data)
    {
        $this->errors = [];

        /** Error message for email */
        if (empty($data['email'])) {
            $this->errors['email'] = "Email is required";
        } else {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $this->errors['email'] = "Email is not valid";
            }
        }

        /** Error message for password */
        if (empty($data['password'])) {
            $this->errors['password'] = "Password is required";
        }
        
        /** Error message for terms */
        if (empty($data['terms'])) {
            $this->errors['terms'] = "Please accept the terms and conditions";
        }

        if (empty($this->errors)) {
            return true;
        }
        return false;
    }
}
