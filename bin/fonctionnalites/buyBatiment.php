<?php
session_start();
include('../../lib/php/lib.php');


$req = $bdd->prepare("
    SELECT r.gold gold, r.wood wood, r.stone stone, r.iron iron, b.mine mine, b.scierie scierie
    FROM player p
    INNER JOIN ressources r ON p.id = r.playerID
    INNER JOIN batiments b ON r.playerID= b.playerID
    WHERE p.id = :id");
$req->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
$req->execute();

while($donnee = $req->fetch())
{
    if (isset($_GET['batiment'])) {
        $prix = (int)$_GET['prix'];
        $bat = $_GET['batiment'];
        $solde = (int)$donnee['gold'];
        $depense = ($solde - $prix);

        if ($depense < 0) {
            echo 'echec achat';
        }else {
            $req2 = $bdd->prepare('UPDATE ressources SET gold = gold - :prix WHERE playerID = :id');
            $req2->bindValue(':prix', $_GET['prix'], PDO::PARAM_STR);
            $req2->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
            $req2->execute();
            if($bat == 'mine') {
                $req3 = $bdd->prepare('UPDATE batiments SET mine = mine + 1 WHERE playerID = :id');
                $req3->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
                $req3->execute();
            } else if($bat == 'scierie') {
                $req4 = $bdd->prepare('UPDATE batiments SET scierie = scierie + 1 WHERE playerID = :id');
                $req4->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
                $req4->execute();
            }
            
        }
    }
}
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