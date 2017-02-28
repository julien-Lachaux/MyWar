<?php session_start();
include('../lib.php');

if(!empty($_POST['pseudo']) && !empty($_POST['mdp'])){
	
	try {
		$pseudo = $_POST['pseudo'];
		$mdp = $_POST['mdp'];
		$req = $bdd->query('SELECT * FROM player WHERE pseudo="' . $pseudo . '"'); 
		$rep = $req->fetch();
	} catch (Exception $e) {
		die($e->getMessage());
	}			
    if($rep['mdp'] == $mdp){
        $_SESSION['id'] = $rep['id'];
        $_SESSION['pseudo'] = $rep['pseudo'];
        header('Location: ../../../bin/royaume.php');
} else header('Location: ../../../bin/404.php');
	
} else header('Location: ../../../bin/404.php');