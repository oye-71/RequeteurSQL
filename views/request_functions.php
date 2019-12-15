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
    $queryToSend = "SELECT f.film_id as id, f.title as title, f.description as description, l.name as language, c.name as category, f.rental_rate as price
    FROM film AS f
    INNER JOIN language AS l ON (l.language_id = f.language_id)
    INNER JOIN film_category AS fc ON (fc.film_id = f.film_id)
    INNER JOIN category AS c ON (c.category_id = fc.category_id)
    WHERE 1=1 $addToRequest 
    GROUP BY title";
    return $queryToSend;
}

function buildSimpleSelectQuery($table)
{
    switch ($table) {
        case 'category':
            return "select category_id,name from category";
        case 'Actor':
            break;
        default:
            break;
    }
}

/**
 * Construction d'une requête INSERT pour la table actor
 */
function buildInsertQueryActor($first_name, $last_name)
{
    $pdo = getPDO();
    $queryToSend = "INSERT INTO actor (first_name, last_name) VALUES (:first_name, :last_name);";
    displayQuery($queryToSend);
    $stmt = $pdo->prepare($queryToSend);
    if ($stmt->execute(array(
        "first_name" => $first_name,
        "last_name" => $last_name
    )) != false) {
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
    $pdo = getPDO();
    $queryToSend = "INSERT INTO category (name) VALUES (:name);";
    displayQuery($queryToSend);
    $stmt = $pdo->prepare($queryToSend);
    if ($stmt->execute(array("name" => $name)) != false) {
        return true;
    } else {
        return false;
    }
}

/**
 * Construction d'une requête INSERT pour la table film.
 * Insère aussi dans les tables de clés étrangères pour l'acteur et la catégorie.
 */
function buildInsertQueryFilm($title, $description, $release_year, $language_id, $rental_duration, $rental_rate, $replacement_cost, $category_id, $actor_id)
{
    $pdo = getPDO();
    $queryToSend = "INSERT INTO film (title, description, release_year, language_id, rental_duration, rental_rate, replacement_cost) 
    VALUES (:title, :description, :release_year, :language_id, :rental_duration, :rental_rate, :replacement_cost);";
    displayQuery($queryToSend);
    $stmt = $pdo->prepare($queryToSend);
    $stmt->bindParam(":title", $title, PDO::PARAM_STR);
    $stmt->bindParam(":description", $description, PDO::PARAM_STR);
    $stmt->bindParam(":release_year", $release_year, PDO::PARAM_INT);
    $stmt->bindParam(":language_id", $language_id, PDO::PARAM_INT);
    $stmt->bindParam(":rental_duration", $rental_duration, PDO::PARAM_INT);
    $stmt->bindParam(":rental_rate", $rental_rate, PDO::PARAM_INT);
    $stmt->bindParam(":replacement_cost", $replacement_cost, PDO::PARAM_INT);
    if ($stmt->execute() != false) {
        $newInsertedFilmData = PDO_query("SELECT film_id FROM film WHERE film.title = '$title'")->fetch();
        $filmId = $newInsertedFilmData['film_id'];
        $actorQuery = "INSERT INTO film_actor (actor_id, film_id) VALUES (:actor_id, :film_id);";
        $stmt = $pdo->prepare($actorQuery);
        $stmt->bindParam(":actor_id", $actor_id, PDO::PARAM_INT);
        $stmt->bindParam(":film_id", $filmId, PDO::PARAM_INT);
        displayQuery($actorQuery);
        if ($stmt->execute() != false) {
            $categoryQuery = "INSERT INTO film_category (film_id, category_id) VALUES (:film_id, :category_id);";
            displayQuery($categoryQuery);
            $stmt = $pdo->prepare($categoryQuery);
            $stmt->bindParam(":category_id", $category_id, PDO::PARAM_INT);
            $stmt->bindParam(":film_id", $filmId, PDO::PARAM_INT);
            if ($stmt->execute() != false) {
                return true;
            } else {
                echo "Error while inserting category.<br>";
                return false;
            }
        } else {
            echo "Error while inserting actor.<br>";
            return false;
        }
    } else {
        echo "Error while inserting film.<br>";
        return false;
    }
    return $queryToSend;
}

/**
 * Construction d'une requête INSERT pour la table language
 */
function buildInsertQueryLanguage($name)
{
    $pdo = getPDO();
    $queryToSend = "INSERT INTO language (name) VALUES (:name);";
    displayQuery($queryToSend);
    $stmt = $pdo->prepare($queryToSend);
    if ($stmt->execute(array("name" => $name)) != false) {
        return true;
    } else {
        return false;
    }
}

/**
 * Construction d'une requête DELETE
 */
function buildAndExecuteDeleteQuery($id)
{

    $pdo = getPDO();
    try {
        $stmt = $pdo->prepare("DELETE FROM film_actor WHERE film_id= :id; DELETE FROM inventory WHERE film_id= :id;DELETE FROM film_category WHERE film_id= :id;DELETE FROM film WHERE film_id= :id;");
        $stmt->execute(array(
            'id' => $id
        ));
        return true;
    } catch (PDOException $e) {
        echo "A problem occured while executing query " . $e->getMessage();
        return false;
    }
}

function buildAndExecuteUpdateQuery($row)
{
    //$queryToSend = "Update film SET title = '".$row['title']."', description = '".$row['description']."' WHERE film_id = ".$row['id'] ;
    $pdo = getPDO();
    try {
        $stmt = $pdo->prepare('UPDATE film SET title = :title , description = :description WHERE film_id = :id');
        $stmt->execute(array(
            'title' => $row['title'],
            'description' => $row['description'],
            'id' => $row['id']
        ));
        return true;
    } catch (PDOException $e) {
        echo "A problem occured while executing query " . $e->getMessage();
        return false;
    }
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
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $queryResult->fetch()) :
                        ?>
                    <form class="request-form" method="post" action="index.php">
                        <tr class="row">
                            <td class="td-15"><?php echo htmlspecialchars($row['title']) ?></td>
                            <input type="hidden" name="title" value="<?php echo htmlspecialchars($row['title']) ?>" />
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']) ?>" />
                            <td class="td-50"><?php echo htmlspecialchars($row['description']) ?></td>
                            <input type="hidden" name="description" value="<?php echo htmlspecialchars($row['description']) ?>" />
                            <td class="td-15"><?php echo htmlspecialchars($row['category']) ?></td>
                            <input type="hidden" name="category" value="<?php echo htmlspecialchars($row['category']) ?>" />
                            <td class="td-10"><?php echo htmlspecialchars($row['language']) ?></td>
                            <input type="hidden" name="language" value="<?php echo htmlspecialchars($row['language']) ?>" />
                            <td class="td-10 price"><?php echo htmlspecialchars($row['price']) ?></td>
                            <input type="hidden" name="price" value="<?php echo htmlspecialchars($row['price']) ?>" />
                            <td><input class="red-button" type="submit" name="edit_row" value="Edit"></td>
                            <td><input class="red-button" type="submit" name="delete_row" value="Delete"></td>
                        </tr>
                    </form>

                <?php
                    endwhile;
                    ?>
            </tbody>
        </table>
    <?php
    }
    ?>