<?php

$logout = new LogoutScript();

class LogoutScript
{


    /**
     * LogoutScript constructor.
     */
    public function __construct()
    {
            $this->destroySession();
    }

    /**
     *
     */
    public function destroySession() : void
    {
        session_start();
        session_unset();
        session_destroy();
        header('location: ../index.php?success=loggedOut');
        exit();

    }
}