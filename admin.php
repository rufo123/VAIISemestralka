<?php //Inicializujeme Session
if (session_status() == PHP_SESSION_NONE) { //Ak este Session nie je startnuta
    session_start();
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rudolf Šimo | Admin Redirect</title>
    <?php include 'incPageContent/headElement.php'; ?> <!-- Head Element -->
</head>
<body class="body-admin-panel">

<div class="bg-image"></div>


<div class="contentContainer">

    <div class="admin-panel-box">

        <?php

        if (isset($_SESSION['idUser'])) //Ak este nie je pouzivatel prihlaseny
        {
            header('location: adminPanel.php');
            exit();
        } else {

            include "adminPanelSubpages/adminLoginForm.php";

        }
        ?>

    </div>

</div>

<?php include "incPageContent/footer.php" ?>

</body>

</html>