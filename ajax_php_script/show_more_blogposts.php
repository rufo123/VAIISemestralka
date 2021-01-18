<?php

if (session_status() == PHP_SESSION_NONE) { //Ak este Session nie je startnuta
    session_start();
}

include "../includes/BlogScript.php";
$blogManager = new BlogScript();



if (isset($_POST['shownPosts'])) {


    $tmpShownPosts = $_POST['shownPosts'];


    if (($_POST['shownPosts'] * 3) <= $blogManager->getNumberOfPosts()) {
        $blogManager->getSpecificBlogPost(3 * $tmpShownPosts ,3 , $tmpShownPosts++);
    }



}