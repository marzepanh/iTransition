<?php
    require_once 'connect.php';
    require_once '../vendor/isbanned.php';

    if (isBanned($connect)) {
        $_SESSION['message'] = 'You was banned';
        setcookie('user', $_COOKIE['user'], time() - 3600, "/");
        header('Location: ../public/signin.php');
    }

    if ($_POST['act'] == 'block') {
        foreach ($_POST['id'] as $userid) {
            mysqli_query($connect, "UPDATE `users` SET `status` = true
                WHERE `id` = '$userid'");

            $result = mysqli_query($connect, "SELECT `login` FROM `users` WHERE `id` = '$userid'");
            $login = mysqli_fetch_assoc($result)['login'];
            if ($login == $_COOKIE['user']) {
                setcookie('user', $login, time() - 3600, "/");
            }
        }
    } elseif ($_POST['act'] == 'unblock') {
        foreach ($_POST['id'] as $userid) {
            mysqli_query($connect, "UPDATE `users` SET `status` = false
                WHERE `id` = '$userid'");
        }
    } elseif ($_POST['act'] == 'delete') {
        foreach ($_POST['id'] as $userid) {
            $result = mysqli_query($connect, "SELECT `login` FROM `users` WHERE `id` = '$userid'");
            mysqli_query($connect, "DELETE FROM `users` WHERE `id` = '$userid'");

            $login = mysqli_fetch_assoc($result)['login'];
            if ($login == $_COOKIE['user']) {
                setcookie('user', $login, time() - 3600, "/");
            }
        }
    }

    header('Location: ../index.php');
