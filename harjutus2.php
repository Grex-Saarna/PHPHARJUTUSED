<?php include("config.php"); ?>
<!doctype html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Muusikapood OÜ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Maailma imelikumad palad!</h1>
    <h2>Uue albumi lisamine</h2>
    <form action="" method="get">
        artist <input type="text" name="artist"><br>
        album <input type="text" name="album"><br>
        aasta <input type="number" name="aasta" min="1900" max="2024"><br>
        hind <input type="number" name="hind" step="0.01"><br>
        <input type="submit" value="+ Lisa uus" name="lisa">
    </form>
    <form action="" method="get">
        Otsi:<input type="text" name="s">
        <input type="Submit" value="Otsi">
    </form>
    <div class="row row-cols-1 row-cols-md-3 g-4 pt-4">
        <?php
        if(!empty($_GET["lisa"])) {
            $artist = $_GET["artist"];
            $album = $_GET["album"];
            $aasta = $_GET["aasta"];
            $hind = $_GET["hind"];
            $paring = "INSERT INTO muusikapod(artist, album, aasta, hind) VALUES ('$artist', '$album', '$aasta', '$hind')";
            $valjund = mysqli_query($sqluhendus, $paring);
            if ($valjund) {
                echo "Lisamine õnnestus!";
                header("location: index.php?msg=true");
            } else {
                echo "Lisamine ebaõnnestus!";
                header("location: index.php?msg=false");
            }
        }
        if(!empty($_GET["del"]) && !empty($_GET["id"])) {
            $del = $_GET["del"];
            $id = $_GET["id"];
            $paring = "DELETE FROM muusikapood WHERE id=$id";
            $valjund = mysqli_query($sqluhendus, $paring);
            if ($valjund) {
                echo "Kustutamine õnnestus!";
                header("location: index.php?msg=true");
            } else {
                echo "Kustutamine ebaõnnestus!";
                header("location: index.php?msg=false");
            }
        }
        if (!empty($_GET["s"])) {
            $s = $_GET["s"];
            $paring = 'SELECT * FROM muusikapod WHERE album LIKE "%'.$s.'%"';
        } else {
            $paring = "SELECT * FROM muusikapod ORDER BY artist ASC LIMIT 10";
        }
        $valjund = mysqli_query($sqluhendus, $paring);
        while($rida = mysqli_fetch_assoc($valjund)){
            echo '';
        }
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
