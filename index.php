<?php
session_start();
?>
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
                 <div class="navigation-login">
                             <?php
                             if (isset($_SESSION['userLogin'] ))
                             {
                              echo '  
                                  <div class="login-container logged-container">
                                     <form class="form-default-hidden" action="includes/LogoutScript.php" method="post">
                                        <ul>
                                  
                                            <li class="logged-in-avatar">
                                            <img src="images/userAvatars/default.png" alt="profile-photo">
                                            </li>
                                            <li class="logged-in-user">
                                            <p>' . $_SESSION['userLogin'] . ' </p></p>
                                            </li>
                                            
                                         </ul>
                                         <ul class="logout-button">
                                             <li>
                                                 <button class="exit_to_app-content mdc-icon-button material-icons logout" name="login-proceed">exit_to_app</button>
                                            </li> 
                                        </ul>
   
   
   
                                     </form>
                                  </div>
                                 
                                 
                                 
                                    ';
                             } else {

                                 echo '   
                        <div class="login-container">
                          <form action="includes/LoginScript.php" method="post">
                            <ul>

                                 <li class="has-login-dropdown">

                                         <!--<i class="material-icons navbar-item">person</i>&#xe7fd; -->
                                         <button class="person-content mdc-icon-button material-icons navbar-item login-button" name="login-proceed"></button>




                                     <div class="hidden-signup has-login-dropdown">
                                         <ul>
                                            <li><input type="submit" name="signup" value="Sign Up"></li>
                                            <li><input type="submit" name="forgotPass" value="Forgot Pass"></li>
                                      </ul>
                                    </div>
                                    
                                    
                                 </li>

                               <li>
                                    <label for="login">Login</label>
                                   <input type="text" id="login" name="login" placeholder="User Name">
                               </li>

                                <li>
                                  <label for="password">Password</label>
                                    <input type="password" id="password" name="password" placeholder="min. 6 char.">
                              </li>


                          </ul>
                         </form>
                         
                        </div>
                                 
                                    ';

                             }







                            ?>



             </div>






            </div>






        </div>

    </div>



</div> <!-- Koniec Headeru -->

<div class="contentContainer">
    <div class="contentBox">

        <article>
            <h1>O Mne:</h1>

            <img class="portfolio-me-img" alt="portfolio-image" src="images/about-me/portfolio-img.jpg">


            <h2 >V skratke:</h2>
             <p>Som študentom Fakulty Riadenia a Informatiky v Žilinskej Univerzite v Žiline,
                   kde už momentálne študujem tretí rok. K mojim záľubám patrí: Programovanie, hranie PC hier,
                    práca s drevom, hranie sa s mojim psom a hľadanie riešení k nejakému problému.
                </p>



            <h2>Obľúbené hry:</h2>
            <div class="zoznam-hier">
            <table class="oblubene-hry-table">
            <tr>
                <td><img src="images/about-me/hry/ark.jpg" alt="ARK: Survival Evolved" title="ARK: Survival Evolved"></td>
                <td><img src="images/about-me/hry/vermintide.jpg" alt="Warhammer: Vermintide 2" title="Warhammer: Vermintide 2" ></td>
                <td><img src="images/about-me/hry/red.jpg" alt="Red Dead Redemption 2" title="Red Dead Redemption 2"></td>
                <td><img src="images/about-me/hry/grand.jpg" alt="Grand Theft Auto V" title="Grand Theft Auto V"></td>
                <td><img src="images/about-me/hry/ac.jpg" alt="Assassin's Creed Séria" title="Assassin's Creed Séria"></td>
            </tr>
            </table>
            </div>


            <h2>Development:</h2>
            <p>Medzi technológie, ktoré ovládam patrí:</p>
            <p>Technológie: Pascal (Už len veľmi okrajovo)</p>

            <div class="development-zoznam">
            <table class="development-tables">
                <tr>
                    <td><img src="images/about-me/development/java-logo.png" alt="Java" title="Java"></td>
                    <td><img src="images/about-me/development/c-logo.png" alt="C" title="C"></td>
                    <td><img src="images/about-me/development/c++-logo.png" alt="C++" title="C++"></td>
                    <td><img src="images/about-me/development/html5-logo.png" alt="HTML5" title="HTML5"></td>
                    <td><img src="images/about-me/development/css3-logo.png" alt="CSS3" title="CSS3"></td>

                </tr>
            </table>
            </div>


            <p>Operačné Systémy: (Linux, najmä Ubuntu, práca s BASH scriptami...)</p>
            <div class="os-zoznam">
                <table class="os-tables">
                    <tr>
                        <td><img src="images/about-me/os/windows.png" alt="Windows" title="Windows"></td>
                        <td><img src="images/about-me/os/linux.png" alt="Linux" title="Linux"></td>

                    </tr>
                </table>
            </div>

            <hr>

            <p class="contactParagraph"> V prípade akýchkoľvek otázok ma môžte kontaktovať na</p>

                <div class="contactOverlay">
                    <img class="contactGmailLogo" alt="gmail-logovvvvvvvvvvvvvvvvvvvvvvvvvvvv" src="images/about-me/gmail-logo.png">
                    <p class="hiddenContactText">imorudolf@gmail.com</p>
                </div>




        </article>

    </div>

</div>

<footer>
    <p> Vytvoril: Rudolf Šimo - 2020 </p>
</footer>

</body>

</html>