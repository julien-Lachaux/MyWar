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
                <?php
                    $req = $bdd->query("
                        SELECT p.pseudo, b.mine mine, b.scierie scierie
                        FROM batiments b
                        INNER JOIN player p ON p.id = b.playerID
                    ");
                     while($donnee = $req->fetch()) {
                        if($donnee['pseudo'] == $_SESSION['pseudo']) {
                            echo '<li>mine d\'or lvl : ' . $donnee['mine'] . '</li>';
                            echo '<li>scierie lvl : ' . $donnee['scierie'] . '</li>';
                        }
                    }                                         
                ?>
                <?php
                    $req = $bdd->query("
                    SELECT p.pseudo, b.mine mine, b.scierie scierie
                    FROM batiments b
                    INNER JOIN player p ON p.id = b.playerID
                    ");
                    while($donnee = $req->fetch()) {
                        if($donnee['pseudo'] == $_SESSION['pseudo']) {
                            echo '<li>mine d\'or :<a class="batiment" href="../lib/php/Component/buyBatiment.php?batiment=mine&prix=500">Investir</a></li>';
                            echo '<li>scierie :<a class="batiment" href="../lib/php/Component/buyBatiment.php?batiment=scierie&prix=500">Investir</a></li>';
                        }
                    }
                ?>
                    <script src="lib/js/component/batiment.js"></script>
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