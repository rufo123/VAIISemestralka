<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rudolf Šimo | Profile</title>
<?php include 'incPageContent/headElement.php'; ?> <!-- Head Element -->
</head>
<body>
<?php include 'incPageContent/header.php'; ?> <!-- Header -->

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
                    </ul>
                </div>


            </div>
        </form>
        <form method="post" action="includes/ManipulateProfileData.php">
            <ul class="profile-data-ul">

                <li>
                    <?php


                    if (isset($_GET['success'])) {

                        $success = $_GET['success'];
                        for ($i = 0; $i < sizeof($success); $i++) {

                            if ($success[$i] == 'uspChangedUsername') {
                                echo "<p class='profile-message'>Pouzivatelske meno, uspesne zmenene!</p>";
                            } else if ($success[$i] == 'uspChangedEmail') {
                                echo "<p class='profile-message'>Email, uspesne zmeneny!</p>";
                            } else if ($success[$i] == 'uspChangePass') {
                                echo "<p class='profile-message'>Heslo, uspesne zmenene!</p>";
                            } else if ($success[$i] == 'uspChangedName') {
                                echo "<p class='profile-message'>Meno, uspesne zmenene!</p>";
                            } else if ($success[$i] == 'uspChangedSurname') {
                                echo "<p class='profile-message'>Priezvisko, uspesne zmenene!</p>";
                            }

                        }

                    } else if (isset($_GET['error'])) {
                        $error = $_GET['error'];
                        for ($i = 0; $i < sizeof($error); $i++) {


                            if ($error[$i] == 'loginNotUnique') {
                                echo "<p class='profile-message'>Username nie je unikatny!</p>";
                            } else if ($error[$i] == 'emailNotUnique') {
                                echo "<p class='profile-message'>Email nie je unikatny!</p>";
                            } else if ($error[$i] == 'passNotLongEnough') {

                                echo "<p class='profile-message'>Heslo obsahuje menej ako 8 znakov!</p>";
                            } else if ($error[$i] == 'passNoRequiredCharacters') {
                                echo "<p class='profile-message'>Heslo neobsahuje aspon 1: Velke, male pismeno a cislo!</p>";

                            } else if ($error[$i] == 'passwordNotEquals') {

                                echo "<p class='profile-message'>Hesla sa nezhoduju!</p>";

                            } else if ($error[$i] == 'UsernameEmpty') {

                                echo "<p class='profile-message'>Kolonka Username je prazdna!</p>";

                            } else if ($error[$i] == 'NameEmpty') {

                                echo "<p class='profile-message'>Kolonka Meno je prazdna!</p>";

                            } else if ($error[$i] == 'SurnameEmpty') {

                                echo "<p class='profile-message'>Kolonka Priezvisko je prazdna!</p>";

                            } else if ($error[$i] == 'EmailEmpty') {

                                echo "<p class='profile-message'>Kolonka Email je prazdna!</p>";

                            } else if ($error[$i] == 'passFieldEmpty') {

                                echo "<p class='profile-message'>Kolonka Pass je prazdna!</p>";

                            } else if ($error[$i] == 'wrongPass') {

                                echo "<p class='profile-message'>Zadane heslo je nespravne!</p>";

                            }
                        }

                    }


                    ?>
                </li>


                <li>

                    <?php echo '<p class="profile-p"> Prihlaseny ako: ' . $profileData->getUserLogin() . '</p>' ?>
                    <div class="profile-change-box">
                        <div class="profile-change-label">
                            <label for="changeUserShow">User Name</label>
                            <input type="text" name="changeUserShow" id="changeUserShow" placeholder="User Name">
                            <!-- <input type="submit" name="changeUserProceed"> -->
                        </div>
                    </div>

                </li>
                <li>
                    <?php echo '<p class="profile-p"> Meno Pouzivatela : ' . $profileData->getUserFirstName() . '</p>' ?>
                    <div class="profile-change-box">
                        <div class="profile-change-label">
                            <label for="changeNameShow">Meno</label>
                            <input type="text" name="changeNameShow" id="changeNameShow" placeholder="Name">
                            <!-- <input type="submit" name="changeNameProceed"> -->
                        </div>
                    </div>
                </li>
                <li>
                    <?php echo '<p class="profile-p"> Priezvisko Pouzivatela : ' . $profileData->getUserLastName() . '</p>' ?>
                    <div class="profile-change-box">
                        <div class="profile-change-label">
                            <label for="changeSurnameShow">Priezvisko</label>
                            <input type="text" name="changeSurnameShow" id="changeSurnameShow" placeholder="Surname">
                            <!-- <input type="submit" name="changeSurnameProceed"> -->
                        </div>
                    </div>
                </li>
                <li>

                    <?php echo '<p class="profile-p"> Email: ' . $profileData->getUserEmail() . '</p>' ?>
                    <div class="profile-change-box">
                        <div class="profile-change-label">
                            <label for="changeEmailShow">E-Mail</label>
                            <input type="text" name="changeEmailShow" id="changeEmailShow" placeholder="E-Mail">
                            <!-- <input type="submit" name="changeEmailProceed"> -->
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-change-box profile-change-box-row ">
                        <input type="submit" name="submitProfileChanges">
                    </div>

                    <p class="password-desc">Zmena Hesla:</p>
                    <div class="profile-change-box profile-change-box-row">
                        <div class="profile-change-label">
                            <label for="changePassShow">Heslo</label>
                            <input type="password" name="changePassShow" id="changePassShow" placeholder="Password"
                                   minlength="8">
                            <label for="changeRepeatPassShow">Heslo Znova</label>
                            <input type="password" name="changeRepeatPassShow" id="changeRepeatPassShow"
                                   placeholder="Repeat Password" minlength="8">
                            <!-- <input type="submit" name="changePassSubmit"> -->
                        </div>
                    </div>
                </li>
                <li>
                    <div class="profile-change-box profile-change-box-row ">
                        <input type="submit" name="submitPasswordChange">
                    </div>
                    <div class="profile-change-box profile-change-box-row">
                        <p class="profile-p">Zmazat Ucet?</p>
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