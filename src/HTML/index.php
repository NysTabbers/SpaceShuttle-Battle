<?php

// Zet foutmeldingen aan (handig tijdens development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Benodigde PHP-bestanden inladen
require_once("../PHP/spaceship.php");
require_once("../PHP/stats.php");

// Output buffering starten om battle output op te vangen
ob_start();

// Battle logica uitvoeren
require_once("../PHP/battle.php");

// Opgevangen output opslaan in variabele
$battleLog = ob_get_clean();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Zorgt voor correcte weergave op verschillende schermgroottes -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle View</title>
    <!-- CSS bestand voor styling -->
    <link rel="stylesheet" href="../CSS/index.css">
</head>

<body>
    <!-- Wrapper voor de volledige pagina -->
    <div class="wrapper">
        <!-- Container voor de battle log -->
        <div class="battle-log">
            <h1>Battle Log</h1>
            <p>
                <!-- Toon de battle log output -->
                <?php echo $battleLog ?>
            </p>
            <a href="../db/dbWeapons.php"><button class="button">Send weapon stats to database</button></a>
        </div>
    </div>
</body>

</html>

<?php

if($_SESSION["error"] === true){
    echo "<div class='error'><h1>Failed</h1> <p>Weapons where empty. Please try again or contact developer</p></div>";
}

?>