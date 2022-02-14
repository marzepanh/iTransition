<?php
    session_start();
    require_once 'connect.php';
    $login = $_POST['email'];
    $password = md5($_POST['password']."ghght24");
    $name = $_POST['name'];
    $registration_date = date('d.m.Y H:i');

    mysqli_query($connect, "INSERT INTO `users` (`id`, `name`, `login`, `password`, `registration_date`,
        `last_login`, `status`) VALUES (NULL, '$name', '$login', '$password', '$registration_date', NULL, false)");
    $_SESSION['message'] = "Successful registration. Log in now";

    header('Location: ../public/signin.php');