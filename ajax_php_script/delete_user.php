<?php

if (session_status() == PHP_SESSION_NONE) { //Ak este Session nie je startnuta
    session_start();
}

include_once "../includes/ManipulateProfileData.php";

$profileManager = new ManipulateProfileData();


if (isset($_SESSION['isAdmin']) && ($_SESSION['isAdmin'] === 1)) {


    $profileManager->deleteAccountWithAdminPrivileges($profileManager->getDbConn()->getInitConn(), $_POST['idOfTargetUser']); //Vymazeme admin ucet



    header('location: ../adminPanel.php?success=accountDeleted');
    exit();
} else {
    header('location: ../index.php?error=noAdminPrivileges');
    exit();

}