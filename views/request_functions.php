<?php

/**
 * Construction d'une requête SELECT
 */
function buildSelectQuery($table, $arguments)
{
    $wordsAsArray = explode(" ", $arguments);
    $addToRequest = "";
    foreach ($wordsAsArray as $word) {
        $addToRequest = $addToRequest . " AND $table LIKE '%$word%' ";
    }
    $queryToSend = "SELECT f.title as title, f.description as description, l.name as language, c.name as category, f.rental_rate as price
    FROM film AS f
    INNER JOIN language AS l ON (l.language_id = f.language_id)
    INNER JOIN film_category AS fc ON (fc.film_id = f.film_id)
    INNER JOIN category AS c ON (c.category_id = fc.category_id)
    WHERE 1=1" . $addToRequest .
        "GROUP BY title";
    return $queryToSend;
}

/**
 * Construction d'une requête INSERT pour la table actor
 */
function buildInsertQueryActor($first_name, $last_name)
{
    $queryToSend = "INSERT INTO actor (first_name, last_name) VALUES ('$first_name', '$last_name');";
    if (PDO_query($queryToSend) != false) {
        return true;
    } else {
        return false;
    }
}

/**
 * Construction d'une requête INSERT pour la table category
 */
function buildInsertQueryCategory($name)
{
    $queryToSend = "INSERT INTO category (name) VALUES ('$name');";
    if (PDO_query($queryToSend) != false) {
        return true;
    } else {
        return false;
    }
}

/**
 * Construction d'une requête INSERT pour la table film
 */
function buildInsertQueryFilm($title, $description, $release_year, $language_id, $rental_duration, $rental_rate, $replacement_cost, $category_id, $actor_id)
{
    $queryToSend = "INSERT INTO film (title, description, release_year, language_id, rental_duration, rental_rate, replacement_cost) 
    VALUES ('$title', '$description', $release_year, $language_id, $rental_duration, $rental_rate, $replacement_cost);";
    if ($q = PDO_query($queryToSend) != false) {
        $newInsertedFilmData = $q->fetch();
        $filmId = $newInsertedFilmData['film_id'];
        $actorQuery = "INSERT INTO film_actor (actor_id, film_id) VALUES ($actor_id, $filmId);";
        $categoryQuery = "INSERT INTO film_category (film_id, category_id) VALUES ($filmId, $category_id);";
    } else {
        return false;
    }
    return $queryToSend;
}

/**
 * Construction d'une requête INSERT pour la table language
 */
function buildInsertQueryLanguage($name)
{
    $queryToSend = "INSERT INTO language (name) VALUES ('$name');";
    if (PDO_query($queryToSend) != false) {
        return true;
    } else {
        return false;
    }
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


/**
 * Affichage d'un tableau de résultats en fonction de la requête envoyée
 * 
 * @param mixed $queryResult Résultat d'une requête PDO.
 */
function displayRequestResults($queryResult)
{
    ?>
    <br />
    <table class="results-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Language</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row = $queryResult->fetch()) :
                    ?>
                <tr class="row">
                    <td class="td-15"><?php echo htmlspecialchars($row['title']) ?></td>
                    <td class="td-50"><?php echo htmlspecialchars($row['description']) ?></td>
                    <td class="td-15"><?php echo htmlspecialchars($row['category']) ?></td>
                    <td class="td-10"><?php echo htmlspecialchars($row['language']) ?></td>
                    <td class="td-10 price"><?php echo htmlspecialchars($row['price']) ?></td>
                </tr>
            <?php
                endwhile;
                ?>
        </tbody>
    </table>
<?php
}
?>