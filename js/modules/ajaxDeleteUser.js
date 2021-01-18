class AjaxDeleteUser {

    constructor() {
        this.deleteUser();
    }

    deleteUser() {
        $(document).ready(function () {

            $('.admin_delete_user').click(function () {

                let userBlock = document.getElementsByClassName('user_block');

                if (userBlock) {

                    let tmpUserID = $(this).data('del');

                    let tmpUserBlockToDelete = $(this).parents()[3];

                    $.ajax({
                        url: 'ajax_php_script/delete_user.php',
                        data: {idOfTargetUser: tmpUserID,},
                        type: 'POST',
                        success: [ //PHPStorm, tvrdil, ze success nie je nikdy volany.. vyriesil som to takto
                            function () {

                                tmpUserBlockToDelete.remove();

                            }

                        ]
                    })



                }

            })
        })

    }
}

export {AjaxDeleteUser}