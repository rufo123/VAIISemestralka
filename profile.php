<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rudolf Šimo | Portfolio</title>
    <link rel="icon" type="image/ico" href="favicon.ico"/>
    <link rel="stylesheet" href="basescript.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>

<?php include "incPageContent/headerWOLogin.php"?>

<div class="contentContainer">

<div class="profile-content">
    <form method="post" action="includes/ChangeProfileData.php">

    <?php require "includes/ViewProfileData.php";
    $profileData = new ViewProfileData();



    ?>

    <div class="profile-top-image-name">

        <img src="images/userAvatars/default.png" alt="profile-img-default-size">

        <div class="profile-name">
             <ul>

             </ul>
        </div>



    </div>

    <ul class="profile-data-ul">

        <li>
            <?php
            if (isset($_GET['success']))
            {
                if ($_GET['success'] == 'uspChangedUsername')
                {
                    echo "<p>Pouzivatelske meno, uspesne zmenene!</p>";
                } else if ($_GET['success'] == 'uspChangedEmail') {
                    echo "<p>Email, uspesne zmeneny!</p>";
                } else if ($_GET['success'] == 'uspChangePass') {
                    echo "<p>Heslo, uspesne zmenene!</p>";
                }

            } else if (isset($_GET['error']))
            {
                if ($_GET['error'] == 'loginNotUnique')
                {
                    echo "<p>Username nie je unikatny!</p>";
                } else if ($_GET['error'] == 'emailNotUnique')
                {
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

                }

            }


            ?>
        </li>



        <li>

            <?php  echo '<p> Prihlaseny ako: '.  $profileData->getUserLogin() . '</p>'  ?>
            <div class="profile-change-box">
                <div class="profile-change-label">
                    <label for="changeUserShow">User Name</label>
                    <input type="text" name="changeUserShow" id="changeUserShow" placeholder="User Name">
                    <input type="submit" name="changeUserProceed">
                </div>
            </div>

        </li>
        <li>
            <?php  echo '<p> Meno Pouzivatela : '.  $profileData->getUserFirstName() . '</p>'  ?>
            <div class="profile-change-box">
                <div class="profile-change-label">
                     <label for="changeNameShow">Meno</label>
                     <input type="text" name="changeNameShow" id="changeNameShow" placeholder="Name">
                     <input type="submit" name="changeNameProceed">
            </div>
        </li>
        <li>
            <?php  echo '<p> Priezvisko Pouzivatela : '.  $profileData->getUserLastName() . '</p>'  ?>
            <div class="profile-change-box">
                <div class="profile-change-label">
                    <label for="changeSurnameShow">Priezvisko</label>
                    <input type="text" name="changeSurnameShow" id="changeSurnameShow" placeholder="Surname">
                    <input type="submit" name="changeSurnameProceed">
                </div>
            </div>
        </li>
        <li>

            <?php  echo '<p> Email: '.  $profileData->getUserEmail() . '</p>'  ?>
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
                    <input type="password" name="changePassShow" id="changePassShow" placeholder="Password" minlength="8">
                    <label for="changeRepeatPassShow">Heslo Znova</label>
                    <input type="password" name="changeRepeatPassShow" id="changeRepeatPassShow" placeholder="Repeat Password" minlength="8">
                    <input type="submit" name="changePassSubmit">
                 </div>
            </div>
        </li>


    </ul>




    </form>
</div>
</div>


<?php include "incPageContent/footer.php"?>
</body>

</html>