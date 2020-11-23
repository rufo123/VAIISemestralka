<?php


require_once "../includes/ViewProfileData.php";

class ChangeProfileData extends ViewProfileData
{

    private DBConn $dbConn;



    /**
     * ChangeProfileData constructor.
     */
    public function __construct()
    {
       parent::__construct();



        if (isset($_SESSION['userLogin']) && isset($_SESSION['idUser']))
        {

            $newDBConnect = new DBConn();
            $this->setDbConn($newDBConnect);

            $this->changeDataByInput(); //Interna logika zmeny jednotlivych poli



        } else {
            header("location ../profile.php?error=noSessionFound");
            exit();

        }

    }


    /**
     * @return DBConn
     */
    public function getDbConn(): DBConn
    {
        return $this->dbConn;
    }

    /**
     * @param DBConn $dbConn
     */
    public function setDbConn(DBConn $dbConn): void
    {
        $this->dbConn = $dbConn;
    }


    public function checkIfColEmpty(string $parNameOfCol) : bool
    {
        if (empty($parNameOfCol)) {
            header('location: ../profile.php?error=emptyInput');
            exit();
        } else {
            return false;
        }



    }

    public function passRequiredChar(string $parPass)
    {
        if (strlen($parPass) < 8) { //Overovanie, ci heslo je dostatocne dlhe
            header('location: ../profile.php?error=passNotLongEnough');
            exit();
        }

        if (!preg_match("(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$)",$parPass)) { // 0-9 | a-z | A-Z
            header('location: ../profile.php?error=passNoRequiredCharacters');
            exit();
        }
    }


    public function changeUserName(string $parChangeToWhat, mysqli $parConn, string $idUser) {

        $this->isLoginUnique($parConn, $parChangeToWhat, "login");



        $sqlChange = 'UPDATE pouzivatelia SET loginPouzivatela = ? WHERE idPouzivatela = ?';
        $stmtUsernameChange = $parConn->stmt_init();


        if (!$stmtUsernameChange->prepare($sqlChange)) { //Ak doslo k nejakej chybe
            header('location: ../profile.php?error=stmtErrorUpdateUsername');
            exit();
        }

        $stmtUsernameChange->bind_param('ss', $parChangeToWhat, $idUser); //ss - NaCoZmenit - IdUsera
        $stmtUsernameChange->execute();
        $stmtUsernameChange->close();
        //Kedze sme uspesne zmenili pouzivatelsky login, treba ho zmenit aj v session

        $_SESSION['userLogin'] = $parChangeToWhat;
        header('location: ../profile.php?success=uspChangedUsername');
        exit();

    }

    public function isLoginUnique(mysqli $conn, string $loginORemail, string $typeOfInput) : void
    {
        if ($typeOfInput == "email") {

            $sqlUniqueCheck = "SELECT * FROM pouzivatelia WHERE emailPouzivatela = ?;";
        } else if ($typeOfInput == "login") {
            $sqlUniqueCheck = "SELECT * FROM pouzivatelia WHERE loginPouzivatela = ?;";
        } else {
            header('location: ../profile.php?systemError=isLoginUniqueBADTYPE');
            exit();
        }



        $stmtSelectUnique = $conn->stmt_init();

        if (!$stmtSelectUnique->prepare($sqlUniqueCheck)) { //Ak doslo k nejakej chybe
            header('location: ../profile.php?error=stmtError');
            exit();
        }

        $stmtSelectUnique->bind_param("s", $loginORemail); //ss - String, String
        $stmtSelectUnique->execute();
        $stmtSelectUnique->store_result();
        $result = $stmtSelectUnique->num_rows();


        if ($result > 0) { //Ak je tam viac dat ako 0, to znamena ze taky login uz existuje

            header('location: ../profile.php?error='.$typeOfInput.'NotUnique');
            exit();

        }

    }


    public function changeProfileRow(string $changedRow, mysqli $parConn, string $idUser, string $nameOfDBCol) {

        if ($nameOfDBCol == "userFirstName") {
            $sqlRowChange = "UPDATE profile_data SET userFirstName = ? WHERE idUser = ?";
        } else if ($nameOfDBCol == "userLastName") {
            $sqlRowChange = "    UPDATE profile_data SET userLastName = ? WHERE idUser = ?";
        } else {
            header('location: ../profile.php?systemError=changeProfileRowBADCOLL');
            exit();

        }



        $stmtProfileRowChange = $parConn->stmt_init();


        if (!$stmtProfileRowChange->prepare($sqlRowChange)) { //Ak doslo k nejakej chybe
            header('location: ../profile.php?error=stmtError');
            exit();
        }

        $stmtProfileRowChange->bind_param('ss',$changedRow, $idUser); //ss - NaCoZmenit - IdUsera
        $stmtProfileRowChange->execute();
        $stmtProfileRowChange->close();
        //Kedze sme uspesne zmenili pouzivatelsky login, treba ho zmenit aj v session

        header('location: ../profile.php?success=uspChangedRow');
        exit();

    }


    public function changeEmail(string $changedMail, mysqli $parConn, string $idUser)
    {
        $this->isLoginUnique($parConn, $changedMail, "email");

        $sqlEmailChange = 'UPDATE pouzivatelia SET emailPouzivatela = ? WHERE idPouzivatela = ?';

        $stmtEmailChange = $parConn->stmt_init();

        if (!$stmtEmailChange->prepare($sqlEmailChange)) { //Ak doslo k nejakej chybe
            header('location: ../profile.php?error=stmtErrorEmailCheck');
            exit();
        }

        $stmtEmailChange->bind_param("ss", $changedMail, $idUser); //ss - String, String
        $stmtEmailChange->execute();
        $stmtEmailChange->close();

        header('location: ../profile.php?success=uspChangedEmail');
        exit();

    }

    public function changePass(mysqli $parConnection, string $parPassword, string $parRepeatPass, string $idUser) {


        if ($parPassword !== $parRepeatPass) {
            header('location: ../profile.php?error=passwordNotEquals');
            exit();
        } else {

            $this->passRequiredChar($parPassword); //Overujeme, ci ma heslo potrebne znaky

            $sqlPasswordChange = 'UPDATE pouzivatelia SET passPouzivatela = ? WHERE idPouzivatela = ?';
            $stmtPasswordChange = $parConnection->stmt_init();

            if (!$stmtPasswordChange->prepare($sqlPasswordChange)) { //Ak doslo k nejakej chybe
                header('location: ../profile.php?error=stmtErrorPassword');
                exit();
            }

            $hashedPassword = password_hash($parPassword, PASSWORD_DEFAULT); //Hashovanie hesla

            $stmtPasswordChange->bind_param("ss", $hashedPassword, $idUser); //ss - String, String
            $stmtPasswordChange->execute();
            $stmtPasswordChange->close();

            header('location: ../profile.php?success=uspChangePass');
            exit();

        }


    }



    public function changeDataByInput() {
        if (isset($_POST['changeUserProceed']))
        {

            $changedUsername = trim($_POST['changeUserShow']); //Meno premmennej, ktora je input na to co sa ma zmenit

            if ($this->checkIfColEmpty($changedUsername))  //Kontrolujeme ak sme submitli zmenu Username
            {
                header("location ../profile.php?error=UsernameEmpty");
                exit();
            }
            else
            {
                $this->changeUserName($changedUsername, $this->getDbConn()->getInitConn(),$_SESSION['idUser']);
            }


        } else if (isset($_POST['changeNameProceed'])) { //Kontrolujeme ak sme submitli zmenu Mena

            $changedName = trim($_POST['changeNameShow']); //Meno premmennej, ktora je input na to co sa ma zmenit

            if ($this->checkIfColEmpty($changedName))
            {
                header("location ../profile.php?error=NameEmpty");
                exit();
            }
            else
            {
                $this->changeProfileRow($changedName, $this->getDbConn()->getInitConn(), $_SESSION['idUser'], "userFirstName");

            }



        } else if (isset($_POST['changeSurnameProceed'])) { //Kontrolujeme ak sme submitli zmenu Priezviska

            $changedSurname = trim($_POST['changeSurnameShow']);

            if ($this->checkIfColEmpty($changedSurname))
            {
                header("location ../profile.php?error=SurnameEmpty");
                exit();

            } else
            {
                $this->changeProfileRow($changedSurname, $this->getDbConn()->getInitConn(), $_SESSION['idUser'], "userLastName");

            }

        } else if (isset($_POST['changeEmailProceed'])) { //Kontrolujeme ak sme submitli zmenu Priezviska

            $changedEmail = trim($_POST['changeEmailShow']);

            if ($this->checkIfColEmpty($changedEmail))
            {
                header("location ../profile.php?error=EmailEmpty");
                exit();

            } else
            {

                $this->changeEmail($changedEmail, $this->getDbConn()->getInitConn(), $_SESSION['idUser'] );

            }

        } else if (isset($_POST['changePassSubmit'])) { //Kontrolujeme ak sme submitli zmenu Hesla

            $changePass = trim($_POST['changePassShow']);
            $changeRepeatPass = trim($_POST['changeRepeatPassShow']);




            if ($this->checkIfColEmpty($changePass) || $this->checkIfColEmpty($changeRepeatPass))
            {
                header("location ../profile.php?error=passFieldEmpty");
                exit();

            } else
            {
                $this->changePass($this->getDbConn()->getInitConn(), $changePass, $changeRepeatPass, $_SESSION['idUser'] );
            }


        }
    }







}

$changeProfileData = new ChangeProfileData();