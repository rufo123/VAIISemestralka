<!DOCTYPE html>
<html lang="en">
<?php include 'incPageContent/headElement.php'; ?> <!-- Head Element -->
<head>
    <title>Rudolf Šimo | Blog</title>
    <link rel="stylesheet" href="css/public_blog_posts.css">
</head>
<?php include 'incPageContent/header.php'; ?> <!-- Header -->

<body>

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

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</html>