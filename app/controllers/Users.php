<?php


class Users extends Controller
{
    private $userModel;

    public function __construct()
    {
        $modelName = 'User';
        $this->userModel = $this->loadModels('User');
    }

    public function index()
    {
    }


    /**
     * For register the users
     *
     * Get data from the user
     * and
     * Validating them
     * after that
     * Insert data in the database
     */
    public function register()
    {
        // Check for POST method
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Process form

            /**
             *
             * Sanitize data that all of the entered data is String
             *
             */
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            /**
             * Init data
             * {}_error use for return the errors and show them.
             *
             * function:
             * trim() for remove empty character in entered data
             *
             * @var array $data
             */
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'username_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            /**
             * Sanitize data
             *
             * filter_input_array() for Sanitize data
             *
             * // todo create a professional data validation with example of blow link:
             * // https://www.php.net/manual/en/function.filter-input-array.php
             *
             */


            /**
             *
             * Validate all data that them not empty
             *
             */
            // Validate Email
            if(empty($data['email']))
            {
                $data['email_error'] = 'Please enter email';
            }
            else
            {
                // Check exists email
                if ($this->userModel->findUserByEmail($data['email']))
                {
                    $data['email_error'] = 'Email is already taken';
                }
            }

            // Validate Name
            if(empty($data['username']))
            {
                $data['username_error'] = 'Please enter Username';
            }

            // Validate Password
            if(empty($data['password']))
            {
                $data['password_error'] = 'Please enter password';
            }
            elseif (strlen($data['password']) < 5)
            {
                $data['password_error'] = 'Password must be at least 5 characters';
            }

            // Validate Confirm Password
            if(empty($data['confirm_password']))
            {
                $data['confirm_password_error'] = 'Please confirm password';
            }
            else
            {
                if($data['password'] != $data['confirm_password'])
                {
                    $data['confirm_password_error'] = 'Passwords do not match';
                }
            }


            /**
             *
             * Make sure not exists any errors and [.._errors] fields are empty
             * Stop register if exists any errors
             *
             */
            if (empty($data['email_error']) && empty($data['username_error']) && empty($data['password_error']) && empty($data['confirm_password_error']))
            {
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                // process in model
                if (!($this->userModel->register($data)))
                {
                    flashMessages('registerIsSuccessful', 'You are registered successfully and can log in now.');
                    redirect('users/login');
                }
                else
                {
                    die('Something went wrong...');
                }
            }
            else
            {
                // Load view with errors
                $this->loadView('users/register', $data);
            }

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

    /**
     * For login the user
     *
     * Get email and password from the user
     * and
     * Find user data in the database with email
     * then
     * Verify password
     */
    public function login()
    {
        // If the user is logged in, redirect to index page.
//        if ($this->isLoggedIn())
//        {
//            redirect('posts');
//        }

        // Check for POST method
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Process form

            /**
             *
             * Sanitize data that all of the entered data is String
             *
             */
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            /**
             * Init data
             * {}_error use for return the errors and show them.
             *
             * function:
             * trim() for remove empty character in entered data
             *
             * @var array $data
             */
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => null,
                'password_error' => null,
            ];

            /**
             * Sanitize data
             *
             * filter_input_array() for Sanitize data
             *
             * // todo create a professional data validation with example of blow link:
             * // https://www.php.net/manual/en/function.filter-input-array.php
             *
             */


            /**
             *
             * Validate all data that them not empty
             *
             */

            // Validate Password
            if(empty($data['password']))
            {
                $data['password_error'] = 'Please enter password';
            }
            elseif (strlen($data['password']) < 5)
            {
                $data['password_error'] = 'Password must be at least 5 characters';
            }


            // Validate Email
            if(empty($data['email']))
            {
                $data['email_error'] = 'Please enter email';
            }
            else
            {
                // Check for user
                if ($this->userModel->findUserByEmail($data['email']))
                {
                    // User found
                }
                else
                {
                    // User not found
                    $data['email_error'] = 'No user found';
                }
            }


            /**
             *
             * Make sure not exists any errors and [.._errors] fields are empty
             * Stop register if exists any errors
             *
             */
            if (empty($data['email_error']) && empty($data['password_error']))
            {
                // Validated the entered data
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser)
                {
                    // Create SESSION
                    $this->createLoggedInUserSession($loggedInUser);
                }
                else
                {
                    $data['password_error'] = 'Password incorrect';

                    $this->loadView('users/login', $data);
                }
            }
            else
            {
                // Load view with errors
                $this->loadView('users/login', $data);
            }

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

    /**
     * Create the user's SESSION
     *
     * Defined in view:
     *                If the user logged in, remove login and register buttons from navbar.
     *
     * @param mixed $user The user's data in DataBase
     */
    public function createLoggedInUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_username'] = $user->username;
        $_SESSION['user_email'] = $user->email;

        redirect('posts');
    }

    /**
     * Users is logout
     *
     * Remove SESSION
     * and
     * Redirect to login page
     *
     */
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_username']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }

}