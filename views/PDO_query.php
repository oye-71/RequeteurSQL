<?php

/**
 * Retourne le résultat d'une requête envoyée à la base de donnée Sakila
 */
function PDO_query($sql_query)
{
    $host = "localhost";
    $dbname = "sakila";
    $username = "root";
    $password = "";

    // Tentative de connexion à la base de données
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        echo "<br>Connexion OK sur $dbname chez $host.<br>";
    } catch (PDOException $e) {
        echo "Un problème a été rencontré lors de la connexion à la base de données $host : " . $e->getMessage();
        return false;
    }

    // Requête
    $qu = $conn->query($sql_query);
    if ($qu != false) {
        $qu->setFetchMode(PDO::FETCH_ASSOC);
    }
    return $qu;
}
