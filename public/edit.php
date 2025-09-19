<?php
require_once __DIR__ . '/../src/auth.php';
require_once __DIR__ . '/../src/items.php';

require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id    = $_POST['id'] ?? null;
    $name  = $_POST['name'] ?? '';
    $desc  = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;

    if (!$id) {
        die('Invalid item ID');
    }

    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $filename = time() . '_' . basename($_FILES['image']['name']);
        $target   = __DIR__ . '/uploads/' . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image = $filename;
        }
    }

    update_item($id, $name, $desc, $price, $image);
    header('Location: dashboard.php');
    exit;
}
?>
