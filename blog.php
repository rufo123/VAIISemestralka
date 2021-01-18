<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rudolf Šimo | Blog</title>
<?php include 'incPageContent/headElement.php'; ?> <!-- Head Element -->
<link rel="stylesheet" href="css/public_blog_posts.css">
</head>
<body>
<?php include 'incPageContent/header.php'; ?> <!-- Header -->

<div class="contentContainer">

    <div class="contentBox">

        <h1>Blog:</h1>
        <div class="blogBox" >

            <?php

            include_once "includes/BlogScript.php";

            $blogManager = new BlogScript();

            $blogManager->getSpecificBlogPost(0,3, 0);

            ?>

        </div>


    </div>


</div>

<?php include "incPageContent/footer.php"?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>