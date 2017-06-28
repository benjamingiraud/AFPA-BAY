<?php

$login    = htmlspecialchars($_POST['register']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email    = htmlspecialchars($_POST['email']);
$captcha;
if(isset($_POST['g-recaptcha-response'])) {
    $captcha=$_POST['g-recaptcha-response'];
}
if(!$captcha){
    echo '<h2>Please check the the captcha form.</h2>';
    exit();
}
$secretKey = '6LeD_CYUAAAAAD_Ze3T6BPTK7XcRVhN1ez3HDJrP';
$ip = $_SERVER['REMOTE_ADDR'];
$aContext = array(
    'http' => array(
        'proxy' => 'tcp://10.127.254.1:80',
        'request_fulluri' => true,
    ),
);
$cxContext = stream_context_create($aContext);

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip, false, $cxContext);
$responseKeys = json_decode($response, true);

if(intval($responseKeys["success"]) !== 1) {
    echo '<h2>You are spammer ! Get the @$%K out</h2>';
} else {
    require 'DataBase.php';
    DataBase::signUp($login, $password, $email);
}

?>
