<?php
//strona glowna, z logowaniem
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
    <a href="https://ih1.redbubble.net/image.1533663591.5353/ssrco,classic_tee,mens,fafafa:ca443f4786,front_alt,square_product,600x600.jpg">
        <img id="site-icon" src="pictures/unabomber.jpg"  width="100px" height="100px">
    </a>

    <section id="menu">
        <a href="kolekcje.php"><h2>kolekcje.</h2></a>
        <a href="add_item.php"><h2>wstaw nowy item.</h2></a>
    </section>

    <a id="logout-button" href="logout.php">
        <img id="logout-img" src="pictures/logout_icon.png" alt="logout">
    </a>
</nav>

<main>
    <section id="cats"></section>
</main>

</body>
</html>