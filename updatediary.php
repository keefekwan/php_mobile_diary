<?php

session_start();

require_once 'database.php';

    // Update text area
    $id    = $_SESSION['user_id'];
    $diary = null;

    if (!empty($_POST['diary'])) {
        $diary = $_POST['diary'];

        $sql = 'UPDATE users SET diary = ? WHERE id = ?';
        $stmt = $pdo->prepare($sql);

        $result = $stmt->execute(array(
            $diary,
            $id
        ));
    }
