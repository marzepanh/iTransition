<?php
    session_start();
    require_once 'connect.php';

    $login = $_POST['email'];
    $password = md5($_POST['password']."ghght24");

    $check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    $user = $check_user->fetch_assoc();

    if ($user['status']) {
        $_SESSION['message'] = 'This account was banned';
        header('Location: ../public/signin.php');
    } else {
        if (count($user) > 0) {
            setcookie('user', $user['login'], time() + 3600, "/");
            $last_login = date('d.m.Y H:i');
            mysqli_query($connect, "UPDATE `users` SET `last_login` = '$last_login' WHERE `login` = '$login'");
            header('Location: ../public/index.php');
        } else {
            $_SESSION['message'] = 'Wrong login or password';
            header('Location: ../public/signin.php');
        }
    }
