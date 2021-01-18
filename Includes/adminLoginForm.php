
<form class="admin-login" action="includes/LoginScript.php" method="post">
            <ul>
                Nie ste prihlásený! Pre prístup do Admin Panelu sa musíte najprv prihlásiť!
                <li>
                    <label for="login">Prihlasovacie Meno</label>
                    <input type="text" id="login" name="login" placeholder="User Name">
                </li>
                <li>
                    <label for="password">Prihlasovacie Heslo</label>
                    <input type="password" id="password" name="password" placeholder="min. 8 char.">
                </li>
                <li>
                    <input type="submit" name="login-proceed">
                </li>
            </ul>
        </form>