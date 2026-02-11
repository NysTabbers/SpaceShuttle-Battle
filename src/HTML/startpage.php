<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/startpage.css">
</head>

<body>
    <div class="grid" id="grid"></div>

    <!-- Modal backdrop -->
    <div id="modal-backdrop" class="modal-backdrop"></div>

    <div id="ship-details" class="ship-details" aria-live="polite">
        <button id="close-modal" class="close-btn">✕</button>
        <h2 id="details-title">Choose a ship</h2>
        <div id="details-content">Click an image to view ship stats</div>
        <button id="confirm-selection" disabled>Confirm Selection</button>
    </div>

    <script src="../JS/grid.js"></script>
</body>

</html>