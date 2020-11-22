<?php




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
            $repeatPass = $_POST['repeat-password'];


            $this->isPrazdnyInput($login, $email, $pass, $repeatPass);
            $this->isValidnyEmail($email, $login);
            $this->isValidnyLogin($email, $login);
            $this->isLoginUnique($dbConn->getInitConn(), $login);
            $this->doesPassFulfilCriteria($pass, $login,$email);
            $this->isRovnakyPass($pass, $repeatPass, $login, $email);
            $this->vytvorPouzivatela($dbConn->getInitConn(), $login, $email, $pass);


        }


    }

    public function isPrazdnyInput(string $login, string $email, string $pass, string $repeatPass): void
    {
        if (empty($login) || empty($email) || empty($pass) || empty($repeatPass)) {

            header('location: ../signup.php?error=prazdnyInput'); //Spolu s navratom na signup vratim aj error message, v tomto pripade
            exit();                                                      //Informujem pouzivatela o tom, ze nevyplnil nejake pole
        }

    }

    public function isValidnyEmail(string $email, string $login): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            header('location: ../signup.php?error=zlyEmail&login=' . $login);
            exit();
        }

    }

    public function isValidnyLogin(string $email, string $login): void
    {
        if (!preg_match("(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$)", $login)) {

            header('location ../signup.php?error=zlyLogin&e-mail=' . $email);
            exit();

        }

    }

    public function isRovnakyPass(string $pass, string $repeatPass, string $login, string $email): void
    {
        if ($repeatPass !== $pass) {
            header("location: ../signup.php?error=nezhodneHesla&login=" . $login . "&e-mail=" . $email);
            exit();
        }
    }

    public function isLoginUnique(mysqli $conn, string $login): void
    {

        $sqlUniqueCheck = "SELECT * FROM pouzivatelia WHERE loginPouzivatela = ?;";

        $stmtSelectUnique = $conn->stmt_init();

        if (!$stmtSelectUnique->prepare($sqlUniqueCheck)) { //Ak doslo k nejakej chybe
            header('location: ../signup.php?error=stmtError');
            exit();
        }

        $stmtSelectUnique->bind_param("s", $login); //ss - String, String
        $stmtSelectUnique->execute();
        $stmtSelectUnique->store_result();
        $result = $stmtSelectUnique->num_rows();


        if ($result > 0) { //Ak je tam viac dat ako 0, to znamena ze taky login uz existuje

            header('location: ../signup.php?error=loginNotUnique');
            exit();

        }

    }

    public function doesPassFulfilCriteria(string $pass, string $parLogin, string $parEmail): void
    {
        if (strlen($pass) < 8) { //Overovanie, ci heslo je dostatocne dlhe
            header('location: ../signup.php?error=passNotLongEnough&login='. $parLogin . '&e-mail=' . $parEmail);
            exit();
        }

        if (!preg_match("/^[a-zA-Z0-9_]*$/", $pass)) { // 0-9 | a-z | A-Z | length from 8-30
            header('location: ../signup.php?error=passNoRequiredCharacters&login='. $parLogin . '&e-mail=' . $parEmail);
            exit();
        }

    }

    public function vytvorPouzivatela(mysqli $conn, string $login, string $email, string $pass) : void
    {

        $sqlPouzivatelia = 'INSERT INTO pouzivatelia (loginPouzivatela, emailPouzivatela, passPouzivatela) VALUES (?, ?, ?)';

        $sqlSelectID = 'INSERT INTO profile_data ( idUser ) 
                        SELECT idPouzivatela 
                        FROM pouzivatelia
                        WHERE loginPouzivatela = ?';


        $stmtPouzivateliaCreate = $conn->stmt_init();

        if (!$stmtPouzivateliaCreate->prepare($sqlPouzivatelia)) { //Ak doslo k nejakej chybe
            header('location: ../signup.php?error=stmtErrorPouzivateliaCreate');
            exit();
        }

        $hashPass = password_hash($pass, PASSWORD_DEFAULT); //Hashovanie hesla

        $stmtPouzivateliaCreate->bind_param('sss', $login, $email, $hashPass); //ss - String, String
        $stmtPouzivateliaCreate->execute();
        $stmtPouzivateliaCreate->close();

        $stmtSelectID = $conn->stmt_init();

        if (!$stmtSelectID->prepare($sqlSelectID)) {
            header('location: ../signup.php?error=stmtErrorSelectID');
            exit();
        }
        $stmtSelectID->bind_param('s', $login); //s - String
        $stmtSelectID->execute();
        $stmtSelectID->close();


        header('location: ../signup.php?success=uspZareg');
        exit();
    }




}

$signup = new SignupScript();
