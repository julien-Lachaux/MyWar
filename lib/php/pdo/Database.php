<?php

try
{
    $bdd = new PDO('mysql:host=localhost; dbname=mywar', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch (Exception $e)
{
    die('ERREUR :' . $e->getMessage());
}
























