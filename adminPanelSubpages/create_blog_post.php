<?php
echo '
<form action="includes/BlogScript.php" method="post" >
    <label>Title</label>
    <input type="text" name="title" placeholder="Title" maxlength="30">
    <label>Text</label>
    <textarea name="text" placeholder="Text" maxlength="1500"></textarea>
    <label>Image</label>
    <input type="text" name="image" placeholder="Image" maxlength="19">
    <button class="btn" name="createPost">Create</button>
</form>
';

