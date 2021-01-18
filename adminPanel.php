<?php //Inicializujeme Session
if (session_status() == PHP_SESSION_NONE) { //Ak este Session nie je startnuta
    session_start();
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rudolf Šimo | Admin</title>
    <?php include 'incPageContent/headElement.php'; ?> <!-- Head Element -->
</head>


<body>
<div class="bg-image"></div>
<div class="admin-panel-main-wrapper">

    <div class="admin-header">
        <img src="images/userAvatars/default.png" alt="profile-photo">
        <div class="username-box">
        <p> U : <?php echo $_SESSION['userLogin'] ?></p>
        </div>
        <a href="index.php" class="mdc-icon-button material-icons go-back-btn"  title="Go Back">exit_to_app</a>



    </div>
    <div class="admin-content-container">
        <div class="admin-left">

            <ul>
                <li><button class="btn-subpages" onclick="loadSubpage.loadPageLoader('admin_welcome.php')">Domov</button></li>
                <li><button class="btn-subpages" onclick="loadSubpage.loadPageLoader('users_managing.php')">Users</button></li>
                <li><button class="btn-subpages" onclick="loadSubpage.loadPageLoader('create_blog_post.php')" >Create Blog</button></li>
                <li><button class="btn-subpages" onclick="loadSubpage.loadPageLoader('manage_blog_entries.php')">Manage Blog</button></li>
            </ul>

        </div>
        <div class="admin-right">



        </div>

    </div>

</div>

<?php include "incPageContent/footer.php" ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>