<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="pl">
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
        <h2><a href='koszyk.php'>wróć do kosza</a></h2>
    </nav>
<?php 
    if($_SESSION['zalog'] == 1){
?>
    <div class="inf">
            <h1>Finalizacja zakupu</h1>
            <?php echo "<p>koszt twoich zakupów: ". $_SESSION['cash']. "</p>" ;
                echo $_SESSION['email'];
            ?>

    </div>
    <section class="log-pal">
        <p>wybierz forme płatności</p>
        <div class="pal">
        <form method="post" action="cash.php">
            <input type="radio" id="blik" name="fav_language" value="blik">
            <label for="blik">Blik</label><br>
            <input type="radio" id="paypal" name="fav_language" value="paypal">
            <label for="paypal">Paypal</label><br>
            <input type="radio" id="pin" name="fav_language" value="pin">
            <label for="pin">pin karty kredytowej</label>
            <label for="pinK"></label><input type="number" id="pinK" name="pinK"><br>
            <hr>
            <label>Podaj adres: </label><br>
            <label for="dom">Podaj adres odbioru:</label><input type="text" name="dom" id="dom"><br>
            <label for="miasto">Podaj miasto w którym znajduje sie twój punk odbioru:</label><br><input type="text" name="miasto" id="miasto"><br>
            <label for="tele">Podaj numer telefonu do kontaktu</label><br><input type="number" name="tele" id="tele">
            <button type='submit' name='button'>kup</button>
        </form>
<?php 
    if(isset($_POST['button'])){
        $dom = $_POST['dom'];
        $miasto = $_POST['miasto'];
        $tele = $_POST['tele'];
        $pinK = $_POST['pinK'];
        $email = $_SESSION['email'];
        $cash = $_SESSION['cash'];

        mysqli_query($poloczenie, "INSERT INTO `order`(`email`, `val`, `ad`, `city`, `pin`) VALUES ('$email','$cash','$dom','$miasto','$pinK')");

        echo "<p>DONE</p>";
    }
    
    }else{
?>
        <h2>Nie jesteś zalogowany!</h2>
        <form action="logowanie.php">
            <button>Zaloguj się</button>
        </form>
        </div>
    </section>
<?php 
    } 
?>
</body>
</html>