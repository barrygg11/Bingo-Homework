<?php
class db {
    //建構子會自動執行，有function需要使用$this->db
    function __construct() {
        $this->db = mysqli_connect("localhost", "root", "Zx11111!", "member") or die(mysqli_error());
    }

    //來檢查帳號密碼登入
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

    //先判斷帳號是否有被註冊過，如果有顯示註冊過，如果沒有就可以註冊使用者
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

    //修改會員資料
    function editUser($username, $phone, $account, $password) {
        $sql = "UPDATE users SET username = '$username', phone = '$phone', password = '$password' where account = '$account'";
        mysqli_query($this->db, $sql);
    }

    //查詢當前是哪個使用者session
    function dataUser($account){
        $sql = "select * from users where account = '$account' ";
        $result=mysqli_query($this->db,$sql);
        $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
        return $data;
    }

    //儲值金額到資料庫(當前資料庫的金額和儲值的金額)
    function moneyUser($account, $overage){
        $sql = "UPDATE users SET overage = '$overage' where account = '$account'";
        mysqli_query($this->db,$sql);
    }

    //取出當前資料庫的金額
    function selectmoneyUser($account, $overage){
        $sql = "select overage from users where account = '$account'";
        $result=mysqli_query($this->db,$sql);
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    //取出game資料
    function getGameOdds($gtype){
        $sql = "select odd from game where gtype = '$gtype'";
        $result=mysqli_query($this->db,$sql);
        $data = mysqli_fetch_all($result,MYSQLI_NUM);
        return $data; //回傳一個值
    }

    //寫入獲勝者資料
    function insertGame1Result($user_id,$gtype,$wtype,$gold,$odd,$wingdd){
     $sql = "INSERT INTO orders(user_id,gtype, wtype, gold, odd, wingdd, time) VALUES('$user_id','$gtype','$wtype','$gold','$odd','$wingdd',now())";
     $result=mysqli_query($this->db,$sql);
    }

}
?>