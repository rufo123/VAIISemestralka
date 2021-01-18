<?php

if (session_status() == PHP_SESSION_NONE) { //Ak este Session nie je startnuta
    session_start();
}

if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] && isset($_POST['idPost'])) {

    include_once "../includes/BlogScript.php";

    $blogManager = new BlogScript();

    $blogManager->deletePostByID($_POST['idPost']);

} else {
    header('location: ../index.php?error=noAdminPrivileges');
    exit();
}