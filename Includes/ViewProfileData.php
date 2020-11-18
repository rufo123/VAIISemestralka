<?php

require "includes/DBConnect.php";

class ViewProfileData
{
    private DBConn $dbConn;
    private string $userLogin;
    private string $userFirstName;
    private string $userLastName;
    private string $userEmail;

    public function __construct()
    {
        session_start();
        $this->dbConn  = new DBConn();


        if (isset($_SESSION['idUser'])) {
            $this->initialiseProfileVariables($_SESSION['idUser']);
        }
        else
        {
        header('location: ../index.php?notLoggedIN');
        exit();
        }


    }

    public function selectProfileData(string $idUser) {
        $sqlProfileSelectData =
            " SELECT po.idPouzivatela, po.loginPouzivatela,
              po.emailPouzivatela, po.passPouzivatela, 
              pd.avatarID, pd.userFirstName, 
              pd.userLastName 
              FROM pouzivatelia po
              JOIN profile_data pd
              ON (po.idPouzivatela = pd.idUser)
              WHERE po.idPouzivatela = ?;"; //Je to dlhe pretoze chcem tieto specificke stlpce


        $dbInitConn = $this->dbConn->getInitConn();


        if ($dbInitConn == NULL) {
            header('location: ../index.php?DBIncludeError');
            exit();
        }

        $stmtSelectProfileData = $dbInitConn->stmt_init();

        if (!($stmtSelectProfileData->prepare($sqlProfileSelectData)))  //Ak doslo k nejakej chybe
        {
            header('location: ../index.php?error=profileStmtError');
            exit();
        }


        $stmtSelectProfileData->bind_param("s", $idUser); //s - String
        $stmtSelectProfileData->execute();
        $resultData = $stmtSelectProfileData->get_result();

        if ($resultDataFromDB = $resultData->fetch_assoc()) //Priradime si data z DB do vysledneData a ak to prebehlo dobre vrati true
        {
            return $resultDataFromDB;
        }
        else
        {
            $resultData = false;
            // header('location: ../index.php?error=noLoginFound'); //Ak nebol najdeny dany login hodim false a presmeruje nas naspat
            return $resultData;

        }



    }

    public function initialiseProfileVariables(string $idUser) {
        $arrayUserDataFromDB= $this->selectProfileData($idUser);
        $this->setUserLogin($arrayUserDataFromDB["loginPouzivatela"]);
        $this->setUserFirstName($arrayUserDataFromDB["userFirstName"]);
        $this->setUserLastName($arrayUserDataFromDB["userLastName"]);
        $this->setUserEmail($arrayUserDataFromDB["emailPouzivatela"]);
    }




    //Uz len Gettery a Settery

    /**
     * @return string
     */
    public function getUserLogin(): string
    {
        return $this->userLogin;
    }

    /**
     * @param string $userLogin
     */
    protected function setUserLogin(string $userLogin): void
    {
        $this->userLogin = $userLogin;
    }

    /**
     * @return string
     */
    public function getUserFirstName(): string
    {
        return $this->userFirstName;
    }

    /**
     * @param string $userFirstName
     */
    protected function setUserFirstName(string $userFirstName): void
    {
        $this->userFirstName = $userFirstName;
    }

    /**
     * @return string
     */
    public function getUserLastName(): string
    {
        return $this->userLastName;
    }

    /**
     * @param string $userLastName
     */
    protected function setUserLastName(string $userLastName): void
    {
        $this->userLastName = $userLastName;
    }

    /**
     * @return string
     */
    public function getUserEmail(): string
    {
        return $this->userEmail;
    }

    /**
     * @param string $userEmail
     */
    protected function setUserEmail(string $userEmail): void
    {
        $this->userEmail = $userEmail;
    }


}