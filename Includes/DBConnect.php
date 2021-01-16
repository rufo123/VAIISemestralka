<?php


class DBConn
{
    private string $aServerName = 'localhost';
    private string $aDBlogin = 'semvaidbmanager';
    private string $aDBpass = 'GaRdaqQ78';
    private string $aDBmeno = 'vaisemestralka';
    private mysqli $initConn;

    public function __construct() {

        $this->setConn(new mysqli($this->getAServerName(), $this->getADBlogin(), $this->getADBpass(), $this->getADBmeno()));
        $initConn = $this->getInitConn();
        if($initConn->connect_error) {
            die('Pripojenie sa nezdarilo' . $initConn->connect_error);
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
    public function getInitConn(): mysqli
    {
        return $this->initConn;
    }

    /**
     * @param mysqli $parConn
     */
    private function setConn(mysqli $parConn): void
    {
        $this->initConn = $parConn;
    }



}