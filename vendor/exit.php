<?php

setcookie('user', $_COOKIE['user'], time() - 3600, "/");
header('Location: ../public/index.php');