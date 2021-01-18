<!DOCTYPE html>
<html lang="en">
<?php include 'incPageContent/headElement.php'; ?> <!-- Head Element -->
<head>
    <title>Rudolf Šimo | Profile</title>
</head>
<?php include "incPageContent/headerWOLogin.php" ?> <!-- Header Without Login-->

<body>

<div class="contentContainer">

    <div class="profile-content">
        <form method="post" action="includes/ManipulateProfileData.php" enctype="multipart/form-data">

            <?php require "includes/ManipulateProfileData.php";
            $profileData = new ManipulateProfileData();


            ?>

            <div class="profile-top-image-name">

                <img src="images/userAvatars/default.png" alt="profile-img-default-size">

                <div class="profile-name">
                    <ul>
                        <li><input type="file" name="avatarFile" id="avatarFile"></li>
                        <li><input type="submit" value="Upload Image" name="avatarUpload"></li>
                    </ul>
                </div>


            </div>
        </form>
        <form method="post" action="includes/ManipulateProfileData.php">
            <ul class="profile-data-ul">

                <li>
                    <?php
                    if (isset($_GET['success'])) {
                        if ($_GET['success'] == 'uspChangedUsername') {
                            echo "<p>Pouzivatelske meno, uspesne zmenene!</p>";
                        } else if ($_GET['success'] == 'uspChangedEmail') {
                            echo "<p>Email, uspesne zmeneny!</p>";
                        } else if ($_GET['success'] == 'uspChangePass') {
                            echo "<p>Heslo, uspesne zmenene!</p>";
                        }

                    } else if (isset($_GET['error'])) {
                        if ($_GET['error'] == 'loginNotUnique') {
                            echo "<p>Username nie je unikatny!</p>";
                        } else if ($_GET['error'] == 'emailNotUnique') {
                            echo "<p>Email nie je unikatny!</p>";
                        } else if ($_GET['error'] == 'passNotLongEnough') {

                            echo "<p>Heslo obsahuje menej ako 8 znakov!</p>";
                        } else if ($_GET['error'] == 'passNoRequiredCharacters') {
                            echo "<p>Heslo neobsahuje aspon 1: Velke, male pismeno a cislo!</p>";

                        } else if ($_GET['error'] == 'passwordNotEquals') {

                            echo "<p>Hesla sa nezhoduju!</p>";

                        } else if ($_GET['error'] == 'UsernameEmpty') {

                            echo "<p>Kolonka Username je prazdna!</p>";

                        } else if ($_GET['error'] == 'NameEmpty') {

                            echo "<p>Kolonka Meno je prazdna!</p>";

                        } else if ($_GET['error'] == 'SurnameEmpty') {

                            echo "<p>Kolonka Priezvisko je prazdna!</p>";

                        } else if ($_GET['error'] == 'EmailEmpty') {

                            echo "<p>Kolonka Email je prazdna!</p>";

                        } else if ($_GET['error'] == 'passFieldEmpty') {

                            echo "<p>Kolonka Pass je prazdna!</p>";

                        } else if ($_GET['error'] == 'wrongPass') {

                            echo "<p>Zadane heslo je nespravne!</p>";

                        }

                    }


                    ?>
                </li>


                <li>

                    <?php echo '<p> Prihlaseny ako: ' . $profileData->getUserLogin() . '</p>' ?>
                    <div class="profile-change-box">
                        <div class="profile-change-label">
                            <label for="changeUserShow">User Name</label>
                            <input type="text" name="changeUserShow" id="changeUserShow" placeholder="User Name">
                            <input type="submit" name="changeUserProceed">
                        </div>
                    </div>

                </li>
                <li>
                    <?php echo '<p> Meno Pouzivatela : ' . $profileData->getUserFirstName() . '</p>' ?>
                    <div class="profile-change-box">
                        <div class="profile-change-label">
                            <label for="changeNameShow">Meno</label>
                            <input type="text" name="changeNameShow" id="changeNameShow" placeholder="Name">
                            <input type="submit" name="changeNameProceed">
                        </div>
                </li>
                <li>
                    <?php echo '<p> Priezvisko Pouzivatela : ' . $profileData->getUserLastName() . '</p>' ?>
                    <div class="profile-change-box">
                        <div class="profile-change-label">
                            <label for="changeSurnameShow">Priezvisko</label>
                            <input type="text" name="changeSurnameShow" id="changeSurnameShow" placeholder="Surname">
                            <input type="submit" name="changeSurnameProceed">
                        </div>
                    </div>
                </li>
                <li>

                    <?php echo '<p> Email: ' . $profileData->getUserEmail() . '</p>' ?>
                    <div class="profile-change-box">
                        <div class="profile-change-label">
                            <label for="changeEmailShow">E-Mail</label>
                            <input type="text" name="changeEmailShow" id="changeEmailShow" placeholder="E-Mail">
                            <input type="submit" name="changeEmailProceed">
                        </div>
                    </div>
                </li>
                <li>

                    <p class="password-desc">Zmena Hesla:</p>
                    <div class="profile-change-box profile-change-box-row">
                        <div class="profile-change-label">
                            <label for="changePassShow">Heslo</label>
                            <input type="password" name="changePassShow" id="changePassShow" placeholder="Password"
                                   minlength="8">
                            <label for="changeRepeatPassShow">Heslo Znova</label>
                            <input type="password" name="changeRepeatPassShow" id="changeRepeatPassShow"
                                   placeholder="Repeat Password" minlength="8">
                            <input type="submit" name="changePassSubmit">
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-change-box profile-change-box-row">
                        <p>Zmazat Ucet?</p>
                    </div>
                </li>
                <li>
                    <div class="profile-change-box profile-change-box-row">

                        <div class="profile-change-label">
                            <br>
                            <label for="reqDelPass">Heslo pre overenie</label>
                            <input type="password" name="reqDelPass" id="reqDelPass" placeholder="Password"
                                   minlength="8">
                            <input type="submit" name="deleteAccount">
                        </div>
                    </div>
                </li>


            </ul>


        </form>
    </div>
</div>


<?php include "incPageContent/footer.php" ?>
</body>
</html>