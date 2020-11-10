<?php

$login = new LoginScript();

class LoginScript
{

    /**
     * LoginScript constructor.
     */
    public function __construct()
    {
        if (isset($_POST['signup'])) {

            header('location: ../signup.html?redirectFrom=loginForm');
            exit();

        } else if (isset($_POST['forgotPass'])) {

            header('location: ../forgotpass.html?redirectFrom=loginForm');
            exit();

        } else if (isset($_POST['login-proceed'])) {



        } else {
            header("");

        }

    }
}