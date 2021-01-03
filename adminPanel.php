<?php //Inicializujeme Session
if (session_status() == PHP_SESSION_NONE) { //Ak este Session nie je startnuta
    session_start();
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/ico" href="favicon.ico"/>
    <link rel="stylesheet" href="basescript.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="module" src="./js/main.js">
        let loadSubpage = new LoadAdminSubpage();
    </script>
    <title>Rudolf Šimo | Portfolio</title>

</head>
<head>
    <title>Rudolf Šimo | Order</title>
</head>


<body>
<div class="bg-image"></div>
<div class="admin-panel-main-wrapper">

    <div class="admin-header">
        <img src="images/userAvatars/default.png" alt="profile-photo">
        <div class="username-box">
        <p> UID : <?php echo $_SESSION['userLogin'] ?></p>
        </div>
        <button class="mdc-icon-button material-icons go-back-btn" title="Go Back">exit_to_app</button>



    </div>
    <div class="admin-content-container">
        <div class="admin-left">

            <ul>

                <li><button class="btn-subpages" onclick="loadSubpage.loadPage('adminPanelSubpages/test.php')"  >Submit</button></li>
                <li><button class="btn-subpages" onclick="loadSubpage.loadPage('adminPanelSubpages/test2.php')"  >Submit2</button></li>
                <li><button class="btn-subpages" onclick="loadSubpage.loadPage('adminPanelSubpages/test.php')"  >Submit3</button></li>
                <li><button class="btn-subpages" onclick="loadSubpage.loadPage('adminPanelSubpages/test2.php')"  >Submit4</button></li>
                <li><button class="btn-subpages" onclick="loadSubpage.loadPage('adminPanelSubpages/test.php')"  >Submit5</button></li>
            </ul>

        </div>
        <div class="admin-right">

        </div>

    </div>

</div>

<?php include "incPageContent/footer.php" ?>

</body>

</html>