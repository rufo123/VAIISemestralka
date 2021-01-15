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
    <script type="module" src="./js/main.js"></script>
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
        <p> U : <?php echo $_SESSION['userLogin'] ?></p>
        </div>
        <button class="mdc-icon-button material-icons go-back-btn" title="Go Back">exit_to_app</button>



    </div>
    <div class="admin-content-container">
        <div class="admin-left">

            <ul>

                <li><button class="btn-subpages" onclick="loadSubpage.loadPageLoader('admin_welcome.php')"  >Domov</button></li>
                <li><button class="btn-subpages" onclick="loadSubpage.loadPageLoader('test2.php')"  >Submit2</button></li>
                <li><button class="btn-subpages" onclick="loadSubpage.loadPageLoader('test.php')"  >Submit3</button></li>
                <li><button class="btn-subpages" onclick="loadSubpage.loadPageLoader('test2.php')"  >Submit4</button></li>
                <li><button class="btn-subpages" onclick="loadSubpage.loadPageLoader('test.php')"  >Submit5</button></li>
            </ul>

        </div>
        <div class="admin-right">



        </div>

    </div>

</div>

<?php include "incPageContent/footer.php" ?>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</html>