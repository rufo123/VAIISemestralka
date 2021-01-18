class LoadAdminSubpage {


    aPageIsLoaded = false;
    aNumberOfLinksInPage = 0;

    constructor(parDefaultPage) {
        this.aNumberOfLinksInPage = this.getNumberOfLinks;
        this.loadPageLoader(parDefaultPage);

    }

    loadPageLoader(parPageName) {

        let tmpBackground = document.getElementsByClassName("admin-right")[0];

        if (tmpBackground !== undefined) {
            tmpBackground.style.opacity = "0.5";

            this.loadPage(parPageName);
        }

    };

    loadPage(parPageName) {

        if (parPageName !== null) {

            document.getElementsByClassName("admin-right")[0].innerHTML = "";

            let tmpXHttp = new XMLHttpRequest();
            tmpXHttp.onreadystatechange = () => {
                if (tmpXHttp.readyState === 4 && tmpXHttp.status === 200) {
                    document.getElementsByClassName('admin-right')[0].innerHTML = tmpXHttp.responseText;
                }
            };

            tmpXHttp.open("GET", "adminPanelSubpages/" + parPageName, true);
            tmpXHttp.send();

            if (tmpXHttp.status === 404) {
                document.getElementsByClassName('admin-right')[0].innerHTML = "Page Not Found";
            } else {
                console.log('AdminPanel Subpage Swapped!');
                this.aPageIsLoaded = true;
                let styleName = parPageName.slice(0, (parPageName.lastIndexOf("."))); //Odsekne priponu .php
                this.loadStyleSheet(styleName);


            }


            console.log("send");
        }
    }

    loadStyleSheet(parStyleSheetName) {

        if (this.aPageIsLoaded === true) {

            if (this.getNumberOfLinks > this.aNumberOfLinksInPage) {
                this.deletePreviousSubStyle();
            }

            let tmpHead = document.getElementsByTagName('head')[0];

            let tmpLink = document.createElement('link');
            tmpLink.rel = 'stylesheet';
            tmpLink.type = 'text/css';
            let filePath = 'css/css_admin_panel_subpages/' + parStyleSheetName + '.css';
            tmpLink.href = filePath;


            this.checkIFFileExists(filePath, function (returnValue) {
                if (returnValue === true) {
                    tmpHead.appendChild(tmpLink);
                    console.log('AdminPanel css added successfully!');
                    if (parStyleSheetName === "manage_blog_entries") {
                        ajaxSwitchBlogSubpages.ajaxSwitchAdminSubpage();
                        console.log("Manage");
                    } else if (parStyleSheetName === "users_managing") {
                        ajaxDeleteUser.deleteUser();
                        console.log("Delete");
                    }

                }
                let tmpBackground = document.getElementsByClassName("admin-right")[0];
                tmpBackground.style.opacity = "1";

            });
        }

    }

    checkIFFileExists(parFileName, callback) {

        let tmpCheckRequest = new XMLHttpRequest();
        let returnValue = false;
        tmpCheckRequest.open('HEAD', parFileName, true);
        tmpCheckRequest.onreadystatechange = () => {
            if (tmpCheckRequest.readyState === 4) {
                if (tmpCheckRequest.status === 404) {
                    console.log("File doesn't exist!");
                    returnValue = false;
                } else {
                    returnValue = true;
                }
                if (callback) {
                    callback(returnValue);
                }

            }

        }
        tmpCheckRequest.send();
        return true;

    }

    deletePreviousSubStyle() {
        while (this.getNumberOfLinks > this.aNumberOfLinksInPage) {
            let tmpHead = document.getElementsByTagName('head')[0];
            let tmpLink = document.querySelector('link:last-child');
            tmpHead.removeChild(tmpLink);
        }
    }

    get getNumberOfLinks() {
        return document.getElementsByTagName('link').length;
    }


}

export {LoadAdminSubpage};