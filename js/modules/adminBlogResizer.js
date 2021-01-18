class AdminBlogResizer {


    constructor() {

        if (document.getElementsByClassName("admin_blog_preview")) {
            window.addEventListener('resize', this.resizeBlogTitlePreview);
        }

    }


    resizeBlogTitlePreview() {

        let adminPreview;
        if (document.getElementsByClassName("admin_blog_preview")[0]) {
            adminPreview = document.getElementsByClassName("admin_blog_preview");


            let adminPreviewHeight = document.getElementsByClassName("admin_blog_preview")[0].clientHeight;
            let adminRightHeight = document.getElementsByClassName("admin-right")[0].clientHeight;


            //  console.log(adminRightHeight);
            if (adminRightHeight <= 350) {
                for (let i = 0; i < adminPreview.length; i++) {
                    adminPreview[i].style.fontSize = adminPreviewHeight / 2 + "px";
                }

            } else {

                for (let j = 0; j < adminPreview.length; j++) {
                    adminPreview[j].style.fontSize = 100 + "%";

                }


            }
            // console.log(adminRightHeight);


        }

    }
}

export {AdminBlogResizer};
