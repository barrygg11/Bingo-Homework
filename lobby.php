<?php
session_start();
include('database.php');

$username = $_POST['username'];
$phone = $_POST['phone'];
$account = $_SESSION['account'];
$password = $_POST['password'];

    if ($username =="" || $phone =="" || $account =="" || $password ==""){
        echo "<script>alert('內容請填寫完整'); location.href =  'edit.php'; </script>";
        exit;
    }

    $edit = new db;
    $edit->editUser($username, $phone, $account, $password);

    if($edit){
        echo "<script>alert('修改成功'); location.href =  'lobby_home.php'; </script>";
    }