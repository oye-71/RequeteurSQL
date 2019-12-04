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
?>