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
        <h2><a>koszyk</a></h2>
        <h2><a>Zaloguj sie</a></h2>
    </nav>
    <section class="info-one">
        <img src="png/makaron.png" id="ban" class="active">
        <img src="png/mm.png" id="ban">
    </section>
    <section class="produkty">
        <h1>Nasze produkty</h1>
          <div class="produ">

            <?php 
                $wynik = mysqli_query($poloczenie, "SELECT * FROM `produkty`");
                for($r = 0; $r < $wyk = mysqli_fetch_array($wynik); $r++){
                    echo "<div id='item'>";
                        echo "<img src='data:image/png;base64," . base64_encode($wyk['obraz']) . "'>";
                        echo "<h3>{$wyk['nazwa']}</h3>";
                        echo "<p>{$wyk['koszt']} zł/sz</p>";
                        echo "<p>{$wyk['opis']}</p>";
                        $_SESSION['d'] = $r;
                        echo "<form method='post' action='item.php'><button type='submit' name='button' value='{$r}'>Wejdz</button></form>";
                    echo "</div>"; 
                }
            
            ?>
          </div>
    </section>
    <script>
         document.addEventListener("DOMContentLoaded", function() {
        const images = this.querySelectorAll('.info-one  img');
        let currentImageIndex = 0;

        setInterval(() => {
        const currentImage = images[currentImageIndex];
        const nextImageIndex = (currentImageIndex + 1) % images.length;
        const nextImage = images[nextImageIndex];

        currentImage.classList.remove('active');
        nextImage.classList.add('active');
        currentImageIndex = nextImageIndex;
    }, 7000);
 })
    </script>
    <?php 
        mysqli_close($poloczenie);
            var_dump($_SESSION);
    ?>
</body>
</html>