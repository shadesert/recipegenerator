<?php
    session_start();

    if(isset($_POST['language'])){
        /*$lang_id = $_POST['language'];*/
        $_SESSION['language'] = $_POST['language'];
    }

    include 'connect_cook.php';

    $statementproteins = $connection->prepare("SELECT id, protein, protein_dutch FROM proteins;");
    $statementproteins->execute();
    $statementveggies = $connection->prepare("SELECT id, veggie, veggie_dutch FROM veggies;");
    $statementveggies->execute();
    $statementcarbs = $connection->prepare("SELECT id, carb, carb_dutch FROM carbs;");
    $statementcarbs->execute();

    foreach($statementproteins->fetchAll(PDO::FETCH_ASSOC) as $result){
        $prot_id[] = $result["id"];
        $proteins[] = $result["protein"];
        $proteins_dutch[] = $result["protein_dutch"];
    }
    file_put_contents("data/proteins.json", json_encode(array($prot_id, $proteins, $proteins_dutch)));

    foreach($statementveggies->fetchAll(PDO::FETCH_ASSOC) as $result){
        $veg_id[] = $result["id"];
        $veggies[] = $result["veggie"];
        $veggies_dutch[] = $result["veggie_dutch"];
    }
    file_put_contents("data/veggies.json", json_encode(array($veg_id, $veggies, $veggies_dutch)));

    foreach($statementcarbs->fetchAll(PDO::FETCH_ASSOC) as $result){
        $carb_id[] = $result["id"];
        $carbs[] = $result["carb"];
        $carbs_dutch[] = $result["carb_dutch"];
    }
    file_put_contents("data/carbs.json", json_encode(array($carb_id, $carbs, $carbs_dutch)));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>What to cook</title>
        <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
        <link href="css/whattocook.css" rel="stylesheet"/>
    </head>
    <body>
        <nav>
            <ul class="navigation nav-top">
                <span id="pickLanguage">
                    <li>
                        <input type="radio" name="language" id="nl"/>
                        <label for="nl"><img src="images/nl.svg"/></label>
                    </li>
                    <li>
                        <input type="radio" name="language" id="en"/>
                        <label for="en"><img src="images/uk.svg"/></label>
                    </li>
                </span>
            </ul>
        </nav>
        <h1 langkey="title">What to cook?</h1>
        <form>
            <div class="form">
                <ul>
                    <li>
                        <label langkey="mustcontain">This should be in it:</label>
                        <input type="text" id="contains"/>
                    </li>
                    <li>
                        <span langkey="prefs">Preferences:</span>
                        <select id="prefs">
                            <option langkey="none">None</option>
                            <option langkey="veg">Vegetarian</option>
                            <!--option langkey="healthy">Healthy</option-->
                        </select>
                    </li>
                </ul>
            </div>
            <button onclick="return showRecipe()" langkey="mainbutton">Give me a recipe</button>
            <div class="recipecontainer">
                <div id="recipe"></div>
            </div>
            <div class="iconspan">
                <i class="far fa-thumbs-down"></i>
                <i class="far fa-thumbs-up"></i>
            </div>
            <div id="imagecontainer">
            </div>
        </form>
        <footer>
            <nav>
                <ul class="navigation nav-bottom">
                    <li>
                        <a href="leaderboards.php" langkey="titlefavs">Recipe Ratings</a>
                    </li>
                </ul>
            </nav>
        </footer>
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/dishgenerator.js" type="text/javascript"></script>
    </body>
</html>