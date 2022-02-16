<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'id18467412_root');
define('DB_PASSWORD', 'Qsp4B%2|yiaFjU*Z');
define('DB_NAME', 'id18467412_users');

$connect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$connect) {
    echo 'Error connect to database';
}