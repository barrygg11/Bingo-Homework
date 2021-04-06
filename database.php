<?php
class db {
    function __construct() {
        $this->db = mysqli_connect("localhost", "root", "Zx11111!", "member") or die(mysqli_error());
    }

    function getUser($account, $password) {
        $ret = false;
        $sql = "select * from users where account = '$account' and password ='$password'";
        $result = mysqli_query($this->db, $sql);
        $row = mysqli_num_rows($result);

        if($row){
            $ret = true;
        }

        return $ret;
    }

    function addUser($params) {
            $sql = "select * from users where (account) = ('".$params['account']."')";
            $result = mysqli_query($this->db, $sql);
        if(mysqli_num_rows($result)>0){
            
        }else{
            $sql = "INSERT INTO users (username, phone, overage, account, password)";
            $sql .= "VALUES ('".$params['username']."', ".$params['phone'].", ".$params['overage'].", '".$params['account']."', '".$params['password']."')";
            mysqli_query($this->db, $sql);
            $check = self::getUser($params['account'], $params['password']);

            return $check;
        }
    }

    function editUser($username, $phone, $account, $password) {
        $sql = "UPDATE users SET username = '$username', phone = '$phone', password = '$password' where account = '$account'";
        mysqli_query($this->db, $sql);
    }

    // function storeUser($account, $overage, $username, $phone, $password){
    //     $sql = "INSERT INTO users (username, phone, overage, account, password) VALUES ('$username', '$phone', '$overage', '$account', '$password')";
    //     //$sql = "select sum(overage) from users where account = '$account'";
    //     mysqli_query($this->db, $sql);
    // }

    function dataUser($account){
        $sql = "select * from users where account = '$account' ";
        $result=mysqli_query($this->db,$sql);
        $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
        return $data;
    }

    function moneyUser($account, $overage){
        $sql = "UPDATE users SET overage = '$overage' where account = '$account'";
        mysqli_query($this->db,$sql);
    }

    function selectmoneyUser($account, $overage){
        $sql = "select overage from users where account = '$account'";
        $result=mysqli_query($this->db,$sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    // function selecmoneyUser($account, $overage){
    //     $sql = "select * from users like overage = '$overage' where account = '$account' ";
    //     $result=mysqli_query($this->db,$sql);
    // }

}
?>