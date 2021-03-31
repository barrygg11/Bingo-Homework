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

$params = array(
    'username' => $username,
    'phone' => $phone,
    'overage' => $overage,
    'account' => $account,
    'password' => $password
);



$user = new user;
$check = $user -> addUser($params);

if ($check){
    echo "<script>alert('註冊成功'); location.href =  'login.html'; </script>";
}else{
    echo "<script>alert('註冊失敗'); location.href =  'register.html'; </script>";
}