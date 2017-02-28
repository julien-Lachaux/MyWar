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
                    <button id="conscrit" href="../lib/php/Component/buyUnit.php?unit=conscrit&nbr=1&prix=10&armee=<?php echo $donnee['conscrit']; ?>">acheter conscrit</button>
                    <button id="soldat" href="../lib/php/Component/buyUnit.php?unit=soldat&nbr=1&prix=20&armee=<?php echo $donnee['soldat']; ?>">acheter soldat</button>
                    <button id="archer" href="../lib/php/Component/buyUnit.php?unit=archer&nbr=1&prix=20&armee=<?php echo $donnee['archer']; ?>">acheter archer</button>
                    <button id="chevalier" href="../lib/php/Component/buyUnit.php?unit=chevalier&nbr=1&prix=100&armee=<?php echo $donnee['chevalier']; ?>">acheter chevalier</button>  
                    <script src="../lib/js/component/menu.js"></script>
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

