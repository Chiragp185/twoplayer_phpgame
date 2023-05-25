<?php
// session_start();
$_SESSION['board'] = [0, 0, 0, 0, 0, 0, 0, 0, 0];
$_SESSION['placep1'] = 0;
$_SESSION['placep2'] = 0;
$_SESSION['win'] = 0;
$_SESSION['chance'] = 0;
?>
<html>

<head>
    <title>Board Game</title>
</head>

<body>


    <?php

    include 'maingame.php';

    ?>
</body>