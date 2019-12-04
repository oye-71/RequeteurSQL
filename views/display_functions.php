<?php

/**
 * Affichage du formulaire pour la requête SELECT
 */
function displaySelectForm($type)
{
    ?>
    <h1>Research by : <?php echo $type; ?></h1>
    <form class="request-form" method="post" action="index.php">
        <!-- listes des tables et des propriétés à faire dynamiquement avec une requête -->
        <select name="table">
            <option value="none">None</option>
            <option value="actor">Actor</option>
            <option value="address">Address</option>
            <option value="category">Category</option>
            <option value="city">City</option>
            <option value="country">Country</option>
        </select>
        <input class="text-input" type="text" name="content" placeholder="What are you thinking about ?">
        <input type="submit" name="request" value="Request">
    </form>
<?php
}

/**
 * Affichage d'un tableau de résultats en fonction de la requête envoyée
 */
function displayRequestResults($queryResult)
{
    ?>
    <br/>
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