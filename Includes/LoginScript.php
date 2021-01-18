<?php

$login = new LoginScript();

class LoginScript
{
    private string $returnURL;


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

            $user = trim($_POST['login']);
            $pass = trim($_POST['password']);

            $this->setURLOfPreviousPage();

            $this->isPrazdnyInput($user, $pass);

            $this->prihlasPouzivatela(($this->isLoginCorrect($dbConn->getInitConn(), $user)) , $pass );


        } else {
            header("");

        }

    }


    /**
     * @param string $username
     * @param string $password
     */
    public function isPrazdnyInput(string $username, string $password) : void
    {
        if ( empty($username) || empty($password) ) {
            header('location: ' . $this->getReturnURL() .'?error=prazdnyInput');
            exit();
        }


    }

    /**
     * @param mysqli $connection
     * @param string $username
     * @return array|false|null
     */
    public function isLoginCorrect(mysqli $connection, string $username) //Ak je login spravny funkcia najde hladany
        // riadok v databaze, inak vrati false
    {

        $sqlLoginCheck = "SELECT * FROM pouzivatelia WHERE loginPouzivatela = ? OR emailPouzivatela = ?;";


        $stmtLoginCheck = $connection->stmt_init();

        if (!$stmtLoginCheck->prepare($sqlLoginCheck))  //Ak doslo k nejakej chybe
        {
            header('location: ' . $this->getReturnURL() .'?error=stmtError');
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
            header('location: ' . $this->getReturnURL() .'?error=loginNotFound'); //Ak sme nenasli data v databaze vyhodime error
        return $result;
        }

    }

    /**
     * @param array $riadokZDB
     * @param string $password
     */
    public function prihlasPouzivatela(array $riadokZDB, string $password): void
    {

        //$hashPass = password_hash($password, PASSWORD_DEFAULT); //Defaultne Hashovanie Hesla.. Nakoniec netreba

        $passChecker = password_verify($password, $riadokZDB['passPouzivatela']);

        if ($passChecker == false)
        {
            header('location: ' . $this->getReturnURL() .'?error=zleHeslo');
            exit();

        }
        else
        {
            session_start();
            $_SESSION['idUser'] = $riadokZDB['idPouzivatela'];
            $_SESSION['userLogin'] = $riadokZDB['loginPouzivatela'];
            $_SESSION['isAdmin'] = $riadokZDB['isAdmin'];
            header('location: ' . $this->getReturnURL() .'?login=success');
            exit();
        }
    }

    /**
     *
     */
    public function setURLOfPreviousPage(){
        $currentPageURL = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        $escapedCurrentPageURL = htmlspecialchars($currentPageURL, ENT_QUOTES, 'UTF-8');
        $previousPageURL = $_SERVER['HTTP_REFERER'];
        $escapedPreviousPageURL = htmlspecialchars($previousPageURL, ENT_QUOTES, 'UTF-8');

        if ($escapedCurrentPageURL !== $escapedPreviousPageURL) {
            $urlWithoutExtraOutput = explode("?", $escapedPreviousPageURL);
            $this->returnURL = $urlWithoutExtraOutput[0];
        } else {
            $this->returnURL = "../index.php";
        }


    }

    /**
     * @return string
     */
    public function getReturnURL(): string
    {
        return $this->returnURL;
    }


}