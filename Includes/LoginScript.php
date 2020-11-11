<?php

$login = new LoginScript();

class LoginScript
{


    /**
     * LoginScript constructor.
     */
    public function __construct()
    {

        session_start();
        if (isset($_POST['signup'])) {

            header('location: ../signup.php?redirectFrom=loginForm');
            exit();

        } else if (isset($_POST['forgotPass'])) {

            header('location: ../forgotpass.html?redirectFrom=loginForm');
            exit();

        } else if (isset($_POST['login-proceed'])) {

            require 'DBConnect.php';

            $dbConn = new DBConn();

            $user = $_POST['login'];
            $pass = $_POST['password'];

            $this->isPrazdnyInput($user, $pass);



            $this->prihlasPouzivatela(($this->isLoginCorrect($dbConn->getConn(), $user)) , $pass );


        } else {
            header("");

        }

    }


    public function isPrazdnyInput(string $username, string $password) : void
    {
        if ( empty($username) || empty($password) ) {
            header('location: ../login.php?error=prazdnyInput');
            exit();
        }


    }

    public function isLoginCorrect(mysqli $connection, string $username) //Ak je login spravny funkcia najde hladany
        // riadok v databaze, inak vrati false
    {

        $sqlLoginCheck = "SELECT * FROM pouzivatelia WHERE loginPouzivatela = ? OR emailPouzivatela = ?;";


        $stmtLoginCheck = $connection->stmt_init();

        if (!$stmtLoginCheck->prepare($sqlLoginCheck))  //Ak doslo k nejakej chybe
        {
            header('location: ../index.php?error=stmtError');
            exit();
        }

        $stmtLoginCheck->bind_param("ss", $username, $username); //ss - String, String
        $stmtLoginCheck->execute();

        $resultData = $stmtLoginCheck->get_result();



        if ($vyslednyRiadok = $resultData->fetch_assoc()) //Ak dostaneme data z databazy - true , inak - false
        {
                return ($vyslednyRiadok);

        }
        else
        {
        $result = false;
        header('location: ../index.php?error=loginNotFound'); //Ak sme nenasli data v databaze vyhodime error
        return $result;
        }

    }

    public function prihlasPouzivatela(array $riadokZDB, string $password): void
    {

        //$hashPass = password_hash($password, PASSWORD_DEFAULT); //Defaultne Hashovanie Hesla.. Nakoniec netreba

        $passChecker = password_verify($password, $riadokZDB['passPouzivatela']);

        if ($passChecker == false)
        {
            header('location: ../index.php?error=zleHeslo');
            exit();

        }
        else
        {
            session_start();
            $_SESSION['userLogin'] = $riadokZDB['loginPouzivatela'];
            header('location: ../index.php?login=success');
            exit();
        }
    }

}