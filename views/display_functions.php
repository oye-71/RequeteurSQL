<?php

/**
 * Affichage du formulaire pour la requête SELECT
 */
function displaySelectForm()
{
    if (!isset($_POST["continue_select"])) {
        ?>
        <h1>Search by :</h1>
        <form class="request-form" method="post" action="index.php">
            <label> Type : </label>
            <select name="table">
                <option value="Film">Film</option>
                <!--<option value="Category">Category</option>
                <option value="Language">Language</option>-->
            </select>
            <br />
            <input class="red-button" type="submit" name="continue_select" value="Continue">
        </form>
    <?php
        } else {
            ?>
        <h1>Research by : <?php echo $_POST["table"]; ?></h1>
        <form class="request-form" method="post" action="index.php">
            <input class="text-input" type="text" name="content" placeholder="What are you thinking about ?">
            <br />
            <?php
                    switch ($_POST["table"]) {
                        case 'Category':
                            ?>
                    <input class="red-button" type="submit" name="category_select" value="Request">
        </form>
    <?php
                break;
            case 'Film':
                ?>
        <input class="red-button" type="submit" name="film_select" value="Request">
        </form>
    <?php
                break;
            case 'Language':
                ?>
        <input class="red-button" type="submit" name="language_select" value="Request">
        </form>
    <?php
                break;
        }
    }
}

/**
 * Affichage du formulaire pour la requête INSERT
 */
function displayInsertForm()
{
    if (!isset($_POST["continue_insert"])) {
        ?>
    <h1>Insert into database :</h1>
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
    </form>
<?php
    } else {
        ?>
    <h1>Insert into : <?php echo $_POST["table"]; ?></h1>
    <?php
            switch ($_POST["table"]) {
                case 'actor':
                    ?>
            <form class="request-form" method="post" action="index.php">
                <input class="text-input" type="text" name="last_name" placeholder="Actor last name">
                <br />
                <input class="text-input" type="text" name="first_name" placeholder="Actor first name">
                <br />
                <input class="red-button" type="submit" name="actor_insert" value="Insert">
            </form>
        <?php
                    break;
                case 'category':
                    ?>
            <form class="request-form" method="post" action="index.php">
                <input class="text-input" type="text" name="name" placeholder="Category name">
                <br />
                <input class="red-button" type="submit" name="category_insert" value="Insert">
            </form>
        <?php
                    break;
                case 'film':
                    ?>
            <form class="request-form" method="post" action="index.php">
                <input class="text-input" type="text" name="title" placeholder="Film title">
                <br />
                <input class="text-input" type="text" name="description" placeholder="Enter a quick synopsis for this film...">
                <br />
                <label>Release year : </label>
                <input class="date-input" type="text" name="release_year">
                <br />
                <label>Category Id : </label>
                <input class="number-input" type="number" name="category_id">
                <br />
                <label>Language Id : </label>
                <input class="number-input" type="number" name="language_id">
                <br />
                <label>Main actor Id : </label>
                <input class="number-input" type="number" name="actor_id">
                <br />
                <label>Rental duration : </label>
                <input class="number-input" type="number" name="rental_duration">
                <br />
                <label>Rental rate : </label>
                <input class="number-input" type="number" name="rental_rate">
                <br />
                <label>Replacement cost : </label>
                <input class="number-input" type="number" name="replacement_cost">
                <br />
                <input class="red-button" type="submit" name="film_insert" value="Insert">
            </form>
        <?php
                    break;
                case 'language':
                    ?>
            <form class="request-form" method="post" action="index.php">
                <input class="text-input" type="text" name="name" placeholder="Language name">
                <br />
                <input class="red-button" type="submit" name="language_insert" value="Insert">
            </form>
    <?php
                break;
        }
    }
}

/**
 * Affichage du formulaire pour la requête ALTER
 */
function displayUpdateForm($row)
{ 
    ?>
    <form class="request-form" method="post" action="index.php">
        <input class="text-input" type="text" name="title" placeholder="<?php echo htmlspecialchars($row['title']) ?>">
        <br />
        <input class="text-input" type="text" name="description" placeholder="<?php echo htmlspecialchars($row['description']) ?>">
        <br />
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']) ?>" />
        <input class="red-button" type="submit" name="update_row" value="Update">
    </form>

    <?php
}

function displayQuery($query){
    echo "<br />Requête exécutée : ";
    ?>
    <div class="code">
        <?php echo $query ?>
    </div>
    <br />
    <?php
}