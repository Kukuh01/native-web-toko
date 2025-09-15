<?php
require_once __DIR__.'/../src/auth.php';
$message = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    if (login_user($email, $password)) {
        header('Location: /items.php');
        exit;
    } else {
        $message = 'Login gagal — periksa email dan password.';
    }
}
?>
<!doctype html>
<html>
    <head><meta charset="utf-8"><title>Login</title></head>
    <body>
        <h2>Login Admin</h2>
        <?php if($message) echo '<p
        style="color:red">'.htmlspecialchars($message).'</p>'; ?>
        <form method="post" action="/login.php">
            <label>Email: <input type="email" name="email" required></label><br>
            <label>Password: <input type="password" name="password" required></
            label><br>
            <button type="submit">Login</button>
        </form>
    </body>
</html>