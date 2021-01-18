<?php session_start(); ?>

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
                   <!-- <li><a class="navbar-item" href="order.php">Objednávky</a></li> -->
                     <li><a class="mdc-icon-button material-icons navbar-item admin-nav-icon" title="Admin Panel"  href="admin.php">admin_panel_settings</a></li>

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
                                            <a href="profile.php"> <p>' . $_SESSION['userLogin'] . ' </p></a>
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
                                    <input type="password" id="password" name="password" placeholder="min. 8 char.">
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