<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl.css">
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
        <h2><a>Zaloguj sie</a></h2>
    </nav>
    <?php 
        echo "<h1 id='h1'>{$r['nazwa']}</h1>";
        echo "<section class='produkty-item'>";
         if(isset($_POST['button']) != 0){

        $ide = $_POST['button'] + 1;
                    
            $wynik = mysqli_query($poloczenie, "SELECT * FROM `produkty` WHERE id=$ide");
            while($r = mysqli_fetch_array($wynik)){
            echo "<img src='data:image/png;base64," . base64_encode($r['obraz']) . "'>";
        echo "<div id='opis'>";
            echo "<h2>{$r['nazwa']}</h2>";
            echo "<p>{$r['opis']}</p>";
            echo "<p>{$r['przepis']}</p>";
            $koszt = number_format($r["koszt"], 2);
            echo "<p>{$koszt}zł/sz</p><br>";
            $_SESSION['ide'] = $ide;
            echo "<form action='item.php' method='post'><label for='liczba'>ile chcesz kupic?:</label><input name='liczba' id='liczba' type='number'>";
            echo "<form action='item.php' method='post'><button type='submit' id='dodaj' name='dodaj'>Dodaj do koszyka</button></form>";
            echo "<form action='card.php'><button type='submit'name='kosz'>przejdz do kosza</button></form>";
            echo "<form action='strona_G.php'><button type='submit'>strona główna</button></form>";
            }
        }else{


                        // $liczba = $_POST['liczba'];
                        // $ilosc = $koszt * $liczba;


                        // if($ide == 1){
                        //         $_SESSION['pomidorek'] = $cika;
                        //         $_SESSION['one'] = $mok;
                        // }else if($ide == 2){
                        //         $_SESSION['pomidorek'] = $cika;
                        //         $_SESSION['one'] = $mok;
                        // }else if($ide == 3){
                        //         $_SESSION['pomidorek'] = $cika;
                        //         $_SESSION['one'] = $mok;
                        // }else if($ide == 4){
                        //         $_SESSION['pomidorek'] = $cika;
                        //         $_SESSION['one'] = $mok;
                        // }else if($ide == 5){
                        //         $_SESSION['pomidorek'] = $cika;
                        //         $_SESSION['one'] = $mok;
                        // }else if($ide == 6){
                        //         $_SESSION['pomidorek'] = $cika;
                        //         $_SESSION['one'] = $mok;
                        // }else if($ide == 7){
                        //         $_SESSION['pomidorek'] = $cika;
                        //         $_SESSION['one'] = $mok;
                        // }else if($ide == 8){
                        //         $_SESSION['pomidorek'] = $cika;
                        //         $_SESSION['one'] = $mok;
                        // }
            echo "<h1 id='h1'>Zaakceptowane mordeczko</h1>";
            echo "<div class='butt'><form action='card.php'><button type='submit'name='kosz'>przejdz do kosza</button></form>";
            echo "<form action='strona_G.php'><button type='submit'>strona główna</button></form></div>";
        }
        echo "</div>";
    echo "</section>";
    ?>
</body>
</html>