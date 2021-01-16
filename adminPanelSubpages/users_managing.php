<?php

include_once "../includes/ManipulateProfileData.php";
include_once "../includes/MassUserManipulation.php";

$profileData = new ManipulateProfileData();
$userMassOperations = new MassUserManipulation();

for ($i = 0; $i < $userMassOperations->getUserCount(); $i++) {

    $tmpAltTextIMG = "Image Of User - " . $profileData->getUserLogin();
    $tmpUserID = $userMassOperations->getUserIdByRow($i); //Ziskame IDCko pouzivatela na zaklade v ktorom riadku databazy sa nachadza
    $profileData->initialiseProfileVariables($tmpUserID); //Inicializujeme Profile Variables na zaklade zadaneho ID

    $tmpProfileIMGURL = "images/userAvatars/";
    if ($profileData->getAvatarID() === 0) {
        $tmpProfileIMGURL = $tmpProfileIMGURL . "default.png";
    } else {
        $tmpProfileIMGURL = $tmpProfileIMGURL . $profileData->getAvatarID();
    }

    //echo "<script> changeAdminColor.changeColorAdmin('" . $tmpIsAdmin . "', '" . $i . "' ); </script>";

    if ($profileData->isAdmin() === true) {
        echo "<div class='user_block user_block_admin'> ";
    } else {
        echo "<div class='user_block'>";
    }

    echo "<img class='admin_profile_showcase_image' src='$tmpProfileIMGURL' alt='User:' . $tmpUserID . '>";
    echo "<p>" . $profileData->getUserLogin() . "</p>";

    echo "<ul>
                <li><button class='admin_promote' onclick='changeAdminColor.changeColorAdmin(" . $i . "," . $tmpUserID . ")'>TEst</button></li>
           </ul>";

    echo " </div>";



}


?>

