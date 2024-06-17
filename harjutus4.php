<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>   
    <title>Kliendid</title>
</head>
<body>
    <div class="container">
        <h2>Kliendid</h2>
        <?php
        include('config.php');
        $sqluhendus = mysqli_connect($servername, $username, $password, $dbname);
        if (!$sqluhendus) {
            die("Ühenduse loomine ebaõnnestus: " . mysqli_connect_error());
        }
        $sql = "SELECT id, eesnimi, perenimi, telefoninumber FROM kliendid";
        $result = mysqli_query($sqluhendus, $sql);
        if (!$result) {
            die("Päringu tegemine ebaõnnestus: " . mysqli_error($sqluhendus));
        }
        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead><tr><th>ID</th><th>Eesnimi</th><th>Perenimi</th><th>Telefoninumber</th></tr></thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["eesnimi"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["perenimi"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["telefoninumber"]) . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>Andmeid ei leitud.</p>";
        }
        mysqli_close($sqluhendus);
        ?>
    </div>
</body>
</html>
