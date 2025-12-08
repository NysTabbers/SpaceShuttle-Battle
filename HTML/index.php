<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../PHP/spaceship.php");
require_once("../PHP/stats.php");

ob_start();
require_once("../PHP/battle.php");
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
<div class="wrapper">
<div class="battle-log">
    <h1>Battle Log</h1>
    <p>
        <?php echo $battleLog ?>
    </p>
</div>
</div>
</body>

</html>