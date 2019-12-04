<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../src/css/requeteurcss.css">
</head>

<body>
    <header>
        <form method="post" action="index.php">
            <label class="header-label">Search by :</label>
            <input class="header-button" type="submit" name="select" value="Films">
            <input class="header-button" type="submit" name="select" value="Authors">
            <input class="header-button" type="submit" name="select" value="Languages">
            <input class="header-button" type="submit" name="select" value="Categories">
        </form>
    </header>
    <div class="container">
        <br />
        <?php
        require 'display_functions.php';
        require 'PDO_query.php';
        if (isset($_POST)) {
            if (isset($_POST["select"])) {
                displaySelectForm($_POST["select"]);
            } else if (isset($_POST["request"])) {
                echo "Requête en cours...<br/>";
                $queryResult = PDO_query("SELECT * FROM " . "film"/*$_POST['table']*/ . " LIMIT 10;");
                echo "Résultats de la requête dans la table <b>" . $_POST['table'] . "</b> :<br/>";
                if ($queryResult != false) {
                    displayRequestResults($queryResult);    
                } else {
                    echo "Pas de résultat pour cette table";
                }
            }
        }
        ?>
    </div>
</body>