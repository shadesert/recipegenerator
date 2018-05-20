<?php
    include 'connect_cook.php';

    $statement = $connection->prepare("SELECT SUM(rating), recipe_en, recipe_nl FROM whattocook.favourites WHERE rating != 0 GROUP BY recipe_en ORDER BY SUM(rating) DESC;");
    $statement->execute();

    foreach($statement->fetchAll(PDO::FETCH_ASSOC) as $result){
        $dutchRecipes[] = $result["recipe_nl"];
        $englishRecipes[] = $result["recipe_en"];
        $ratings[] = $result["SUM(rating)"];
    }
    if(isset($dutchRecipes) && isset($englishRecipes) && isset($ratings)){
        file_put_contents("data/recipes.json", json_encode(array($dutchRecipes, $englishRecipes, $ratings)));
    }
    else{
        echo "There are no liked or unliked recipes yet...";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Recipe Leaderboards</title>
        <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
        <link href="css/whattocook.css" rel="stylesheet"/>
    </head>
    <body>
        <nav>
            <ul class="navigation nav-top">
                <span id="pickLanguage">
                    <li>
                        <input type="radio" name="language" id="nl" value="nl"/>
                        <label for="nl"><img src="images/nl.svg"/></label>
                    </li>
                    <li>
                        <input type="radio" name="language" id="en" value="en"/>
                        <label for="en"><img src="images/uk.svg"/></label>
                    </li>
                </span>
            </ul>
        </nav>
        <h1 langkey="titlefavs">Recipe Ratings</h1>
        <div>
            <table id="recipeRatings">
                <?php
                    foreach($statement->fetchAll(PDO::FETCH_ASSOC) as $result){
                        echo
                            "<tr>
                                <td>{$result['recipe_en']}</td>
                                <td>{$result['SUM(rating)']}</td>
                            </tr>";
                    }
                ?>
            </table>
        </div>
        <footer>
            <nav>
                <ul class="navigation nav-bottom">
                    <li>
                        <a href="index.php" langkey="backbutton">Go back</a>
                    </li>
                </ul>
            </nav>
        </footer>
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/dishgenerator.js" type="text/javascript"></script>
    </body>
</html>