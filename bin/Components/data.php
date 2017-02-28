<?php
include('../lib/php/lib.php');
echo '<ul class="userData">
    <li><a href="profil.php">' . $_SESSION['pseudo'] . '</a></li>
    <li><a href="../lib/php/users/disconnect.php">deconnexion</a></li>
</ul>';
// ressource

$req = $bdd->query("
    SELECT p.pseudo pseudo, r.gold gold, r.wood wood, r.stone stone, r.iron iron
    FROM player p
    INNER JOIN ressources r ON p.id = r.playerID");
while($donnee = $req->fetch()) {
    if ($_SESSION['pseudo'] == $donnee['pseudo']) {
        echo '
            <ul class="ressourceData">
                <p class="dataTitle">Ressources</p> 
                <li>or: '. $donnee['gold'] . '</li>
                <li>bois: ' . $donnee['wood'] . '</li>
                <li>pierre: ' . $donnee['stone'] . '</li>
                <li>fer: ' . $donnee['iron'] . '</li>
            </ul>';
    }
}

// armee

$req = $bdd->query("
    SELECT p.pseudo pseudo, u.conscrit conscrit, u.soldat soldat, u.archer archer, u.chevalier chevalier
    FROM player p
    INNER JOIN unit u ON p.id = u.playerID");
while($donnee = $req->fetch()) {
    if ($_SESSION['pseudo'] == $donnee['pseudo']) {
        echo '
            <ul class="unitData">
                <p class="dataTitle">Troupes</p> 
                <li>conscrit: '. $donnee['conscrit'] . '</li>
                <li>soldat: ' . $donnee['soldat'] . '</li>
                <li>archer: ' . $donnee['archer'] . '</li>
                <li>chevalier: ' . $donnee['chevalier'] . '</li>
            </ul>';
    } 
}