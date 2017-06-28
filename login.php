<?php
$login    = $_POST['login'];
$password = $_POST['password'];

require 'DataBase.php';
$succes = DataBase::SignIn($login, $password);
if ($succes[0]) {
    $_SESSION['login'] = $login;
    $_SESSION['loginID'] = $succes[1];
}

?>