<?php

/**
 * Construction d'une requête SELECT
 */
function buildSelectQuery($arguments)
{
    $wordsAsArray = explode(" ", $arguments);
    $addToRequest = "";
    foreach ($wordsAsArray as $word) {
        $addToRequest = $addToRequest . " AND film.title LIKE '%$word%'";
    }
    $queryToSend = "SELECT * FROM " . "film" . " WHERE 1=1 " . $addToRequest;
    return $queryToSend;
}

/**
 * Construction d'une requête INSERT
 */
function buildInsertQuery($arguments)
{
    return;
}

/**
 * Construction d'une requête UPDATE
 */
function buildUpdateQuery($arguments)
{
    return;
}

/**
 * Construction d'une requête DELETE
 */
function buildDeleteQuery($arguments)
{
    return;
}
