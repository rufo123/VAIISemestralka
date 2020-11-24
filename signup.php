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


    <form class="signup" action="includes/SignupScript.php" method="post">

        <?php

        if (isset($_GET["login"]))
        {
            $aGottenLogin = $_GET["login"];

        }
        else {
            $aGottenLogin = "";

        }

        if (isset($_GET["e-mail"]))
        {
            $aGottenEmail = $_GET["e-mail"];

        }
        else {
            $aGottenEmail = "";

        }
        ?>


    <ul>



        <li>
            <label for="login">Login</label>
            <input type="text" id="login" name="login" placeholder="User Name" value="<?php echo $aGottenLogin ?>">
        </li>
        <li>
            <label for="e-mail">E-Mail</label>
            <input type="text" id="e-mail" name="e-mail" placeholder="E-Mail" value="<?php echo $aGottenEmail ?>">
        </li>
        <li>
             <label for="password">Password</label>
             <input type="password" id="password" name="password" placeholder="min. 8 char.">
        </li>
        <li>
             <label for="repeat-password">Repeat Password</label>
             <input type="password" id="repeat-password" name="repeat-password" placeholder="min. 8 char.">
        </li>
        <li>
            <input type="submit" name="signup-proceed">
           <!-- <input type="button" id="signup-proceed" name="signup-proceed" value="Sign Up"> --->
        </li>
        <?php

        if (isset($_GET['success']))
        {
            if ($_GET['success'] == 'uspZareg')
            {
                echo '<li>';
                echo '<p class="success-messages">Úspešne zaregistrovaný</p>';
                echo '</li>';
            }
        }
        else if ((isset($_GET['error'])))
        {
            echo '<li>';

            if ($_GET['error'] == 'prazdnyInput')
            {
                echo '<p class="error-messages">Error: Niektore z poli je prazdne!</p>';
            }
            else if ($_GET['error'] == 'zlyLogin')
            {
                echo '<p class="error-messages">Error: Username obsahuje nepovoleny charakter!</p>';
            }
            else if ($_GET['error'] == 'zlyEmail')
            {
                echo '<p class="error-messages">Error: Zadali ste neexistujuci E-Mail!</p>';
            }
            else if ($_GET['error'] == 'nezhodneHesla')
            {
                echo '<p class="error-messages">Error: Hesla sa nezhoduju!</p>';
            }
            else if ($_GET['error'] == 'loginNotUnique')
            {
                echo '<p class="error-messages">Error: Takyto login uz existuje!</p>';
            }
            else if ($_GET['error'] == 'emailNotUnique')
            {
                echo '<p class="error-messages">Error: Takyto email uz existuje!</p>';
            }
            else if ($_GET['error'] == 'passNotLongEnough')
            {
                echo '<p class="error-messages">Error: Heslo je prilis kratke</p>';
            } else if ($_GET['error'] == 'passNoRequiredCharacters')
            {
                echo '<p class="error-messages">Error: Heslo musi obsahovat aspon 1:</p>';
                echo '<p class="error-messages">Cislo, velke a male pismeno</p>';
            }

            echo '</li>';
        }


        ?>

    </ul>

    </form>

</div>

<?php include "incPageContent/footer.php"?>

</body>

</html>