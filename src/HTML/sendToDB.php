<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// sendToDB.php
require_once("../db/dbWeapons.php");

if (!isset($_SESSION["weapons"])) {
    $_SESSION["error"] = true;
    header("Location: ../HTML/index.php");
    exit();
}

$action = $_GET['action'] ?? '';
$weaponId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$message = '';
$allWeapons = [];

switch ($action) {
    case 'insert':
        insertWeapons($conn, $_SESSION['weapons']);
        $message = "Weapons inserted!";
        break;
    case 'read_all':
        $allWeapons = getWeapons($conn);
        break;
    case 'update':
        if ($weaponId > 0 && updateWeapons($conn)) {
            $message = "Weapon ID $weaponId updated (+1 to all stats)";
        }
        break;
    case 'delete':
        if ($weaponId > 0) {
            deleteAllWeapons($conn);
            $message = "Weapon ID $weaponId deleted!";
        }
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weapons CRUD</title>
    <link rel="stylesheet" href="../CSS/sendToDB.css">
</head>
<body>
<h2>Weapons CRUD</h2>

<?php if ($message): ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<!-- Buttons Wrapper -->
<div class="buttons-wrapper">
    <a href="?action=insert">Insert Weapons</a>
    <a href="?action=read_all">Read All Weapons</a>
    <a href="?action=update&id=1">Update Weapon 1 (+1 stats)</a>
    <a href="?action=delete&id=1">Delete Weapon</a>
    <a href="index.php">Back to battle log page</a>
</div>

<?php if (!empty($allWeapons)): ?>
    <!-- Table Wrapper -->
    <div class="table-wrapper">
        <h3>Weapons Table</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Firepower</th>
                <th>Hit Chance</th>
                <th>Attack Damage</th>
                <th>Shoot Range</th>
                <th>Ammo</th>
                <th>Cooldown</th>
            </tr>
            <?php foreach ($allWeapons as $w): ?>
                <tr>
                    <td><?= htmlspecialchars($w['id']) ?></td>
                    <td><?= htmlspecialchars($w['naam']) ?></td>
                    <td><?= htmlspecialchars($w['firepower']) ?></td>
                    <td><?= htmlspecialchars($w['hitchance']) ?></td>
                    <td><?= htmlspecialchars($w['attackDamage']) ?></td>
                    <td><?= htmlspecialchars($w['shootRange']) ?></td>
                    <td><?= htmlspecialchars($w['ammo']) ?></td>
                    <td><?= htmlspecialchars($w['cooldown']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>

</body>
</html>
