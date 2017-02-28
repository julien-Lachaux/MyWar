<?php
session_start();
include('../lib.php');


// ressource

$req = $bdd->query("
    SELECT p.pseudo pseudo, r.gold gold, r.wood wood, r.stone stone, r.iron iron
    FROM player p
    INNER JOIN ressources r ON p.id = r.playerID");
while($donnee = $req->fetch()) {
    if ($_GET['pseudo'] == $donnee['pseudo']) {
        echo $_GET['pseudo'];
        echo '
            <ul>
                <p>ressource :</p> 
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
    if ($_GET['pseudo'] == $donnee['pseudo']) {
        echo '
            <ul>
                <p>Troupes :</p> 
                <li>conscrit: '. $donnee['conscrit'] . '</li>
                <li>soldat: ' . $donnee['soldat'] . '</li>
                <li>archer: ' . $donnee['archer'] . '</li>
                <li>chevalier: ' . $donnee['chevalier'] . '</li>
            </ul>';
    } 
}