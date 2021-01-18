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

    $tmpPromoteOrDemote;

    if ($profileData->isAdmin() === true) {
        echo "<div class='user_block user_block_admin'> ";
        $tmpPromoteOrDemote = "Demote";
    } else {
        echo "<div class='user_block'>";
        $tmpPromoteOrDemote = "Promote";
    }
    echo "<div class='user_info'>";
        echo "<img class='admin_profile_showcase_image' src='$tmpProfileIMGURL' alt='User $tmpUserID'>";
        echo "<p>" . $profileData->getUserLogin() . "</p>";
    echo "</div>";
    /** @noinspection CommaExpressionJS */
    echo "<div class='user_manipulation'>";
             echo "<ul>";
                 echo "<li><button class='admin_promote' onclick='changeAdminColor.changeColorAdmin($i , $tmpUserID)'>$tmpPromoteOrDemote</button></li>";
                 echo "<li><button class='admin_delete_user' data-del='$tmpUserID'>Delete</button></li>";
             echo "</ul>";
        echo " </div>";
    echo "</div>";

}


