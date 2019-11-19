<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <h1>Choisissez la requête voulue</h1>
    <div class="container">
    <form method="post" action="index.php">
        <input type="submit" name="select" value="SELECT">
        <input type="submit" name="insert" value="INSERT">
        <input type="submit" name="delete" value="DELETE">
        <input type="submit" name="update" value="UPDATE">
    </form>
    <br/>
    <?php
    require 'display_functions.php';
        if(isset($_POST))
        {
            if(isset($_POST["select"])){
                displaySelectForm();
            }
            else if(isset($_POST["insert"])){
                displayInsertForm();
            }
            else if(isset($_POST["delete"])){
                displayDeleteForm();
            }
            else if(isset($_POST["update"])){
                displayUpdateForm();
            }
            else if (isset($_POST["submit_select"]) || isset($_POST["submit_insert"]) || isset($_POST["submit_delete"]) || isset($_POST["submit_update"])){
                echo "Requête en cours...<br/>";
                echo "Résultats de la requête dans la table <b>".$_POST['table']."</b> :";
            }
        }
    ?>
    </div>
</body>