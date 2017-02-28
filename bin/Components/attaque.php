<?php
session_start();
include('../../lib/php/lib.php');

$req = $bdd->query("
    SELECT p.id id, p.pseudo pseudo, u.conscrit conscrit, u.soldat soldat, u.archer archer, u.chevalier chevalier
    FROM player p
    INNER JOIN unit u ON p.id = u.playerID
");

while($donnee = $req->fetch()) {
    // je recupere la puissance defensive
    if ($donnee['pseudo'] == $_GET['cible']) {
        $DEFconscrit = (int)$donnee['conscrit'] * 5;
        $DEFsoldat = (int)$donnee['soldat'] * 15;
        $DEFarcher = (int)$donnee['archer'] * 20;
        $DEFchevalier = (int)$donnee['chevalier'] * 50;
        
        $defPVconscrit = (int)$donnee['conscrit'] * 5;
        $defPVsoldat = (int)$donnee['soldat'] * 20;
        $defPVarcher = (int)$donnee['archer'] * 10;
        $defPVchevalier = (int)$donnee['chevalier'] * 35;
        
        $defUnit = $DEFconscrit + $DEFsoldat + $DEFarcher + $DEFchevalier;
        $defPlayer = $donnee['id'];
        echo $donnee['pseudo'] . ' a un score de defence de ' . $defUnit . '<br/>';
    }
    // je recupere la puissance offensive
    else if ($donnee['pseudo'] == $_SESSION['pseudo']) {
        $ATKconscrit = (int)$donnee['conscrit'] * 5;
        $ATKsoldat = (int)$donnee['soldat'] * 15;
        $ATKarcher = (int)$donnee['archer'] * 20;
        $ATKchevalier = (int)$donnee['chevalier'] * 50;
        
        $atkPVconscrit = (int)$donnee['conscrit'] * 5;
        $atkPVsoldat = (int)$donnee['soldat'] * 20;
        $atkPVarcher = (int)$donnee['archer'] * 10;
        $atkPVchevalier = (int)$donnee['chevalier'] * 35;
        
        $atkUnit = $ATKconscrit + $ATKsoldat + $ATKarcher + $ATKchevalier;
        $atkPlayer = $donnee['id'];
        echo $donnee['pseudo'] . ' a un score d\'attaque de ' . $atkUnit;
    }
}
$result = $atkUnit - $defUnit;

if($result > 0) {
    echo '<p>Feliciation vous avez gagner</p>';
}else {
    echo '<p>Perdu</p>';
}
while($defUnit > 0) {
    if ($atkPVconscrit >= 5) {
        $defUnit -= 5;
        $atkPVconscrit -= 5;
    }else if ($atkPVsoldat >= 20) {
        $defUnit -= 20;
        $atkPVsoldat -= 20;
    }else if ($atkPVarcher >= 10) {
        $defUnit -= 10;
        $atkPVarcher -= 10;
    }else if ($atkPVchevalier >= 35) {
        $defUnit -= 35;
        $atkPVchevalier -= 35;
    }else {
        break;
    }
}
$atkconscrit = round($atkPVconscrit / 5);
$atksoldat = round($atkPVsoldat / 20);
$atkarcher = round($atkPVarcher / 10);
$atkchevalier = round($atkPVchevalier / 35);

while($atkUnit > 0) {
    if ($defPVconscrit >= 5) {
        $atkUnit -= 5;
        $defPVconscrit -= 5;
    }else if ($defPVsoldat >= 15) {
        $atkUnit -= 15;
        $defPVsoldat -= 15;
    }else if ($defPVarcher >= 10) {
        $atkUnit -= 10;
        $defPVarcher -= 10;
    }else if ($defPVchevalier >= 35) {
        $atkUnit -= 35;
        $defPVchevalier -= 35;
    }else {
        break;
    }
}
$defconscrit = round($defPVconscrit / 5);
$defsoldat = round($defPVsoldat / 20);
$defarcher = round($defPVarcher / 10);
$defchevalier = round($defPVchevalier / 35);

$ATKperteConscrit = ($ATKconscrit / 5) - $atkconscrit;
$ATKperteSoldat = ($ATKsoldat / 15) - $atksoldat;
$ATKperteArcher = ($ATKarcher / 20) - $atkarcher;
$ATKperteChevalier = ($ATKchevalier / 50) - $atkchevalier;

$DEFperteConscrit = ($DEFconscrit / 5) - $defconscrit;
$DEFperteSoldat = ($DEFsoldat / 15) - $defsoldat;
$DEFperteArcher = ($DEFarcher / 20) - $defarcher;
$DEFperteChevalier = ($DEFchevalier / 50) - $defchevalier;
echo '
    <div class="rapport de bataille">
        <ul>
            <p><strong>Vos pertes :</strong></p>
            <li>Conscrit : ' . $ATKperteConscrit . '</li>
            <li>Soldat : ' . $ATKperteSoldat . '</li>
            <li>Archer : ' . $ATKperteArcher . '</li>
            <li>Chevalier : ' . $ATKperteChevalier . '</li>
        </ul>
        <ul>
            <p><strong>Les pertes enemie :</strong></p>
            <li>Conscrit : ' . $DEFperteConscrit . '</li>
            <li>Soldat : ' . $DEFperteSoldat . '</li>
            <li>Archer : ' . $DEFperteArcher . '</li>
            <li>Chevalier : ' . $DEFperteChevalier . '</li>
        </ul>
    </div>
';

$req = $bdd->prepare('UPDATE unit SET conscrit = :conscrit, soldat = :soldat, archer = :archer, chevalier = :chevalier WHERE playerID = :id');
$req->bindValue(':conscrit', $atkconscrit, PDO::PARAM_STR);
$req->bindValue(':soldat', $atksoldat, PDO::PARAM_STR);
$req->bindValue(':archer', $atkarcher, PDO::PARAM_STR);
$req->bindValue(':chevalier', $atkchevalier, PDO::PARAM_STR);
$req->bindValue(':id', $atkPlayer, PDO::PARAM_STR);
$req->execute();

$req = $bdd->prepare('UPDATE unit SET conscrit = :conscrit, soldat = :soldat, archer = :archer, chevalier = :chevalier WHERE playerID = :id');
$req->bindValue(':conscrit', $defconscrit, PDO::PARAM_STR);
$req->bindValue(':soldat', $defsoldat, PDO::PARAM_STR);
$req->bindValue(':archer', $defarcher, PDO::PARAM_STR);
$req->bindValue(':chevalier', $defchevalier, PDO::PARAM_STR);
$req->bindValue(':id', $defPlayer, PDO::PARAM_STR);
$req->execute();
