<?php


class DBConn
{
    private string $aServerName = 'localhost';
    private string $aDBlogin = 'semvaidbmanager';
    private string $aDBpass = 'GaRdaqQ78';
    private string $aDBmeno = 'vaisemestralka';
    private mysqli $conn;

    public function __construct() {



        $this->setConn(new mysqli($this->getAServerName(), $this->getADBlogin(), $this->getADBpass(), $this->getADBmeno()));
        $conn = $this->getConn();

        if($conn->connect_error) {
            die('Pripojenie sa nezdarilo' . $conn->connect_error);
        }

    }


    /**
     * @return $this->aServerName
     */
    public function getAServerName(): string
    {
        return $this->aServerName;

    }

    /**
     * @return $this->aDBlogin
     */
    public function getADBlogin(): string
    {
        return $this->aDBlogin;
    }

    /**
     * @return $this->aDBpass
     */
    public function getADBpass(): string
    {
        return $this->aDBpass;
    }

    /**
     * @return $this->aDBmeno
     */
    public function getADBmeno(): string
    {
        return $this->aDBmeno;
    }

    /**
     * @return mysqli
     */
    public function getConn(): mysqli
    {
        return $this->conn;
    }

    /**
     * @param mysqli $conn
     */
    private function setConn(mysqli $conn): void
    {
        $this->conn = $conn;
    }


}