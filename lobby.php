<?php
session_start();
include('database.php');

switch($_POST['btn'])
{
    case "修改":
    btn1();
    break;

    case "儲值":
    btn2();
    break;

    default:
    break;
}

function btn1(){
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
}

function btn2(){
    $account = $_SESSION['account'];
    $overage = $_POST['overage'];

    if ($account =="" || $overage ==""){
        echo "<script>alert('請輸入儲值金額'); location.href =  'store_home.php'; </script>";
        exit;
    }

    $db = new db;
    $row = $db->selectmoneyUser($account, $overage);
    $total = $row["overage"] + $overage;

    $db->moneyUser($account, $total);


    if ($total){
        echo "<script>alert('新增成功'); location.href =  'lobby_home.php'; </script>";
        exit;
    }
}