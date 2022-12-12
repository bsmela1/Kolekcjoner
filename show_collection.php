<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_show_collection.css">
    <title>Show collection</title>
</head>
<body>
    <nav>
        <?php
                require_once __DIR__ . '/vendor/autoload.php';

                $client = new MongoDB\Client(
                    'mongodb+srv://admin:qQ2fczxXFqCODj3V@cluster0.ggdvz4i.mongodb.net/?retryWrites=true&w=majority'
                );

                $collection = $client->kolekcjoner->kolekcje;

                $collection_id = strval($_GET['id']);
                //echo $collection_id;

                // szukanie według kryteriów
                $criteria = [
                    '_id'=> new MongoDB\BSON\ObjectId("$collection_id"),
                ];

                $collections = $collection->find($criteria);

                //stara wersja:
                //$searched_collection = $collection->findOne([
                //    '_id'=> new MongoDB\BSON\ObjectId("$collection_id")
                //]);
    
        ?>

        <a href="collections.php">
            <img id="logo" src="pictures/logo.png">
        </a>

        <?php
            //otwieram forma z przekierowaniem do tej samej strony
            echo "<form action='show_collection.php?id=$collection_id' method='post'>" 
        ?>
            <label for="item_name">Wstaw do kolekcji:<input type="text" name="item_name"></label>
            <input id='add-item-submit-button' type="submit" value="Wstaw przedmiot">
        </form>

        <a id="logout-button" href="index.php">
            <img id="logout-img" src="pictures/logout_icon.png" alt="logout">
        </a>
    </nav>

    <main>  
        <?php
              //tablica do update'a elementow
            $array_to_update = [];

            //printowanie wszystkihc elementow z tablicy elements
            foreach ($collections as $collection) {
                $collection_name = $collection['collection_name'];
                echo "<h1>$collection_name</h1>";
                $elements = $collection['elements'];
                echo "elements: ";
                var_dump($elements);

                echo "collection: ";
                var_dump($collection);
                //$elements_len = count($elements);
                foreach ($elements as $element) {
                    echo "<a href='show_element.php?id=$collection_id&element=$element'>$element</a>";
                    array_push($array_to_update, $element);
                  }
            };


            //kod do wstawiania elementow do wybranej kolekcji
            if(
                isset($_POST['item_name']) 
                && $_POST['item_name']!=""
            ){
                require_once __DIR__ . '/vendor/autoload.php';
                $client = new MongoDB\Client(
                    'mongodb+srv://admin:qQ2fczxXFqCODj3V@cluster0.ggdvz4i.mongodb.net/?retryWrites=true&w=majority'
                );

                $item_name = $_POST['item_name'];
                //dodaje element name z inputa:
                array_push($array_to_update, $item_name);
                //echo "array to update: ".$array_to_update;
                var_dump($array_to_update);

                $collection->updateOne(
                    [ '_id' => new MongoDB\BSON\ObjectId("$collection_id") ],
                    [ 
                        '$set' => [ 'elements' => $array_to_update ]
                    ]
                    );
                //czyszcze array_to_update zeby nie zwiekszala sie wraz z kolejymi update requestami:
                $array_to_update = [];
                $_POST = array();
            }
            $_POST = array();
        ?>
    </main>


</body>
</html>