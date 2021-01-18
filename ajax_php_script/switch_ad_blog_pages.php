<?php

if (session_status() == PHP_SESSION_NONE) { //Ak este Session nie je startnuta
    session_start();
}

include "../includes/BlogScript.php";
$blogManager = new BlogScript();



if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] && isset($_POST['pageNumber'])) {
    $pageNumber = $_POST['pageNumber'];
    $tmpStartPost = $_POST['pageNumber'] * 10;


    $blogManager->getAdminPreviewOfPosts($tmpStartPost,10);
    $blogManager->getBlogPostSubpageNumbers(10);


}
