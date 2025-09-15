<?php
require_once __DIR__.'/../src/auth.php';
if (!is_logged_in()) {
    header('Location: /login.php');
    exit;
}
header('Location: /items.php');