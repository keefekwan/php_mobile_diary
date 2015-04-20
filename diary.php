<?php
session_start();

require_once 'database.php';

// If the user is not logged in redirect to index
if (!$_SESSION['logged_in']) {
    header("Location:index.php?error=1");
} else {

    $id = $_SESSION['user_id'];

    $sql = 'SELECT diary FROM users WHERE id = ? LIMIT 1';

    $stmt = $pdo->prepare($sql);

    $result = $stmt->execute(array(
        $id
    ));

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $diary = $row['diary'];

    if (!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])) {
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mobile Diary</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/diary.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body data-spy="scroll" data-target=".navbar-collapse">

<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header pull-left">
            <a class="navbar-brand">Mobile Diary</a>
        </div>

        <div class="pull-right">
            <ul class= "navbar-nav nav">
                <li><a href="index.php?logout=1">Log Out</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container contentContainer" id="topContainer">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" id="topRow">

            <textarea class="form-control"><?php if (!empty($diary)) { echo $diary; } ?></textarea>
        </div>
    </div>

</div>

<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/diary.js"></script>

</body>
</html>