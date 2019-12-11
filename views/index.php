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
            <label class="header-label">Search by :</label>
            <input class="red-button" type="submit" name="select" value="Films">
            <input class="red-button" type="submit" name="select" value="Authors">
            <input class="red-button" type="submit" name="select" value="Languages">
            <input class="red-button" type="submit" name="select" value="Categories">
            <!-- TODO : Editer la classe du label pour avoir plus d'espace dans la navbar 
                        Générer uun formulaire pour les 3 autres options -->
            <label class="header-label"> Other options : </label>
            <input class="red-button" type="submit" name="insert" value="Add in database">
            <input class="red-button" type="submit" name="alter" value="Edit in database">
            <input class="red-button" type="submit" name="delete" value="Delete in database">

        </form>
    </header>
    <div class="container">
        <?php
        if (isset($_POST)) {
            if (isset($_POST["select"])) {
                displaySelectForm($_POST["select"]);
            } else if (isset($_POST["insert"]) || isset($_POST["continue_insert"])) {
                displayInsertForm();
            } else if (isset($_POST["alter"]) || isset($_POST["continue_alter"])) {
                displayUpdateForm();
            } else if (isset($_POST["delete"]) || isset($_POST["continue_delete"])) {
                displayDeleteForm();
            } else if (isset($_POST["request"])) {
                // Définition de la requête envoyée à la base
                // TODO : Faire les requetes sur mesure
                $queryToSend = buildSelectQuery(($_POST['content']));
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
            }
        }
        ?>
    </div>
</body>