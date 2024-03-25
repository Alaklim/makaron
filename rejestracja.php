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
?>
<body>
    <nav>
        <h1>MAKARONIX</h1>
        <h2><a href='strona_G.php'>wróć do sklepu</a></h2>
    </nav>
    <section class="log">
    <form method="post" action="rejestracja.php">
        <label for="name">imie: </label><input id="name" name="name" type="text"><br>
        <label for="email">email: </label><input id="email" name="email" type="text"><br>
        <label for="haslo">hasło: </label><input id="haslo" name="haslo" type="password"><br>
        <button type="submit" name="ok">rejestruj</button><br>
        <p>masz konto?</p><br>
        <button type="submit" name="not-ok" id="rejest">loguj</button>
    </form>
    <?php 
        if(isset($_POST['ok'])) {
    
            $wynik = mysqli_query($poloczenie, "SELECT * FROM `login` where email = '{$_POST['email']}'");
    
            if(mysqli_num_rows($wynik) > 0) {
                $_SESSION['zalog'] = 0;
                echo "login już istnieje ";
            }
            else {
                $_SESSION['zalog'] = 1;
                $login = $_POST['email'];
                $haslo = $_POST['haslo'];
                $osoba = $_POST['name'];
                mysqli_query($poloczenie, "INSERT INTO login (name, email, haslo) VALUES ('$osoba', '$login' , '$haslo')");
                echo "zarejestrowany ";
                echo "<form action='strona_G.php' method='post'><button type='submit' name='not-ok' id='rejest'>strona głwona</button></form>";
            }
    
        }
            mysqli_close($poloczenie);
    ?>
    </section>
</body>
</html>