<?php
session_start();
include('../../lib/php/lib.php');


$req = $bdd->prepare("
    SELECT r.gold gold, r.wood wood, r.stone stone, r.iron iron, u.conscrit conscrit, u.soldat soldat, u.archer archer, u.chevalier chevalier
    FROM player p
    INNER JOIN ressources r ON p.id = r.playerID
    INNER JOIN unit u ON r.playerID= u.playerID
    WHERE p.id = :id");
$req->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
$req->execute();

while($donnee = $req->fetch())
{
    if (isset($_GET['unit'])) {
        $unit = $_GET['unit'];
        $nbr = (int)$_GET['nbr'];
        $prix = (int)$_GET['prix'];

        $solde = (int)$donnee['gold'];
        $depense = ($solde - ($nbr * $prix));
        $newNbr = $donnee[$unit] + $nbr;

        if ($depense < 0) {
            echo 'echec achat';
        }else {
            $req2 = $bdd->prepare('UPDATE ressources SET gold = :depense WHERE playerID = :id');
            $req2->bindValue(':depense', $depense, PDO::PARAM_STR);
            $req2->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
            $req2->execute();
            if($unit == 'conscrit') {
                $req3 = $bdd->prepare('UPDATE unit SET conscrit = :achat WHERE playerID = :id');
                $req3->bindValue(':achat', $newNbr, PDO::PARAM_STR);
                $req3->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
                $req3->execute();
            } else if($unit == 'soldat') {
                $req4 = $bdd->prepare('UPDATE unit SET soldat = :achat WHERE playerID = :id');
                $req4->bindValue(':achat', $newNbr, PDO::PARAM_STR);
                $req4->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
                $req4->execute();
            } else if($unit == 'archer') {
                $req5 = $bdd->prepare('UPDATE unit SET archer = :achat WHERE playerID = :id');
                $req5->bindValue(':achat', $newNbr, PDO::PARAM_STR);
                $req5->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
                $req5->execute();
            } else if($unit == 'chevalier') {
                $req6 = $bdd->prepare('UPDATE unit SET chevalier = :achat WHERE playerID = :id');
                $req6->bindValue(':achat', $newNbr, PDO::PARAM_STR);
                $req6->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
                $req6->execute();
            }
            
        }
    }
}

$req = $bdd->query("
    SELECT p.pseudo pseudo, r.gold gold, r.wood wood, r.stone stone, r.iron iron
    FROM player p
    INNER JOIN ressources r ON p.id = r.playerID");
while($donnee = $req->fetch()) {
    if ($_SESSION['pseudo'] == $donnee['pseudo']) {
        echo $_SESSION['pseudo'];
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
    if ($_SESSION['pseudo'] == $donnee['pseudo']) {
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