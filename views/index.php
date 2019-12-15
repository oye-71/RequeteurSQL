<?php
require 'display_functions.php';
require 'PDO_query.php';
require 'request_functions.php';
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../src/css/requeteurcss.css">
</head>

<body>
    <header>
        <form method="post" action="index.php">
            <input class="red-button" type="submit" name="home" value="Home">
            <input class="red-button" type="submit" name="select" value="Search in database">
            <input class="red-button" type="submit" name="insert" value="Add in database">
        </form>
    </header>
    <div class="container">
        <?php
        if (isset($_POST)) {
            if (isset($_POST["select"]) || isset($_POST["continue_select"])) {
                displaySelectForm();
            } else if (isset($_POST["insert"]) || isset($_POST["continue_insert"])) {
                displayInsertForm();
            } else if (isset($_POST["film_select"])) {
                // Définition de la requête envoyée à la base
                // TODO : Faire les requetes sur mesure
                $queryToSend = buildSelectQuery("title", ($_POST['content']));
                $queryResult = PDO_query($queryToSend);
                displayQuery($queryToSend);
                echo "Résultats de la requête dans la table <b>" . "films"/*$_POST['table']*/ . "</b> pour la recherche <b>" . $_POST['content'] . "</b>:<br/>";

                if ($queryResult != false) {
                    displayRequestResults($queryResult);
                } else {
                    echo "Pas de résultat pour cette table.";
                }
            } else if (isset($_POST["actor_insert"])) {
                if (buildInsertQueryActor(
                    $_POST['first_name'],
                    $_POST['last_name']
                )) {
                    echo "Actor inserted.";
                } else {
                    echo "An error occured.";
                }
            } else if (isset($_POST["category_insert"])) {
                if (buildInsertQueryCategory($_POST['name'])) {
                    echo "Category inserted.";
                } else {
                    echo "An error occured.";
                }
            } else if (isset($_POST["film_insert"])) {
                if (buildInsertQueryFilm(
                    $_POST['title'],
                    $_POST["description"],
                    $_POST["release_year"],
                    $_POST["language_id"],
                    $_POST["rental_duration"],
                    $_POST["rental_rate"],
                    $_POST["replacement_cost"],
                    $_POST["category_id"],
                    $_POST["actor_id"]
                )) {
                    echo "Film inserted.";
                } else {
                    echo "An error occured.";
                }
            } else if (isset($_POST["language_insert"])) {
                if (buildInsertQueryLanguage($_POST['name'])) {
                    echo "Language inserted.";
                } else {
                    echo "An error occured.";
                }
            } else if (isset($_POST['edit_row'])) {
                displayUpdateForm([
                    'id' => $_POST['id'],
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                ]);
            } else if (isset($_POST['update_row'])) {
                if (buildAndExecuteUpdateQuery([
                    'id' => $_POST['id'],
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                ])) {
                    echo "The film : " . $_POST['title'] . " was successfully updated !";
                } else {
                    echo "An error occured";
                }
            } else if (isset($_POST['delete_row'])) {
                if (buildAndExecuteDeleteQuery($_POST['id'])) {
                    echo "The film : " . $_POST['title'] . " was successfully deleted !";
                } else {
                    echo "An error occured.";
                }
            } else {
                ?>
                <h1>Welcome on Mathias and Etienne's SQL CRUD</h1>
        <?php
            }
        }
        ?>
    </div>
</body>