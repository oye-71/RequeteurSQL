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
            <input class="red-button" type="submit" name="alter" value="Edit in database">
            <input class="red-button" type="submit" name="delete" value="Delete in database">
        </form>
    </header>
    <div class="container">
        <?php
        if (isset($_POST)) {
            if (isset($_POST["select"]) || isset($_POST["continue_select"])) {
                displaySelectForm();
            } else if (isset($_POST["insert"]) || isset($_POST["continue_insert"])) {
                displayInsertForm();
            } else if (isset($_POST["alter"]) || isset($_POST["continue_alter"])) {
                displayUpdateForm();
            } else if (isset($_POST["delete"]) || isset($_POST["continue_delete"])) {
                displayDeleteForm();
            } else if (isset($_POST["film_select"])) {
                // Définition de la requête envoyée à la base
                // TODO : Faire les requetes sur mesure
                $queryToSend = buildSelectQuery("title", ($_POST['content']));
                $queryResult = PDO_query($queryToSend);
                echo "<br />Requête exécutée : ";
                ?>
                <div class="code">
                    <?php echo $queryToSend ?>
                </div>
                <br />
        <?php
                echo "Résultats de la requête dans la table <b>" . "films"/*$_POST['table']*/ . "</b> pour la recherche <b>" . $_POST['content'] . "</b>:<br/>";

                if ($queryResult != false) {
                    displayRequestResults($queryResult);
                } else {
                    echo "Pas de résultat pour cette table.";
                }
            } else if (isset($_POST["actor_insert"])) {
                if(buildInsertQueryActor($_POST['first_name'], $_POST['last_name'])){
                    echo "Actor inserted.";
                } else {
                    echo "An arror occured.";
                }
            } else if (isset($_POST["category_insert"])) {
                if(buildInsertQueryCategory($_POST['name'])){
                    echo "Category inserted.";
                } else {
                    echo "An error occured.";
                }
            } else if (isset($_POST["film_insert"])) {
                // TODO FILM
            } else if (isset($_POST["language_insert"])) {
                if(buildInsertQueryLanguage($_POST['name'])){
                    echo "Language inserted.";
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