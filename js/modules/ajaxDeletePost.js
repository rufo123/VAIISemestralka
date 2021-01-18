class AjaxDeletePost {

    constructor() {

    }

    ajaxCallDeletePost(parPostID, parPostNumber) {

        let tmpPostNumberToDelete = parPostNumber;

        console.log(parPostID);
        console.log(parPostNumber);

        $.ajax({
            url: 'ajax_php_script/delete_blog_post.php',
            data: {idPost: parPostID,},
            type: 'POST',
            success: [ //PHPStorm, tvrdil, ze success nie je nikdy volany.. vyriesil som to takto
                function () {
                    console.log(parPostID);
                    console.log(parPostNumber);
                   $('.admin_blog_preview')[tmpPostNumberToDelete].remove();
                }
            ]


        })
    }
}

export {AjaxDeletePost};