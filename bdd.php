<?php

function getBdd() 
{
    $user = 'root';
    $pass = '';
    $bdd = new PDO('mysql:host=localhost;dbname=super;charset=utf8', $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
}

function getFamille() {
    $bdd = getBdd();
    return $bdd->query('SELECT id_famille, nom_famille FROM famille ORDER BY id_famille');
    $familles = $req->fetchAll(PDO::FETCH_OBJ); 
    
    // Ferme le curseur
    $req->closeCursor();

    return $familles;
}

