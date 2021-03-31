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
        $sql = "INSERT INTO users (username, phone, overage, account, password)";
        $sql .= "VALUES ('".$params['username']."', ".$params['phone'].", ".$params['overage'].", '".$params['account']."', '".$params['password']."')";
        mysqli_query($this->db, $sql);
        $check = self::getUser($params['account'], $params['password']);

        return $check;
    }
}
?>