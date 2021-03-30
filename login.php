<?php
include('user.php');

    $account = $_POST['account'];
    $password = $_POST['password'];

    if ($account =="" || $password =="" ){
        echo "請輸入帳號密碼";
        exit;
    }

$user = new user;
$user -> getUser($account, $password);

