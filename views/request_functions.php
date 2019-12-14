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