<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_show_collection.css">
    <title>Show collection</title>
</head>
<body>
    <nav>
        <a href="collections.php">
            <img id="site-icon" src="pictures/unabomber.jpg"  width="100px" height="100px">
        </a>

        <form action="collections.php" method="post">
            <label for="item_name">Wstaw do kolekcji:<input type="text" name="item_name"></label>
            <input id='add-item-submit-button' type="submit" value="Wstaw przedmiot">
        </form>

        <a id="logout-button" href="index.php">
            <img id="logout-img" src="pictures/logout_icon.png" alt="logout">
        </a>
    </nav>

    <main>  
        <?php
            require_once __DIR__ . '/vendor/autoload.php';

            $client = new MongoDB\Client(
                'mongodb+srv://admin:qQ2fczxXFqCODj3V@cluster0.ggdvz4i.mongodb.net/?retryWrites=true&w=majority'
            );

            $collection = $client->kolekcjoner->kolekcje;

            $collection_id = strval($_GET['id']);
            //echo $collection_id;

            $searched_collection = $collection->findOne([
                '_id'=> new MongoDB\BSON\ObjectId("$collection_id")
            ]);

            //var_dump($searched_collection);

            $collection_name = $searched_collection['collection_name'];
            echo "<h1>$collection_name</h1>";
        ?>


        <?php




        ?>
    </main>


</body>
</html>