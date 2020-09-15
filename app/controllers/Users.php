<?php

class Users extends Controller {
    function __construct()
    {
        $this->userModel = $this->model('User');
    }

    // Register
    function register() {
        // Check For Post.
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form.
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
             // Init data.
             $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' =>''
            ];

            // Validate Name.
            if(empty($data['name'])) {
                $data['name_err'] = 'Please enter your name';
            } else if (strlen($data['name']) < 3) {
                $data['name_err'] = 'Your name must be at least 3 characters';
            }


            // Validate Email.
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter your email';
            } else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Your email is not valid';
            } else if($this->userModel->findUserByemail($data['email'])) {
                $data['email_err'] = 'This email is already registered';
            }

            // Validate  password.
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter a password';
            } else if(strlen($data['password']) < 6) {
                $data['password_err'] = 'Your password must be at least 6 characters';
            }

            // validate confirm_password
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm your password';
            } else if($data['confirm_password'] !== $data['password']) {
                $data['confirm_password_err'] = 'Passwords don\'t match'; 
            }

            //  Makesure errors are empty.
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                $this->userModel->register($data);

                 // flash message
                 flash('success_message', 'You\'re registered and can log in');

                // redirect to login page
                redirect('users/login');
                
            }
        } else {
            // Init data.
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' =>''
            ];

        }
            // Load view.
            $this->view('users/register', $data);
    }


    // Login
    function login() {
         // Check For Post.
         if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form.
            // Init data.
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email.
            if(empty($data['email'])) {
                $data['email_err'] = 'Please enter your email';
            } else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Your email is not valid';
            }
            
            // check for user/email
            else if($this->userModel->findUserByEmail($data['email'])) {
                // Validated.
                // Found

            } else {
                // Not Found
                $data['email_err'] = 'No user found';
            }

            // Validate  password.
            if(empty($data['password'])) {
                $data['password_err'] = 'Please enter a password';
            } else if(strlen($data['password']) < 6) {
                $data['password_err'] = 'Your password must be at least 6 characters';
            }

            if(empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser) {
                    // Create Session.
                    $this->createUserSession($loggedInUser);
                    
                } else {
                    $data['password_err'] = 'Password Incorrect';
                }
            } else {
                // Load view.
                $this->view('users/login', $data);
            }
        } else {
            // Init data.
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];    
        }

        // Load view.
        $this->view('users/login', $data);
    }

    function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        // redirect to posts index.
        redirect('posts');
    }

    function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();

          // redirect to posts index.
          redirect('pages');
    }

}