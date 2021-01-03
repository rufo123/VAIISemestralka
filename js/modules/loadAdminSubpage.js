class LoadAdminSubpage {

    constructor() {

    }

    loadPage(parPageName) {

        if (parPageName !== null) {

            let tmpXHttp = new XMLHttpRequest();
            tmpXHttp.onreadystatechange = () => {
                if (tmpXHttp.readyState === 4 && tmpXHttp.status === 200) {
                    document.getElementsByClassName('admin-right')[0].innerHTML = tmpXHttp.responseText;
                }
            };

            tmpXHttp.open("GET", parPageName, true);
            tmpXHttp.send();

            if (tmpXHttp.status === 404) {
                document.getElementsByClassName('admin-right')[0].innerHTML = "Page Not Found";
            }
        }
    }

}

export {LoadAdminSubpage};