<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_show_element.css">
    <title>Show collection</title>
</head>
<body>
    <nav>
        <?php
                require_once __DIR__ . '/vendor/autoload.php'; 
                //łączenie z bazą
                $client = new MongoDB\Client(
                    'mongodb+srv://admin:qQ2fczxXFqCODj3V@cluster0.ggdvz4i.mongodb.net/?retryWrites=true&w=majority'
                );

                $collection = $client->kolekcjoner->kolekcje;

                $collection_id = strval($_GET['id']);
                $element_name = strval($_GET['element']);
    
        ?>

        <a href="collections.php">
            <img id="logo" src="pictures/logo.png">
        </a>

        <a id="logout-button" href="index.php">
            <img id="logout-img" src="pictures/logout_icon.png" alt="logout">
        </a>
    </nav>

    <main>  
        <?php
            //printowanie wszystkihc elementow z tablicy elements
            echo "<div>$element_name</div>";

        ?>

    </main>


</body>
</html>