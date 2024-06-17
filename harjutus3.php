<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <title>harjutus 3</title>
</head>
<body>
<?php
include('config.php');
$andmed = "SELECT * FROM albumid";
?>
<body>
        <div class="container">   
        <h2>Lisa uue albumi info:</h2>
        <form action="#" method="get">
            <label for="artist">Artist:</label>
            <input type="text" name="artist" id="artist"><br>
            <label for="album">Album:</label>
            <input type="text" name="album" id="album"><br>
            <label for="aasta">Aasta:</label>
            <input type="number" name="aasta" id="aasta"><br>
            <label for="hind">Hind:</label>
            <input type="number" name="hind" id="hind"><br>
            <input type="submit" class="btn btn-success my-2" value="Lisa">
        </form>
        <?php        
        if(!empty($_GET['artist']) && !empty($_GET['album']) && !empty($_GET['aasta']) && !empty($_GET['hind'])){
            $artist = $_GET["artist"];
            $album = $_GET["album"];
            $aasta = $_GET["aasta"];
            $hind = $_GET["hind"];
            $artist = mysqli_real_escape_string($sqluhendus, $artist);
            $album = mysqli_real_escape_string($sqluhendus, $album);
            $aasta = mysqli_real_escape_string($sqluhendus, $aasta);
            $hind = mysqli_real_escape_string($sqluhendus, $hind);
            $lisasql = "INSERT INTO albumid (artist, album, aasta, hind) VALUES ('$artist', '$album', '$aasta', '$hind')";
            if ($sqluhendus->query($lisasql) === TRUE) {
                echo "Lisatud";
            }
        }
        if(isset($_GET['action']) && $_GET['action'] == 'kustuta' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $kustutasql = "DELETE FROM albumid WHERE id=$id";
            if ($sqluhendus->query($kustutasql) === TRUE) {
                echo "Kustutatud!";
            }
        }
        if(isset($_GET['action']) && $_GET['action'] == 'muuda' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $muudabaas = "SELECT * FROM muusikapod WHERE id = $id";
            $fetcht = $sqluhendus->query($muudabaas);
            if ($muuda_t->num_rows > 0) {
                $ridamuut = $fetcht->fetch_assoc();
                $artistmuut = $rida["artist"];
                $albummuut = $rida["album"];
                $aastamuut = $rida["aasta"];
                $hindmuut = $rida["hind"];
                ?>
                <h2>Muuda albumit:</h2>
                <form action='#' method='get'>
                    <input type='hidden' name='action' value='salvesta_muudatus'>
                    <input type='hidden' name='id' value='$id'>
                    <label for='artist'>Artist:</label>
                    <input type='text' name='artist' id='artist' value='<?php echo $artistmuut; ?>'><br>
                    <label for='album'>Album:</label>
                    <input type='text' name='album' id='album' value='<?php echo $albummuut; ?>'><br>
                    <label for='aasta'>Aasta:</label>
                    <input type='text' name='aasta' id='aasta' value='<?php echo $aastamuut; ?>'><br>
                    <label for='hind'>Hind:</label>
                    <input type='text' name='hind' id='hind' value='<?php echo $hindmuut; ?>'><br>
                    <input type='submit' class='btn btn-success my-2' value='Muuda'>
                </form>
                <?php
            } else {
                echo "Ei tööta kood perhsses?!";
            }
        }
        $sql = "SELECT * FROM muusikapod";
        $result = $sqluhendus->query($sql);  
        if ($result->num_rows > 0) {
            echo "<h2>Kõik anmed:</h2>";
            while($row = $result->fetch_assoc()) {
                echo "<p>";
                echo "Artist: " . $row["artist"] . " - Album: " . $row["album"] . " - Aasta: " . $row["aasta"] . " - Hind: " . $row["hind"] . "€";
                echo " <a href='?action=muuda&id=" . $row["id"] . "'>Muuda</a>";
                echo " <a href='?action=kustuta&id=" . $row["id"] . "' onclick=\"return confirm('Kas Te olete kindel selles?');\">Kustuta</a>";
                echo "</p>";
            }
        }
        $sqluhendus->close();
        ?>
</body> 
</html>