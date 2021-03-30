<?php
include('user.php');

    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $overage = $_POST['overage'];
    $account = $_POST['account'];
    $password = $_POST['password'];

    if ($username =="" || $phone =="" || $overage =="" || $account =="" || $password ==""){
        echo "內容請填寫完整";
        exit;
    }

$user = new user;
$user -> addUser($username, $phone, $overage, $account, $password);