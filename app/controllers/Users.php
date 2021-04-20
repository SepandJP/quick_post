<?php


class Users extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
    }


    public function register()
    {
        // Check for POST method
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Process form
        }

        else
        {

            /**
             * Init data
             * Save data for when user refresh form or user enter wrong data, don't force enter again.
             * {}_error use for return the errors and show them.
             *
             * @var array $data
             */
            $data = [
                'username' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'username_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // Load view
            $this->loadView('users/register', $data);
        }
    }

    public function login()
    {
        // Check for POST method
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Process form
        }

        else
        {

            /**
             * Init data
             * Save data for when user refresh form or user enter wrong data, don't force enter again.
             * {}_error use for return the errors and show them.
             *
             * @var array $data
             */
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => ''
            ];

            // Load view
            $this->loadView('users/login', $data);
        }
    }
}