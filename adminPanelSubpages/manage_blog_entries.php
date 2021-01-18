<?php

include "../includes/BlogScript.php";

$blogManager = new BlogScript();

$blogManager->getAdminPreviewOfPosts(0,10);

$blogManager->getBlogPostSubpageNumbers(10);
