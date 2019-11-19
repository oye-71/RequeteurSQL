<?php
/**
 * Affichage du formulaire pour la requête SELECT
 */
function displaySelectForm()
{
    ?>
    <form method="post" action="index.php">
        <h3>Entrez le contenu de la requête :</h3>
        <label>SELECT * FROM</label>
        <!-- listes des tables et des propriétés à faire dynamiquement avec une requête -->
        <select name="table">
            <option value="none">None</option>
            <option value="actor">Actor</option>
            <option value="address">Address</option>
            <option value="category">Category</option>
            <option value="city">City</option>
            <option value="country">Country</option>
        </select>
        <label>WHERE</label>
        <input type="text" name="property1">
        <select>
            <option value="equals">=</option>
            <option value="higher">></option>
            <option value="lower"><</option>
        </select>
        <input type="text" name="property2">
        <br />
        <br />
        <input type="submit" name="submit_select" value="REQUETER">
    </form>
<?php
}

/**
 * Affichage du formulaire pour la requête INSERT
 */
function displayInsertForm()
{
    ?>
    <form method="post" action="index.php">
        <h3>Entrez le contenu de la requête :</h3>
        <label>INSERT INTO</label>
        <!-- listes des tables et des propriétés à faire dynamiquement avec une requête -->
        <select name="table">
            <option value="none">None</option>
            <option value="actor">Actor</option>
            <option value="address">Address</option>
            <option value="category">Category</option>
            <option value="city">City</option>
            <option value="country">Country</option>
        </select>
        <label>VALUES (</label>
        <input type="text" name="values">
        <label>)</label>
        <br />
        <br />
        <input type="submit" name="submit_insert" value="REQUETER">
    </form>
<?php
}

/**
 * Affichage du formulaire pour la requête DELETE
 */
function displayDeleteForm()
{
    ?>
    <form method="post" action="index.php">
        <h3>Entrez le contenu de la requête :</h3>
        <label>DELETE FROM</label>
        <!-- listes des tables et des propriétés à faire dynamiquement avec une requête -->
        <select name="table">
            <option value="none">None</option>
            <option value="actor">Actor</option>
            <option value="address">Address</option>
            <option value="category">Category</option>
            <option value="city">City</option>
            <option value="country">Country</option>
        </select>
        <label>WHERE</label>
        <input type="text" name="property1">
        <select>
            <option value="equals">=</option>
            <option value="higher">></option>
            <option value="lower"><</option>
        </select>
        <input type="text" name="property2">
        <br />
        <br />
        <input type="submit" name="submit_delete" value="REQUETER">
    </form>
<?php
}

/**
 * Affichage du formulaire pour la requête UPDATE
 */
function displayUpdateForm()
{
    ?>
    <form method="post" action="index.php">
        <h3>Entrez le contenu de la requête :</h3>
        <label>UPDATE</label>
        <!-- listes des tables et des propriétés à faire dynamiquement avec une requête -->
        <select name="table">
            <option value="none">None</option>
            <option value="actor">Actor</option>
            <option value="address">Address</option>
            <option value="category">Category</option>
            <option value="city">City</option>
            <option value="country">Country</option>
        </select>
        <label>SET</label>
        <input type="text" name="property1">
        <label>=</label>
        <input type="text" name="property2">
        <label>WHERE</label>
        <input type="text" name="property3">
        <select>
            <option value="equals">=</option>
            <option value="higher">></option>
            <option value="lower"><</option>
        </select>
        <input type="text" name="property4">
        <br />
        <br />
        <input type="submit" name="submit_delete" value="REQUETER">
    </form>
<?php
}
?>