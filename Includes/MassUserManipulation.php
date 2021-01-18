<?php


class MassUserManipulation
{

    private DBConn $dbConnect;

    /**
     * @return DBConn
     */
    public function getDbConnect(): DBConn
    {
        return $this->dbConnect;
    }

    /**
     * @param DBConn $dbConnect
     */
    public function setDbConnect(DBConn $dbConnect): void
    {
        $this->dbConnect = $dbConnect;
    }


    /**
     * MassUserManipulation constructor.
     */
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) { //Ak este Session nie je startnuta
            session_start();
        }

        require_once 'DBConnect.php';

        $this->dbConn = new DBConn();


        if (isset($_SESSION['userLogin']) && isset($_SESSION['idUser'])) {
            $this->setDbConnect($this->dbConn);

        } else {
            header('location: ../index.php?error=accessDenied');
            exit();

        }

    }

    /**
     * @param mysqli $parConn
     * @return int
     */

    public function getUserCount(): int
    {
        $sqlGetUsers = 'SELECT idUser FROM profile_data';
        $stmtGetUsers = (($this->getDbConnect())->getInitConn())->stmt_init();


        if (!$stmtGetUsers->prepare($sqlGetUsers)) { //Ak doslo k nejakej chybe
            return -1;
        }


        $stmtGetUsers->execute();
        $stmtGetUsers->store_result();
        $tmpUserCount = $stmtGetUsers->num_rows();
        $stmtGetUsers->close();

        return $tmpUserCount;
    }

    /**
     * @param int $parRowNumber
     * @return int
     */

    public function getUserIdByRow(int $parRowNumber): int
    {
        $sqlGetRows = 'SELECT idUser FROM profile_data LIMIT ?,1';
        $stmtGetRows = (($this->getDbConnect())->getInitConn())->stmt_init();


        if (!$stmtGetRows->prepare($sqlGetRows)) { //Ak doslo k nejakej chybe
            return -1;
        }
        $stmtGetRows->bind_param('i', $parRowNumber); //ss - NaCoZmenit - IdUsera
        $stmtGetRows->execute();
        $tmpResultID = $stmtGetRows->get_result();


        if ($resultDataFromDB = $tmpResultID->fetch_assoc())
        {
            $tmpWhatToReturn = $resultDataFromDB['idUser'];
        }
        else
        {
            $tmpWhatToReturn = -1;

        }
        $stmtGetRows->close();
        return $tmpWhatToReturn;

    }

    /**
     * @param string $parIDPouzivatela
     * @param int $parMakeAdmin
     */
    public function setAdminStatus(string $parIDPouzivatela, int $parMakeAdmin) : void {

        $sqlUpdateAdmin = 'UPDATE pouzivatelia SET isAdmin = ? WHERE idPouzivatela = ?';
        $stmtUpdateAdmin = (($this->getDbConnect())->getInitConn())->stmt_init();


        if (!$stmtUpdateAdmin->prepare($sqlUpdateAdmin)) { //Ak doslo k nejakej chybe
            header('location: ../index.php?error=stmtError');
            exit();
        }
        


        $stmtUpdateAdmin->bind_param('ss', $parMakeAdmin, $parIDPouzivatela); //ss
        $stmtUpdateAdmin->execute();
        $stmtUpdateAdmin->close();
        //Kedze sme uspesne zmenili pouzivatelsky login, treba ho zmenit aj v session

        exit();
    }






}