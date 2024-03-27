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
   <?php if($_SESSION['zalog'] == 1){
                echo "<div id='wyg'><form method='post' action='strona_G.php'><button type='submit' name='wyga' id='wyga'>wyloguj się</button></div>";
                if(isset($_POST['wyga'])){
                    $_SESSION['zalog'] = 0;
                    header("Refresh:0");
                }
            }else{ 
                echo "<h2><a href='logowanie.php'>Zaloguj sie</a></h2>";
            }
        ?>
    </nav>
    <?php 
    error_reporting(0);
    if($_SESSION['admin'] == 0){
        echo "<h1 id='h1'>{$_SESSION['nazwa']}</h1>";
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
            $_SESSION['kosztt'] = $koszt;
            echo "<p>{$koszt}zł/sz</p><br>";
            $_SESSION['ide'] = $ide;
            echo "<form action='item.php' method='post'><label for='liczba'>ile chcesz kupic?:</label><input name='liczba' id='liczba' type='number'>";
            echo "<form action='item.php' method='post'><button type='submit' id='dodaj' name='dodaj'>Dodaj do koszyka</button></form>";
            echo "<form action='koszyk.php'><button name='kosz'>przejdz do kosza</button></form>";
            echo "<form action='strona_G.php'><button>strona główna</button></form>";
            
            }
        }else{
                $liczba = $_POST['liczba'];
                $ilosc = $_SESSION['kosztt'] * $liczba;

                for($i=1; $i < 9; $i++){
                    if($_SESSION['ide'] == $i){
                        $_SESSION['mk-'. $i] = $liczba;
                        $_SESSION['m'. $i] = $ilosc;
                        break;
                    }
                };
                        

            echo "<h1 id='h1'>Zaakceptowane mordeczko</h1>";
            echo "<div class='butt'><form action='koszyk.php'><button type='submit'name='kosz'>przejdz do kosza</button></form>";
            echo "<form action='strona_G.php'><button type='submit'>strona główna</button></form></div>";
        }}else{
            echo "<h1 id='h1'>{$_SESSION['nazw']}</h1>";
        echo "<section class='produkty-item'>";
         if(isset($_POST['button']) != 0){

        $ide = $_POST['button'] + 1;
                    
            $wynik = mysqli_query($poloczenie, "SELECT * FROM `produkty` WHERE id=$ide");
            while($r = mysqli_fetch_array($wynik)){
            echo "<div class='forek'>";
            echo "<img src='data:image/png;base64," . base64_encode($r['obraz']) . "'>";
            echo "<div id='opis'>
            <form method='post'>";
            echo "<label for='nazwa'>nazwa:</label><input type='text' value=" . $r['nazwa'] . " id='nazwa' name='nazwa'><br>";
            echo "<label for='opis'>opis:</label><textarea id='opis' name='opis'>" . $r['opis'] . "</textarea><br>";
            echo "<label for='imie'>imie:</label><textarea id='imie' name='imie'>" . $r['przepis'] . "</textarea><br>";
            echo "<label for='imie'>imie:</label><input type='number' value=" . $r["koszt"] . " id='imie' name='imie'><br>";
            echo "<label for='cos'></label><input type='hidden' id='cos' name='id' value=". $r['id']."><br>";
            echo "<form method='post'><button name='edyt'>zapisz</button></form>";
            echo "<form action='strona_G.php'><button>strona główna</button></form></form>";
            echo "</div>";
            if(isset($_POST["edyt"])){
                $nazwa = $_POST['nazwa'];
                 $opis = $_POST['opis'];
                 $przepis = $_POST['przepis'];
                 $koszt = $_POST['koszt'] ;
        
                 if($nazwa != "" && $opis != "" && $przepis != "" && $koszt != ""){
                    $rowId = $_SESSION['xd'];
                    var_dump("UPDATE `produkty` SET `nazwa` = '$nazwa', `opis` = '$opis', `przepis` = '$przepis', `koszt` = '$koszt' WHERE `produkty`.`id` = $rowId");
                     mysqli_query($poloczenie, "UPDATE `produkty` SET `nazwa` = '$nazwa', `opis` = '$opis', `przepis` = '$przepis', `koszt` = 'koszt' WHERE `produkty`.`id` = $rowId;;");
                     header("Refresh:0");
                 }
                 else{
                     echo "nah";
                 }
              };
            
            }
        }else{
            
                        
            echo "<h1 id='h1'>Zaakceptowane mordeczko</h1>";
            echo "<div class='butt'><form action='koszyk.php'><button type='submit'name='kosz'>przejdz do kosza</button></form>";
            echo "<form action='strona_G.php'><button type='submit'>strona główna</button></form></div>";
        }}
        echo "</div>";
    echo "</section>";
    ?>
</body>
</html>