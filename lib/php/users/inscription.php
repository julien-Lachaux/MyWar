<?php
include('../lib.php');
try {
    $req = $bdd->prepare('INSERT INTO player (pseudo, mdp) VALUES(?, ?, ?)');
    $req->execute(array($_POST['pseudo'], $_POST['mdp']));
    header('Location: ../index.php');
}
catch (Exception $e) {
    die($e->getMessage());
}
