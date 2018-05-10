<?php
    include 'connect_cook.php';

    $carbs_en = $_POST['rcarbs_en'];
    $carbs_nl = $_POST['rcarbs_nl'];
    $proteins_en = $_POST['rproteins_en'];
    $proteins_nl = $_POST['rproteins_nl'];
    $veggies_en = $_POST['rveggies_en'];
    $veggies_nl = $_POST['rveggies_nl'];
    $prep_en = $_POST['rprep_en'];
    $prep_nl = $_POST['rprep_nl'];
    $recipe = $_POST['recipe'];
    $rating = $_POST['rating'];

    $statement = $connection->prepare("INSERT INTO whattocook.favourites (recipe, prep_en, prep_nl, carbs_en, carbs_nl, proteins_en, proteins_nl, veggies_en, veggies_nl, rating) VALUES ('$recipe', '$prep_en', '$prep_nl', '$carbs_en', '$carbs_nl', '$proteins_en', '$proteins_nl', '$veggies_en', '$veggies_nl', '$rating');");
    $statement->execute();
?>  