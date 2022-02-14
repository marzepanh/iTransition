<?php
    require_once '../vendor/connect.php';

    function isBanned($connect)
    {
        $login = $_COOKIE['user'];
        $status = mysqli_query($connect, "SELECT `status` FROM `users` WHERE `login` = '$login'");
        return mysqli_fetch_assoc($status)['status'];
    }
