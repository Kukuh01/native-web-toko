<?php
require_once __DIR__.'/../src/auth.php';
require_once __DIR__.'/../src/items.php';
require_login();
$id = $_GET['id'] ?? null;
if ($id) {
    delete_item($id);
}
header('Location: /dashboard.php'); exit;