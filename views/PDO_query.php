<?php


/**
 * Retourne les résultats d'une requête sql
 */
function PDO_query($sql_query)
{
    $configs = include('config.php');
    $host = $configs['host'];
    $dbname = $configs['dbname'];
    $username = $configs['username'];
    $password = $configs['password'];

    // Tentative de connexion à la base de données
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
       // echo "<br>Connexion OK on $dbname at $host.<br>";
    } catch (PDOException $e) {
       echo "A problem occured while connecting to database $host : " . $e->getMessage();
        return false;
    }

    // Requête
    $qu = $conn->query($sql_query);
    if ($qu != false) {
        $qu->setFetchMode(PDO::FETCH_ASSOC);
    }
    return $qu;
}
// Retourne un objet PDO pour exécuter des requêtes préparées
function getPDO(){
    $configs = include('config.php');
    $host = $configs['host'];
    $dbname = $configs['dbname'];
    $username = $configs['username'];
    $password = $configs['password'];

    // Tentative de connexion à la base de données
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
       // echo "<br>Connexion OK on $dbname at $host.<br>";
    } catch (PDOException $e) {
       echo "A problem occured while connecting to database $host : " . $e->getMessage();
       
    }
    return $conn;
}
