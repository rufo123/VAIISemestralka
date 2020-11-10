<?php

$signup = new SignupScript();

class SignupScript
{



    public function __construct()
    {

        if (isset($_POST['signup-proceed'])) {


            require 'DBConnect.php';

            $dbConn = new DBConn();





            $login = $_POST['login'];
            $email = $_POST['e-mail'];
            $pass = $_POST['password'];
            $repeatPass= $_POST['repeat-password'];


            $this->isPrazdnyInput($login, $email, $pass, $repeatPass);
            $this->isValidnyEmail($email, $login);
            $this->isValidnyLogin($email, $login);
            $this->isRovnakeHeslo($pass, $repeatPass, $login, $email);
            $this->isLoginUnique($dbConn->getConn(), $login);

            $this->vytvorPouzivatela($dbConn->getConn(), $login, $email, $pass);









        }



    }

    public function isPrazdnyInput(string $login, string $email, string $pass, string $repeatPass) : void
    {
        if ( empty($login) || empty($email) || empty($pass) || empty($repeatPass) ) {

            header('location: ../signup.html?error=prazdnyInput'); //Spolu s navratom na signup vratim aj error message, v tomto pripade
            exit();                                                      //Informujem pouzivatela o tom, ze nevyplnil nejake pole
        }

    }

    public function isValidnyEmail(string $email, string $login) : void
    {
        if (!filter_var( $email, FILTER_VALIDATE_EMAIL)){

            header('location: ../signup.html?error=zlyEmail&login=' . $login);
            exit();
        }

    }

    public function isValidnyLogin(string $email, string $login) : void
    {
        if (!preg_match('/^[a-zA-Z0-9_]*$/', $login)) {

            header('location ../signup.html?error=zlyLogin$email=' . $email);
            exit();

        }

    }

    public function isRovnakeHeslo(string $pass, string $repeatPass, string $login, string $email ) : void
    {
        if ($pass !== $repeatPass) {

            header('location ../signup.html?error=nezhodneHesla$email=' . $email . '$login' . $login);
            exit();

        }

    }

    public function isLoginUnique(mysqli $conn, string $login) : void
    {

        $sqlLogin = "SELECT * FROM pouzivatelia WHERE loginPouzivatela = ?;";


        $stmtSelectLogin = $conn->stmt_init();

        if (!$stmtSelectLogin->prepare($sqlLogin)) { //Ak doslo k nejakej chybe
            header('location: ../signup.html?error=stmtError');
            exit();
        }

        $stmtSelectLogin->bind_param("s", $login); //ss - String, String
        $stmtSelectLogin->execute();
        $stmtSelectLogin->store_result();
        $result = $stmtSelectLogin->num_rows();


        if ($result > 0) { //Ak je tam viac dat ako 0, to znamena ze taky login uz existuje

            header('location: ../signup.html?error=loginNotUnique');
            exit();

        }
        //Pridaj Aj mail

    }

    public function vytvorPouzivatela(mysqli $conn, string $login, string $email, string $pass) : void
    {

        $sql = 'INSERT INTO pouzivatelia (loginPouzivatela, emailPouzivatela, passPouzivatela) VALUES (?, ?, ?)';
        $stmtCreate = $conn->stmt_init();

        if (!$stmtCreate->prepare($sql)) { //Ak doslo k nejakej chybe
            header('location: ../signup.html?error=stmtError');
            exit();
        }

        $hashPass = password_hash($pass, PASSWORD_DEFAULT); //Hashovanie hesla

        $stmtCreate->bind_param('sss', $login, $email, $hashPass); //ss - String, String
        $stmtCreate->execute();
        $stmtCreate->close();
        header('location: ../signup.html?success=uspZareg');
        exit();
    }




}