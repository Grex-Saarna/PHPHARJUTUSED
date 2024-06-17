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
<?php
class Auto {
    public $värv;
    public $tootja;
    public $kiirus;

    public function __construct($värv = "punane", $tootja = "Audi", $kiirus = 0) {
        $this->värv = $värv;
        $this->tootja = $tootja;
        $this->kiirus = $kiirus;
    }

    public function kiirendus() {
        while ($this->kiirus < 100) {
            echo "Hetke kiirus: " . $this->kiirus . " km/h<br>";
            $this->kiirus += 10;
            if ($this->kiirus >= 100) {
                echo "Kiirus on saavutanud maksimumväärtuse 100 km/h.";
                break;
            }
        }
    }
}

// Loo uus auto objekt
$minu_auto = new Auto();
echo "Uus auto loodud. Värv: " . $minu_auto->värv . ", Tootja: " . $minu_auto->tootja . "<br>";
echo "Alustan kiirendamist...<br>";
$minu_auto->kiirendus();
?>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>