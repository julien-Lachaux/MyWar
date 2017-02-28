<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="../assets/css/app.css" rel="stylesheet" type="text/css">
        <script src="../lib/js/ajax/_ajaxRequest.js"></script>
    </head>
    <body>
        <div class="app">
        <?php
        if(isset($_SESSION['id']) and $_SESSION['id'] != "") { ?>
            <div class="data">
                <?php include('Components/data.php'); ?>
            </div>
            <div class="flux">
                <?php include('Components/menu.php'); ?>
                <article class="dynamicContent">
                </article>
            </div>
        <?php
        }
        else {
        ?>
            <div id="content">
                <p>Connecte toi :</p>
                <form method="post" action="../lib/php/users/connection.php">
                    <fieldset>
                        <legend>info de connnexion</legend>
                        <label>pseudo :</label>
                        <input type="text" name="pseudo" required>
                        <label>mot de passe :</label>
                        <input type="text" name="mdp" required>
                    </fieldset>
                    <input type="submit" value="se connecter">
                </form>
            </div>
        <?php
        }
        ?>
        </div>
    </body>
</html>