<?php




if (session_status() == PHP_SESSION_NONE) { //Ak este Session nie je startnuta
    session_start();
}



include_once "../includes/ManipulateProfileData.php";
include_once "../includes/MassUserManipulation.php";

$profileManager = new ManipulateProfileData();
$massUserManager = new MassUserManipulation();


if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
    $massUserManager->setAdminStatus($_POST['idOfTargetUser'],$_POST['makeAdmin']); //makeAdmin -- boolean, ano alebo nie
    $profileManager->initialiseProfileVariables($_POST['idOfTargetUser']); //Inicializujeme si Profilove premmene s nasim uctom
} else {
    print_r("Test");

}