class ChangeCSSColor {
    get aDefaultUserColor() {
        return this._aDefaultUserColor;
    }

    set aDefaultUserColor(value) {
        this._aDefaultUserColor = value;
    }

    _aDefaultUserColor;

    constructor(parDefaultColor) {
        this.aDefaultUserColor = parDefaultColor;
        this.changeColorAdmin();
    }

    changeColorAdmin(parID = 0, userID = 0) {

        let userBlock = document.getElementsByClassName("user_block")[parID];
        let userButton = document.getElementsByClassName("admin_promote")[parID];

        if (userBlock !== undefined) {

            console.log(parID)

            let tmpIsAdmin;

            tmpIsAdmin = userBlock.classList.contains("user_block_admin");

            let tmpMakeAdmin;

            if (tmpIsAdmin === true) {
                tmpMakeAdmin = 0; //Demote
            } else {
                tmpMakeAdmin = 1; //Promote
            }

            $.ajax({
                url: 'ajax_php_script/promo_demote_user.php',
                data: {idOfTargetUser: userID, makeAdmin: tmpMakeAdmin},
                type: 'POST',
                success: [ //PHPStorm, tvrdil, ze success nie je nikdy volany.. vyriesil som to takto
                    function () {

                        if (userBlock !== undefined) {

                            if (tmpIsAdmin) {
                                // userBlock.style.backgroundColor = changeAdminColor.aDefaultUserColor;
                                userBlock.classList.remove("user_block_admin");
                                userButton.innerHTML = "Promote";
                                console.log("Changing id to default");

                            } else {
                                //  userBlock.style.backgroundColor = "red";
                                userBlock.classList.add("user_block_admin");
                                userButton.innerHTML = "Demote";
                                console.log("Changing id to red");
                            }
                        }

                    }
                ]


            })


            // let tmpUserBlock = document.getElementsByClassName('user_block')[parBlockID];

        }
    }


}

export {ChangeCSSColor};
