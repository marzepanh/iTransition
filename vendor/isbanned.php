<?php
    require_once 'connect.php';

    function isBanned($connect)
    {
        if (!isset($_COOKIE['user'])) {
            return false;
        }
        $login = $_COOKIE['user'];
        $status = mysqli_query($connect, "SELECT `status` FROM `users` WHERE `login` = '$login'");
        return mysqli_fetch_assoc($status)['status'];
    }
