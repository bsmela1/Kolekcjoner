<?php
if (isset($_POST['login'])&&isset($_POST['password'])) {
    $username =$_POST['login'];
    $password = sha1(sha1($_POST['password']));

    require_once __DIR__ . '/vendor/autoload.php';
    $client = new MongoDB\Client(
        'mongodb+srv://admin:qQ2fczxXFqCODj3V@cluster0.ggdvz4i.mongodb.net/?retryWrites=true&w=majority'
    );
    $collection = $client->kolekcjoner->users;
    $document= $collection->findOne([
        'username'=>$username]);
    if ($document!="") {
        if (($document['username'] == $username) && ($document['password'] == $password)) {
            echo "Witaj " . $username;
        } else {
            echo "Błąd logowania. Spróbuj jeszcze raz.";
        }
    }else{
        echo "Taki użutkownik nie istnieje";
    }
}