class AjaxSwitchBlogSubpages {

    constructor() {
        this.ajaxSwitchAdminSubpage();
    }

    ajaxSwitchAdminSubpage() {


        $(document).ready(function () {

            $('.admin_blogpost_buttons').click(function () {


                let admin_blogpost = document.getElementsByClassName('admin_blog_preview');

                if (admin_blogpost) {

                    let admin_right = document.getElementsByClassName('admin-right')[0];
                    admin_right.innerHTML = "";

                    let pageNumber = $(this).data('id');
                    console.log(pageNumber);

                    $.ajax({
                        url: 'ajax_php_script/switch_ad_blog_pages.php',
                        data: {pageNumber: pageNumber,},
                        type: 'POST',
                        success: [ //PHPStorm, tvrdil, ze success nie je nikdy volany.. vyriesil som to takto
                            function (result) {
                                $('.admin-right').html(result);
                                ajaxSwitchBlogSubpages.ajaxSwitchAdminSubpage();
                                console.log("done");
                            }

                        ]
                    })
                }
            })
        })
    }


}

export {AjaxSwitchBlogSubpages}