<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="logowanie.css">
    <title>Makaronix</title>
</head>
<?php 
        $serwer = 'localhost';
        $uzytkownik = 'root';
        $haslo = '';
        $baza = 'makaronix'; 

        $poloczenie = mysqli_connect($serwer, $uzytkownik, $haslo, $baza);
        error_reporting(0);
?>
<body>
    <nav>
        <h1>MAKARONIX</h1>
        <h2><a href='strona_G.php'>wróć do sklepu</a></h2>
        <h2><a href='cash.php'>wróć do płatności</a></h2>
    </nav>
    <section class="log">
    <form method="post" action="logowanie.php">
        <label for="email">email: </label><input id="email" name="email" type="text"><br>
        <label for="haslo">hasło: </label><input id="haslo" name="haslo" type="password"><br>
        <button type="submit" name="ok">zaloguj</button><br>
        <p>nie masz konta?</p><br></form>
        <form action='rejestracja.php' method='post'><button type="submit" name="not-ok" id="rejest">rejestracja</button></form>
        <form action='strona_G.php' method='post'><button type="submit" name="not-ok" id="rejest">strona głwona</button></form>
    <?php                                                                                                                  
        if(isset($_POST['ok'])){
            $wynik = mysqli_query($poloczenie, "SELECT * FROM `login` where email = '{$_POST['email']}' and haslo = '{$_POST['haslo']}'");
            $_SESSION['email']= $_POST['email'];

            if(mysqli_num_rows($wynik) > 0) {
                $_SESSION['zalog'] = 1;
                echo "jesteś zalogowany<br>";
            }
            else {
                $_SESSION['zalog'] = 0;
                echo "wprowadzone wartości są błędne lub nie istnieją ";
            }
        }
        if($_POST['email'] == 'admin@gmail.com' && $_POST['haslo'] == 'admin'){
            echo "witaj administratorze!";
            $_SESSION['admin'] = 1;
        }
        else{
            $_SESSION['admin'] = 0;
        }
    ?>
    </section>
</body>
</html>