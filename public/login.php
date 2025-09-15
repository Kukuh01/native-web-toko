<?php
require_once __DIR__.'/../src/auth.php';
$message = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    if (login_user($email, $password)) {
        header('Location: /dashboard.php');
        exit;
    } else {
        $message = 'Login gagal — periksa email dan password.';
    }
}
?>
<!doctype html>
<html>
    <head><meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/style/login.css">
    </head>
    <body>
        <div class="card-login">
            <div class="login-title">
                <h2>Login Admin</h2>
            </div>
            <div class="login-form">
                <?php if($message) echo '<p
                style="color:red">'.htmlspecialchars($message).'</p>'; ?>
                <form method="post" action="/login.php">
                    <div>
                        <label>Email: <input type="email" name="email" required>
                        </label>
                    </div>
                    <div>
                        <label>Password: <input type="password" name="password" required>
                        </label>
                    </div>
                    <div>
                        <button type="submit" class="btn-login">Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>