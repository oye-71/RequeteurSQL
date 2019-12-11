<?php

/**
 * Affichage du formulaire pour la requête SELECT
 * 
 * @param mixed $type String contenant le type de requête que l'on va effectuer
 */
function displaySelectForm($type)
{
    ?>
    <h1>Research by : <?php echo $type; ?></h1>
    <form class="request-form" method="post" action="index.php">
        <input class="text-input" type="text" name="content" placeholder="What are you thinking about ?">
        <br /><br />
        <input class="red-button" type="submit" name="request" value="Request">
    </form>
<?php
}

/**
 * Affichage du formulaire pour la requête INSERT
 */
function displayInsertForm()
{
    ?>
    <h1>Insert into database :</h1>
    <?php
        if (!isset($_POST["continue_insert"])) {
            ?>
        <form class="request-form" method="post" action="index.php">
            <label> Table : </label>
            <select name="table">
                <option value="actor">Actor</option>
                <option value="category">Category</option>
                <option value="film">Film</option>
                <option value="language">Language</option>
            </select>
            <br />
            <input class="red-button" type="submit" name="continue_insert" value="Continue">
            <?php
                } else {
                    switch ($_POST["table"]) {
                        case 'actor':
                            ?><?php
                                            break;
                                        case 'category':
                                            ?><?php
                                                            break;
                                                        case 'film':
                                                            ?><?php
                                                                            break;
                                                                        case 'language':
                                                                            ?><?php
                                                                                            break;
                                                                                    }
                                                                                }
                                                                                ?>
        <?php
        }

        /**
         * Affichage du formulaire pour la requête ALTER
         */
        function displayUpdateForm()
        {
            ?>
            <h1>Edit values into database :</h1>

        <?php
        }

        /**
         * Affichage du formulaire pour la requête DELETE
         */
        function displayDeleteForm()
        {
            ?>
            <h1>Delete into database :</h1>
        <?php
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
                        <th>Rating</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = $queryResult->fetch()) {
                            ?>
                        <tr class="row">
                            <td class="td-15"><?php echo htmlspecialchars($row['title']) ?></td>
                            <td class="td-50"><?php echo htmlspecialchars($row['description']) ?></td>
                            <td class="td-15"><?php echo htmlspecialchars('unknown') ?></td>
                            <td class="td-10"><?php echo htmlspecialchars($row['rating']) ?></td>
                            <td class="td-10 price"><?php echo htmlspecialchars($row['rental_rate']) ?></td>
                        </tr>
                    <?php
                        } ?>
                </tbody>
            </table>
        <?php
        }
        ?>