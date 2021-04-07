<?php session_start();
include ('database.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>會員儲值系統</title>
    </head>
    <body>
        <?php 
        $account = $_SESSION['account'];
        $overage = $_SESSION['overage'];
        $data = new db;
        $lobby = $data -> dataUser($account);
        
        ?>

<?php
        $total = new db;
        $row = $total->selectmoneyUser($account, $overage);
        ?>
        
        <form name="store" action="lobby.php" method="post">
            帳號 : <input type="text" name="account" value="<?php echo $account; ?>" disabled><p>   
            儲值金額 : <input type="text" name="overage"><p>
        <input type="submit" name="btn" value="儲值">
        <input type="button" onclick="history.back()" value="回上頁"></input><p>
            金額：$ <?php echo($lobby['overage'])?>
        </form>
    </body>
</html>