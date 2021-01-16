<?php

include "../includes/ManipulateProfileData.php";

$profileData = new ManipulateProfileData();

echo " <h1> Vitaj " . $profileData->getUserFirstName() ."  </h1>";


$tmpProfileIMGURL = "images/userAvatars/";

if ($profileData->getAvatarID() === 0) {
    $tmpProfileIMGURL = $tmpProfileIMGURL . "default.png";
}  else {
    $tmpProfileIMGURL = $tmpProfileIMGURL . $profileData->getAvatarID();
}

$tmpAltTextIMG = "Image Of User - ". $profileData->getUserLogin();

echo "<img class='admin_profile_showcase_image' src='$tmpProfileIMGURL' alt='$tmpAltTextIMG'>";

echo "<h2> Rola: Administrator</h2>";
?>














