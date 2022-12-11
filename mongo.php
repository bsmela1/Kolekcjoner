<?php
require_once __DIR__ . '/vendor/autoload.php';
    $client = new MongoDB\Client(
    'mongodb+srv://admin:qQ2fczxXFqCODj3V@cluster0.ggdvz4i.mongodb.net/?retryWrites=true&w=majority'
);
$collection = $client->kolekcjoner->kolekcje;
$inserted = $collection->insertOne([
    'username' => 'test',
    'email' => 'test@example.com',
    'name' => 'Test user',
    'movies'=>['qweqwe','qweqweqweqe','qweqweqweq']
]);
// print_r(var_dump($inserted));
$document= $collection->findOne([
'username'=>'barteks']);
echo $document['email'];
?>