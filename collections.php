<?php
//strona glowna, z logowaniem
$user_id="";
require_once __DIR__ . '/vendor/autoload.php';
//łączenie z bazą
    $client = new MongoDB\Client(
        'mongodb+srv://admin:qQ2fczxXFqCODj3V@cluster0.ggdvz4i.mongodb.net/?retryWrites=true&w=majority'
    );
if (isset($_POST['login'])&&isset($_POST['password'])) {
    $username =$_POST['login'];
    $password = sha1(sha1($_POST['password']));

    
    $collection = $client->kolekcjoner->users;
    $document= $collection->findOne([
        'username'=>$username]);
    if ($document!="") {
        $user_id=$document['_id'];
        if (($document['username'] == $username) && ($document['password'] == $password)) {
            echo "Witaj " . $username;
        } else {
            echo "Błąd logowania. Spróbuj jeszcze raz.";
        }
    }else{
        echo "Taki użytkownik nie istnieje";
    }
    // echo($document['_id']);
    // unset($_POST['login']);
    // unset($_POST['password']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_main_site.css">
    <link rel="icon" href="site_icon.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <title>Kolekcjoner</title>
</head>
<body>  

<nav>
    <a href="collections.php">
        <img id="logo" src="pictures/logo.png">
    </a>

    <section id="menu">
        <form action="collections.php" method="post">
            <label for="">NAZWA KOLEKCJI:<input type="text" name="collection_name"></label>
            <label for=""><input type="submit" value="Utwórz kolekcje"></label>
        </form>
        <?php

        if(isset($_POST['collection_name'])){
            require_once __DIR__ . '/vendor/autoload.php';
    $client = new MongoDB\Client(
        'mongodb+srv://admin:qQ2fczxXFqCODj3V@cluster0.ggdvz4i.mongodb.net/?retryWrites=true&w=majority'
    );
        $collection_name = $_POST['collection_name'];

        //var_dump($collection_name);
    $collection = $client->kolekcjoner->kolekcje;
    //echo $user_id;
    $document= $collection->insertOne([
        'collection_name'=>$collection_name,
        'user_id'=>"",
        'elements'=>[],
    ]
    );
    
    }
        ?>
    </section>

    <a id="logout-button" href="index.php">
        <img id="logout-img" src="pictures/logout_icon.png" alt="logout">
    </a>
</nav>

<main id="main">
    <h1>Kolekcje</h1>
    <?php
        $collection_nr = 0;
        $user_id = "";
        $collection = $client->kolekcjoner->kolekcje;
        //sortuje kolekcje od najnowszej kolekcji
        $collections = $collection->find([
            'user_id' => strval($user_id),  
        ], ['sort' => ['_id'=>-1]] 
        );
        //var_dump($collections);
        foreach ($collections as $document){
            $collection_nr++;
            echo "<a href='show_collection.php?id=".$document['_id']."'>"."<p>".$collection_nr.". ".$document['collection_name']."</p></a>";
        }
    ?>
</main>

<script src="script.js"></script>

</body>
</html>