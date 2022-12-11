<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaloguj się do kolekcjonera</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="saveSignUp.php" method="post">
    <h2>Utwórz konto w kolekcjonerze</h2>
    <label>Login</label><input name="login" type="text">
    <label>Hasło</label><input name="password" type="password">
    <label>Potwierdź hasło</label><input name="password2" type="password">
    <input id="submit_input" type="submit" value="Zarejestruj się">
    <a href="signIn.php">Zaloguj się</a>
</form>
</body>
</html>
