<?php
session_start();
include('database.php');

    $account = $_POST['account'];
    $password = $_POST['password'];

    if ($account =="" || $password =="" ){
        echo "<script>alert('請輸入帳號密碼'); location.href =  'login.html'; </script>";
        exit;
    }

$user = new db;
$ret = $user->getUser($account, $password);
$_SESSION['account'] = $account;
$_SESSION['password'] = $password;

if($ret){
    header("Location: http://127.0.0.1/work/lobby_home.php");
}else{
    echo "<script>alert('登入失敗'); location.href =  'login.html'; </script>";
}
