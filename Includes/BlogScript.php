<?php


class BlogScript
{

    private DBConn $dbConnect;

    /**
     * BlogScript constructor.
     */
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) { //Ak este Session nie je startnuta
            session_start();
        }
        require_once 'DBConnect.php';

        $this->setDbConnect(new DBConn());

        if (isset($_POST['createPost']) && isset($_SESSION['isAdmin'])) {

            //$tmpImage = (string)$_POST['image'];
            $tmpImage = "default.png";
            $tmpTitle = (string)$_POST['title'];
            $tmpText = (string)$_POST['text'];

            $this->createBlogPost($tmpImage, $tmpTitle, $tmpText);

        }


    }

    /**
     * @return DBConn
     */
    public function getDbConnect(): DBConn
    {
        return $this->dbConnect;
    }

    /**
     * @param DBConn $dbConnect
     */
    public function setDbConnect(DBConn $dbConnect): void
    {
        $this->dbConnect = $dbConnect;
    }

    /**
     * @param string $parImage
     * @param string $parTitle
     * @param string $parBodyText
     */
    public function createBlogPost(string $parImage, string $parTitle, string $parBodyText)
    {

        if ($this->doFileExist($parImage) === false) {
            header('location: ../index.php?error=imageNotExists');
            exit();
        }
        if (strlen($parBodyText) > 1500) {
            header('location: ../adminPanel.php?error=tooMuchBodyText');
            exit();
        }

        if (strlen($parTitle) > 30) {
            header('location: ../adminPanel.php?error=titleTooLong');
            exit();
        }



        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === 1) {

            $sqlAddBlogPost = 'INSERT INTO blog_posts (idUser, image, title, body)
                               VALUES (?,?,?,?)';

            if ($tmpMysqli = $this->getDbConnect()->getInitConn()) { //Ak existuje pripojenie k DB

                $stmtAddBlogPost = $tmpMysqli->stmt_init();

                if (!$stmtAddBlogPost->prepare($sqlAddBlogPost)) { //Ak doslo k nejakej chybe
                    header('location: ../index.php?error=stmtErrorAddBlogPost');
                    exit();
                }
                $tmpIDUser = (int)$_SESSION['idUser'];
                //$parImage = "testImage";
                //$parTitle = "Titu";
                //$parBodyText = "dasds";

                $stmtAddBlogPost->bind_param('isss', $tmpIDUser, $parImage, $parTitle, $parBodyText);
                $stmtAddBlogPost->execute();
                $stmtAddBlogPost->close();
                //Kedze sme uspesne zmenili pouzivatelsky login, treba ho zmenit aj v session

                header('location: ../adminPanel.php?success=addedBlogPost');
                exit();
            }
        }
    }

    /**
     * @param string $parFile
     * @return bool
     */
    public function doFileExist(string $parFile): bool
    {
        $parFile = "../images/userAvatars/" . $parFile;
        if (file_exists($parFile)) {
            return true;
        } else {
            return false;
        }

    }


    /**
     * @param int $parStartPost
     * @param int $parCountPosts
     * @param int $parShownPosts
     */
    public function getSpecificBlogPost(int $parStartPost, int $parCountPosts, int $parShownPosts)
    {

        if ($tmpMysqli = $this->getDbConnect()->getInitConn()) { //Ak existuje pripojenie k DB

            $sqlGetBlogPost = 'SELECT * FROM blog_posts bp JOIN pouzivatelia po
              ON (po.idPouzivatela = bp.idUser)
              LIMIT ?,?';

            $stmtGetBlogPost = $tmpMysqli->stmt_init();

            if (!($stmtGetBlogPost->prepare($sqlGetBlogPost)))  //Ak doslo k nejakej chybe
            {
                header('location: ../index.php?error=profileStmtError');
                exit();
            }

            $stmtGetBlogPost->bind_param("ii", $parStartPost, $parCountPosts); //s - String
            $stmtGetBlogPost->execute();
            $resultPosts = $stmtGetBlogPost->get_result();

            if ($resultPosts = $resultPosts->fetch_all(MYSQLI_ASSOC)) {

                for ($i = 0; $i < sizeof($resultPosts); $i++) {
                    echo '<div class="blog_post">';
                    echo '<h1> ' . $resultPosts[$i]['title'] . ' </h1>'; //Vypise Titulok
                    //echo '<img class="blog_post_image" src="<?php echo $parPostID; " alt="blog_post_image">'; //Vypise Obrazok
                    echo '<p>' . $resultPosts[$i]['body'] . '</p>';
                    echo '</div>'; //Vypise cely Text
                }
            }
            echo "<button class='show_more_blogposts' data-shownposts='$parShownPosts'>Zobrazit Viac</button>";

        } else {
            echo "Not Found";
        }
    }


    /**
     * @param int $parStartPost
     * @param int $parCountPosts
     */
    public function getAdminPreviewOfPosts(int $parStartPost, int $parCountPosts): void
    {

        if ($tmpMysqli = $this->getDbConnect()->getInitConn()) { //Ak existuje pripojenie k DB

            $sqlGetPost = 'SELECT bp.idPost, bp.title, po.loginPouzivatela FROM blog_posts bp 
              JOIN pouzivatelia po
              ON (po.idPouzivatela = bp.idUser)
              LIMIT ?,?';

            $stmtGetPost = $tmpMysqli->stmt_init();

            if (!($stmtGetPost->prepare($sqlGetPost)))  //Ak doslo k nejakej chybe
            {
                header('location: ../index.php?error=errorAdminPreviewPost');
                exit();
            }

            $stmtGetPost->bind_param("ii", $parStartPost, $parCountPosts); //s - String
            $stmtGetPost->execute();
            $resultPosts = $stmtGetPost->get_result();

            if ($resultPosts = $resultPosts->fetch_all(MYSQLI_ASSOC)) {

                for ($i = 0; $i < sizeof($resultPosts); $i++) {
                    echo '<div class="admin_blog_preview">';
                    echo "<p>";
                    echo "ID: ";
                    echo $resultPosts[$i]['idPost'];
                    echo " Title: ";
                    echo $resultPosts[$i]['title'];
                    echo " Vytvoril: ";
                    echo $resultPosts[$i]['loginPouzivatela'];
                    echo "</p>";
                    echo "<button class='admin_blog_delete mdc-icon-button material-icons' onclick='ajaxDeletePost.ajaxCallDeletePost(" . $resultPosts[$i]['idPost'] . "," . $i . ")'>";
                    echo "delete_forever";
                    echo "</button>";
                    echo "</div>";
                }

            } else {
                echo "Not Found";
            }
        }

    }


    /**
     * @param int $parPostID
     * @return int
     */
    public function deletePostByID(int $parPostID): int
    {

        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === 1) {

            $sqlDeletePost = 'DELETE FROM blog_posts WHERE idPost = ?';
            $stmtDeletePost = $this->getDbConnect()->getInitConn()->stmt_init();

            if (!$stmtDeletePost->prepare($sqlDeletePost)) { //Ak doslo k nejakej chybe
                return -1;
            }


            $stmtDeletePost->bind_param('s', $parPostID,); //ss - String, String
            $stmtDeletePost->execute();
            $stmtDeletePost->close();

            //Dokoncene mazanie z profile_data

            return 1;
        } else {
            return 0;
        }
    }

    /**
     * @return int
     */
    public function getNumberOfPosts(): int
    {

        $sqlNumberOfPosts = 'SELECT * FROM blog_posts';
        $stmtNumberOfPosts = $this->getDbConnect()->getInitConn()->stmt_init();

        if (!$stmtNumberOfPosts->prepare($sqlNumberOfPosts)) { //Ak doslo k nejakej chybe
            return -1;
        }

        $stmtNumberOfPosts->execute();

        $stmtNumberOfPosts->store_result();

        $tmpNumberOfRows = $stmtNumberOfPosts->num_rows;

        $stmtNumberOfPosts->close();

        return $tmpNumberOfRows;
    }

    /**
     * @param int $parCountOfPostsPerPage
     * @return int
     */
    public function getBlogPostSubpageNumbers(int $parCountOfPostsPerPage): int
    {

        //Zisti, kolko tlacitok ma byt pre vsetky blogposty, zaokruhlene nahor
        $tmpNumberOfButtons = ceil($this->getNumberOfPosts() / $parCountOfPostsPerPage);

        echo "<div class='admin_blogpost_subpages'>";
        for ($i = 0; $i < $tmpNumberOfButtons; $i++) {
            echo "<button class='admin_blogpost_buttons' data-id='$i'>" . $i . "</button>";
        }
        echo "</div>";

        return 1;

    }

}

$blogScript = new BlogScript();