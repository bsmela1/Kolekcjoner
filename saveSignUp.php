<?php

if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password2'])){
    $username = $_POST['login'];
    $password=sha1(sha1($_POST['password']));

    require_once __DIR__ . '/vendor/autoload.php';
    $client = new MongoDB\Client(
        'mongodb+srv://admin:qQ2fczxXFqCODj3V@cluster0.ggdvz4i.mongodb.net/?retryWrites=true&w=majority'
    );

    $collection = $client->kolekcjoner->users;

    $collection->insertOne([
        'username'=>$username,
        'password'=>$password
    ]);
    echo "Użytkownik został dodany!";
}
?>
<a href="index.php">Zaloguj się</a>
