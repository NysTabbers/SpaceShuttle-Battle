<?php
session_start();
header('Content-Type: application/json');

$data = null;
$contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
if (stripos($contentType, 'application/json') === 0) {
    $raw = trim(file_get_contents('php://input'));
    $data = json_decode($raw, true);
} else {
    $data = $_POST;
}

if (!isset($data['shipIndex'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'shipIndex missing']);
    exit;
}

$idx = intval($data['shipIndex']);
$_SESSION['selected_ship_index'] = $idx;
// optionally store img index
if (isset($data['imgIndex'])) {
    $_SESSION['selected_img_index'] = intval($data['imgIndex']);
}

echo json_encode(['success' => true, 'selected' => $idx]);
