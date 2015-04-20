<?php

session_start();

require_once 'database.php';

    // Log out user and destroy the session
    if ($_GET['logout'] == 1 AND $_SESSION['user_id']) {
        session_destroy();

        $message = 'You have been logged out';
    }

    if (!empty($_GET["error"])) {
        if ($_GET["error"] == 1) {
            $message = "Please log in or sign up";
        }
    }

    if (isset($_POST['login'])) {
        $error   = null;
        $message = null;

    //    $name     = !empty($_POST['name']) ? trim($_POST['loginname']) : null;
        $email    = !empty($_POST['loginemail']) ? trim($_POST['loginemail']) : null;
        $password = !empty($_POST['loginpassword']) ? trim($_POST['loginpassword']) : null;

        $sql = 'SELECT id, name, email, password FROM users WHERE email = :email';
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':email', $email);

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user === false) {
            $error = 'Incorrect login credentials';
        } else {
            $validPassword = password_verify($password, $user['password']);

            if ($validPassword) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['logged_in'] = 1;

                header('Location: diary.php');
                exit;
            } else {
                $error = 'Incorrect login credentials';
            }
        }
    }