<?php
    require_once __DIR__.'/db.php';
    session_start();

    function login_user($email, $password) {
        $pdo = DB::get();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if(!$user) return false;
        
        $passInputHash = md5(trim($password));

        if (hash_equals($user['password'], $passInputHash)) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
        return false;
    }

    function is_logged_in() {
        return isset($_SESSION['user_id']);
    }

    function require_login() {
        if (!is_logged_in()) {
            header('Location: /login.php');
            exit;
        }
    }

    function logout() {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
            );
        }
    session_destroy();
    }
?>
