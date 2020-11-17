<?php

$profileData = new ChangeProfileData();

class ChangeProfileData
{

    private DBConn $dbConn;



    /**
     * ChangeProfileData constructor.
     */
    public function __construct()
    {

        session_start();

        if (isset($_SESSION['userLogin'] ))
        {
            require 'DBConnect.php';

            $newDBConnect = new DBConn();
            $this->setDbConn($newDBConnect);

            $this->changeDataByInput(); //Interna logika zmeny jednotlivych poli



        } else {
            header("location ../index.php?error=noSessionFound");
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

    public function selectPouzivateliaData(DBConn $parDBConn, string $parUsername)
    {
        $sqlUserData = "SELECT * FROM pouzivatelia WHERE loginPouzivatela = ?;";
        return $this->workWithPreparedStatement($parDBConn, $sqlUserData, $parUsername);

    }

    public function selectProfileData(DBConn $parDBConn, string $parIDUser)
    {
        $sqlProfileData =  "SELECT * 
                            FROM pouzivatelia JOIN profile_data
                            ON (idPouzivatela = idUser)
                            WHERE idPouzivatela = ?;";

        return $this->workWithPreparedStatement($parDBConn, $sqlProfileData, $parIDUser);

    }


    public function workWithPreparedStatement(DBConn $parDBConn, string $parSQL, string $parString) {

        $insideDB = $parDBConn->getInitConn();
        $stmtProfileData = $insideDB->stmt_init();

        if (!$stmtProfileData->prepare($parSQL))  //Ak doslo k nejakej chybe
        {
            header('location: ../index.php?error=profileStmtError');
            exit();
        }


        $stmtProfileData->bind_param("s", $parString); //s - String
        $stmtProfileData->execute();
        $resultData = $stmtProfileData->get_result();

        if ($vysledneDataZDB = $resultData->fetch_assoc()) //Priradime si data z DB do vysledneData a ak to prebehlo dobre vrati true
        {
            return $vysledneDataZDB;
        }
        else
        {
            $resultData = false;
           // header('location: ../index.php?error=noLoginFound'); //Ak nebol najdeny dany login hodim false a presmeruje nas naspat
            return $resultData;

        }


    }




    public function getIDUser(array $parDBProfileDataArray) : string
    {
        if ($parDBProfileDataArray !== NULL) {
            if ($userID = $parDBProfileDataArray["idPouzivatela"]) {

                return $userID;

            } else {

                $resultID = false;
                header('location: ../index.php?error=noIDFound'); //Ak sa nenaslo priradene ID k  loginu (Nemalo by sa stat)
                return $resultID;

            }

        } else {
            return false;
        }

    }

    public function getEmailUser(array $parDBProfileDataArray) : string
    {
        if ($parDBProfileDataArray !== NULL) {

            if ($emailUser = $parDBProfileDataArray["emailPouzivatela"]) {

                return $emailUser;

            } else {

                $emailUser = false;
                header('location: ../index.php?error=noEmailFound'); //Ak sa nenasiel priradeny Email k  loginu (Nemalo by sa stat)
                return $emailUser;

            }

        } else {

            return false;
        }
    }

    public function getUserLogin(array $parDBProfileDataArray){

        // return $_SESSION['userLogin']; //Toto nemozeme pouzit, pretoze niekedy sa pouzivatel prihlasuje emailom inokedy loginom..

        if ($parDBProfileDataArray !== NULL) {

            if ($loginUser = $parDBProfileDataArray["loginPouzivatela"]) {

                return $loginUser;

            } else {

                $loginUser = false;
                header('location: ../index.php?error=noLoginUserFound'); //Ak sa nenasiel priradeny Email k  loginu (Nemalo by sa stat)
                return $loginUser;

            }

        } else {
            return false;

        }

    }

    public function getFirstName( array $parDBProfileDataArray) : string
    {
        if ($parDBProfileDataArray !== NULL) {

            if ($firstNameOfUser = $parDBProfileDataArray["userFirstName"]) { //Tu si priradime obsah FirstNamu

                    return $firstNameOfUser;


            } else {

                    return "Meno pouzivatela zatial nezadane";

            }

        } else {
            return false;

        }
    }

    public function getLastName( array $parDBProfileDataArray) : string
    {
        if ($parDBProfileDataArray !== NULL) {

            if ($firstNameOfUser = $parDBProfileDataArray["userLastName"]) { //Tu si priradime obsah FirstNamu

                return $firstNameOfUser;


            } else {

                return "Priezvisko pouzivatela zatial nezadane";

            }

        } else {
            return false;

        }
    }


    public function getUserLoggedWithAs(){

        if (isset($_SESSION['userLogin'] ))
        {
            return $_SESSION['userLogin'];

        } else {
            return false;

        }
    }

    public function checkIfColEmpty(string $parNameOfCol) : bool
    {
        if (empty($parNameOfCol)) {
            header('location: ../profile.php?success=emptyInput');
            exit();
        } else {
            return false;
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

        session_start();
        session_unset();
        session_destroy();
        session_start();

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
            header('location: ../profile.php?error=isLoginUniqueBADTYPE');
            exit();
        }



        $stmtSelectUnique = $conn->stmt_init();

        if (!$stmtSelectUnique->prepare($sqlUniqueCheck)) { //Ak doslo k nejakej chybe
            header('location: ../signup.php?error=stmtError');
            exit();
        }

        $stmtSelectUnique->bind_param("s", $loginORemail); //ss - String, String
        $stmtSelectUnique->execute();
        $stmtSelectUnique->store_result();
        $result = $stmtSelectUnique->num_rows();


        if ($result > 0) { //Ak je tam viac dat ako 0, to znamena ze taky login uz existuje

            header('location: ../login.php?error=loginOrEmailNotUnique');
            exit();

        }

    }

    public function changeProfileRow(string $changedRow, mysqli $parConn, string $idUser, string $nameOfDBCol) {

        if ($nameOfDBCol == "userFirstName") {
            $sqlRowChange = "UPDATE profile_data SET userFirstName = ? WHERE idUser = ?";
        } else if ($nameOfDBCol == "userLastName") {
            $sqlRowChange = "    UPDATE profile_data SET userLastName = ? WHERE idUser = ?";
        } else {
            header('location: ../profile.php?error=changeProfileRowBADCOLL');
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
            header('location: ../signup.php?error=stmtErrorEmailCheck');
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

            $sqlPasswordChange = 'UPDATE pouzivatelia SET passPouzivatela = ? WHERE idPouzivatela = ?';
            $stmtPasswordChange = $parConnection->stmt_init();

            if (!$stmtPasswordChange->prepare($sqlPasswordChange)) { //Ak doslo k nejakej chybe
                header('location: ../profile.php?error=stmtErrorPassword');
                exit();
            }

            if ($parPassword !== $parRepeatPass) {
                header('location: ../profile.php?error=passwordNotEquals');
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

            $changedUsername = $_POST['changeUserShow']; //Meno premmennej, ktora je input na to co sa ma zmenit

            if ($this->checkIfColEmpty($changedUsername))  //Kontrolujeme ak sme submitli zmenu Username
            {
                header("location ../profile.php?error=UsernameEmpty");
                exit();
            }
            else
            {
                $arrayWithDataFromPouzivatelia = $this->selectPouzivateliaData($this->getDbConn(), $this->getUserLoggedWithAs());
                $this->changeUserName($changedUsername, $this->getDbConn()->getInitConn(),$this->getIDUser($arrayWithDataFromPouzivatelia) );
            }


        } else if (isset($_POST['changeNameProceed'])) { //Kontrolujeme ak sme submitli zmenu Mena

            $changedName = $_POST['changeNameShow']; //Meno premmennej, ktora je input na to co sa ma zmenit

            if ($this->checkIfColEmpty($changedName))
            {
                header("location ../profile.php?error=NameEmpty");
                exit();
            }
            else
            {
                $arrayWithDataFromProfileData = $this->selectPouzivateliaData($this->getDbConn(), $this->getUserLoggedWithAs());
                $this->changeProfileRow($changedName, $this->getDbConn()->getInitConn(), $this->getIDUser($arrayWithDataFromProfileData), "userFirstName");

            }



        } else if (isset($_POST['changeSurnameProceed'])) { //Kontrolujeme ak sme submitli zmenu Priezviska

            $changedSurname = $_POST['changeSurnameShow'];

            if ($this->checkIfColEmpty($changedSurname))
            {
                header("location ../profile.php?error=SurnameEmpty");
                exit();

            } else
            {
                $arrayWithDataFromProfileData = $this->selectPouzivateliaData($this->getDbConn(), $this->getUserLoggedWithAs());
                $this->changeProfileRow($changedSurname, $this->getDbConn()->getInitConn(), $this->getIDUser($arrayWithDataFromProfileData), "userLastName");

            }

        } else if (isset($_POST['changeEmailProceed'])) { //Kontrolujeme ak sme submitli zmenu Priezviska

            $changedEmail = $_POST['changeEmailShow'];

            if ($this->checkIfColEmpty($changedEmail))
            {
                header("location ../profile.php?error=EmailEmpty");
                exit();

            } else
            {
                $arrayWithDataFromPouzivatelia = $this->selectPouzivateliaData($this->getDbConn(), $this->getUserLoggedWithAs());
                $this->changeEmail($changedEmail, $this->getDbConn()->getInitConn(),$this->getIDUser($arrayWithDataFromPouzivatelia) );

            }

        } else if (isset($_POST['changePassSubmit'])) { //Kontrolujeme ak sme submitli zmenu Priezviska

            $changePass = $_POST['changePassShow'];
            $changeRepeatPass = $_POST['changeRepeatPassShow'];

            if ($this->checkIfColEmpty($changePass) || $this->checkIfColEmpty($changeRepeatPass))
            {
                header("location ../profile.php?error=passFieldEmpty");
                exit();

            } else
            {
                $arrayWithDataFromPouzivatelia = $this->selectPouzivateliaData($this->getDbConn(), $this->getUserLoggedWithAs());
                $this->changePass($this->getDbConn()->getInitConn(), $changePass, $changeRepeatPass,$this->getIDUser($arrayWithDataFromPouzivatelia) );
            }


        }
    }







}