<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rudolf Šimo | Portfolio</title>
    <link rel="icon" type="image/ico" href="favicon.ico"/>
    <link rel="stylesheet" href="basescript.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>

<div id="headerID" class="header">
    <div class="navbar">

        <div class="container">

            <div class="navbar-logo">
                <a href="#">
                    <img src="images/navbar-logo.jpg" alt="My-Logo">
                </a>
            </div>

            <div class="navigation-menu">
                <ul>
                    <li><a class="navbar-item" href="index.php">O Mne</a></li>
                    <li><a class="navbar-item" href="projects.php">Projekty</a></li>
                    <li><a class="navbar-item" href="gallery.php">Galéria</a></li>
                    <li><a class="navbar-item" href="blog.php">Blog</a></li>
                    <li><a class="navbar-item" href="order.php">Objednávky</a></li>
                </ul>

            </div>

        </div>

    </div>

</div> <!-- Koniec Headeru -->

<div class="contentContainer">
<div class="profile-content">
    <form method="post" action="includes/ChangeProfileData.php">

    <?php require "includes/ChangeProfileData.php";
    $savedUserData = $profileData->selectPouzivateliaData($profileData->getDbConn(), $profileData->getUserLoggedWithAs());
    $savedProfileData = $profileData->selectProfileData($profileData->getDbConn(), $profileData->getIDUser($savedUserData));

    ?>

    <div class="profile-top-image-name">

        <img src="images/userAvatars/default.png" alt="profile-img-default-size">

        <div class="profile-name">
             <ul>
                 <li class="li-name">
                      Nahrať súbor
                 </li> <!-- First Name -->

             </ul>
        </div>



    </div>

    <ul class="profile-data-ul">


        <li>

            <?php  echo '<p> Prihlaseny ako: '.  $profileData->getUserLogin($savedUserData) . '</p>'  ?>
            <div class="profile-change-box">
                <div class="profile-change-label">
                    <label for="changeUserShow">User Name</label>
                    <input type="text" name="changeUserShow" id="changeUserShow" placeholder="User Name">
                    <input type="submit" name="changeUserProceed">
                </div>
            </div>

        </li>
        <li>
            <?php  echo '<p> Meno Pouzivatela : '.  $profileData->getFirstName($savedProfileData) . '</p>'  ?>
            <div class="profile-change-box">
                <div class="profile-change-label">
                     <label for="changeNameShow">Meno</label>
                     <input type="text" name="changeNameShow" id="changeNameShow" placeholder="Name">
                     <input type="submit" name="changeNameProceed">
            </div>
        </li>
        <li>
            <?php  echo '<p> Priezvisko Pouzivatela : '.  $profileData->getLastName($savedProfileData) . '</p>'  ?>
            <div class="profile-change-box">
                <div class="profile-change-label">
                    <label for="changeSurnameShow">Priezvisko</label>
                    <input type="text" name="changeSurnameShow" id="changeSurnameShow" placeholder="Surname">
                    <input type="submit" name="changeSurnameProceed">
                </div>
            </div>
        </li>
        <li>

            <?php  echo '<p> Email: '.  $profileData->getEmailUser($savedUserData) . '</p>'  ?>
            <div class="profile-change-box">
                <div class="profile-change-label">
                    <label for="changeEmailShow">E-Mail</label>
                    <input type="text" name="changeEmailShow" id="changeEmailShow" placeholder="E-Mail">
                    <input type="submit" name="changeEmailProceed">
                </div>
            </div>
        </li>
        <li>

            <p class="password-desc">Zmena Hesla:</p>
            <div class="profile-change-box profile-change-box-row">
                <div class="profile-change-label">
                    <label for="changePassShow">Heslo</label>
                    <input type="password" name="changePassShow" id="changePassShow" placeholder="Password">
                    <label for="changeRepeatPassShow">Heslo Znova</label>
                    <input type="password" name="changeRepeatPassShow" id="changeRepeatPassShow" placeholder="Repeat Password">
                    <input type="submit" name="changePassSubmit">
                 </div>
            </div>
        </li>
    </ul>




    </form>
</div>
</div>


<footer>
    <p> Vytvoril: Rudolf Šimo - 2020 </p>
</footer>

</body>

</html>