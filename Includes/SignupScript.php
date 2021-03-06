<?php




class SignupScript
{


    /**
     * SignupScript constructor.
     */
    public function __construct()
    {

        if (isset($_POST['signup-proceed'])) {


            require 'DBConnect.php';

            $dbConn = new DBConn();

            $login = trim($_POST['login']);
            $email = trim($_POST['e-mail']);
            $pass = trim($_POST['password']);
            $repeatPass = trim($_POST['repeat-password']);


            $this->isPrazdnyInput($login, $email, $pass, $repeatPass);
            $this->isValidnyEmail($email, $login);
            $this->isValidLogin($email, $login);
            $this->isLoginUnique($dbConn->getInitConn(), 'login', $login, $login); //Overovanie loginu
            $this->isLoginUnique($dbConn->getInitConn(),'email', $email, $email); //Tu istu funkciu pouzijeme na overenie e-mailu
            $this->doesPassFulfilCriteria($pass, $login,$email);
            $this->isRovnakyPass($pass, $repeatPass, $login, $email);
            $this->vytvorPouzivatela($dbConn->getInitConn(), $login, $email, $pass);


        }


    }

    /**
     * @param string $login
     * @param string $email
     * @param string $pass
     * @param string $repeatPass
     */
    public function isPrazdnyInput(string $login, string $email, string $pass, string $repeatPass): void
    {
        if (empty($login) || empty($email) || empty($pass) || empty($repeatPass)) {

            header('location: ../signup.php?error=prazdnyInput'); //Spolu s navratom na signup vratim aj error message, v tomto pripade
            exit();                                                      //Informujem pouzivatela o tom, ze nevyplnil nejake pole
        }

    }

    /**
     * @param string $email
     * @param string $login
     */
    public function isValidnyEmail(string $email, string $login): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            header('location: ../signup.php?error=zlyEmail&login=' . $login);
            exit();
        }

    }

    /**
     * @param string $email
     * @param string $login
     */
    public function isValidLogin(string $email, string $login): void
    {
        if (!preg_match("/^[a-zA-Z0-9_]*$/",$login)) {

            header("location: ../signup.php?error=zlyLogin&e-mail=". $email);
            exit();
        }

    }

    /**
     * @param string $pass
     * @param string $repeatPass
     * @param string $login
     * @param string $email
     */
    public function isRovnakyPass(string $pass, string $repeatPass, string $login, string $email): void
    {
        if ($repeatPass !== $pass) {
            header("location: ../signup.php?error=nezhodneHesla&login=" . $login . "&e-mail=" . $email);
            exit();
        }
    }

    /**
     * @param mysqli $conn
     * @param string $typeOfInput
     * @param string $parEmail
     * @param string $login
     */
    public function isLoginUnique(mysqli $conn, string $typeOfInput, string $parEmail, string $login): void
    {

        $sqlUniqueCheck = "SELECT * FROM pouzivatelia WHERE loginPouzivatela = ? OR emailPouzivatela = ?;";

        $stmtSelectUnique = $conn->stmt_init();

        if (!$stmtSelectUnique->prepare($sqlUniqueCheck)) { //Ak doslo k nejakej chybe
            header('location: ../signup.php?error=stmtError');
            exit();
        }

        $stmtSelectUnique->bind_param("ss", $parEmail, $login); //ss - String, String
        $stmtSelectUnique->execute();
        $stmtSelectUnique->store_result();
        $result = $stmtSelectUnique->num_rows();


        if ($result > 0) { //Ak je tam viac dat ako 0, to znamena ze taky login uz existuje

            if ($typeOfInput == 'email') {
                header('location: ../signup.php?error=emailNotUnique&login=' . $login);
                exit();

            } else if ($typeOfInput == 'login') {
                header('location: ../signup.php?error=loginNotUnique&e-mail='. $parEmail);
                exit();

            }


        }

    }

    /**
     * @param string $pass
     * @param string $parLogin
     * @param string $parEmail
     */
    public function doesPassFulfilCriteria(string $pass, string $parLogin, string $parEmail): void
    {
        if (strlen($pass) < 8) { //Overovanie, ci heslo je dostatocne dlhe
            header('location: ../signup.php?error=passNotLongEnough&login='. $parLogin . '&e-mail=' . $parEmail);
            exit();
        }

        if (!preg_match("(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$)",$pass)) {
            header('location: ../signup.php?error=passNoRequiredCharacters&login='. $parLogin . '&e-mail=' . $parEmail);
            exit();
        }

    }

    /**
     * @param mysqli $conn
     * @param string $login
     * @param string $email
     * @param string $pass
     */
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
