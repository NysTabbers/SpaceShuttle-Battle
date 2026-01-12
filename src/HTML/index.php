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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battle View</title>
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
            <a href="sendToDB.php"><button class="button">Go to page to send data of weapons to database</button></a>
        </div>
    </div>
</body>

</html>