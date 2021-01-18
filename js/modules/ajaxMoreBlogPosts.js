class AjaxMoreBlogPosts {
    constructor() {
        this.showMoreBlogPosts();
    }

    showMoreBlogPosts() {

        $(document).ready(function () {

            $('.show_more_blogposts').click(function () {

                let blogposts = document.getElementsByClassName('blog_post');

                if (blogposts) {

                    let blogposts_button = document.getElementsByClassName('show_more_blogposts')[0];
                    blogposts_button.remove();

                    let tmpShownPosts = $(this).data('shownposts');
                    tmpShownPosts++;
                    console.log(tmpShownPosts);

                    $.ajax({
                        url: 'ajax_php_script/show_more_blogposts.php',
                        data: {shownPosts: tmpShownPosts,},
                        type: 'POST',
                        success: [ //PHPStorm, tvrdil, ze success nie je nikdy volany.. vyriesil som to takto
                            function (result) {
                                if (result.length > 0) {
                                    $('.blogBox').append(result);
                                    ajaxMoreBlogPosts.showMoreBlogPosts();
                                    console.log("done");
                                } else {
                                    blogposts_button.remove();
                                }
                            }

                        ]
                    })



                }

            })
        })

    }
}

export {AjaxMoreBlogPosts}