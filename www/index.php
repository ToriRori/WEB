<?php include __DIR__ . '/config.php'; require_once './init.php'; ?>

<?php $URL = $_SERVER["REQUEST_URI"];
$URL = explode("?", $URL, 2)[0];?>

<html>
<body>

<?php if ($URL == '/php-app-master/www/index.php')
{
    /*if ("Vica" == $_GET["name"])
    {
        echo "Hello, my Dear friend";
    }
    else{
        echo "Go away!!!";
    }*/
}
else
{
    echo "ERROR 404";
}
?>

<form action="login.php" method="post">
    <p>Login: <input type="text" name="login" /></p>
    <p>Password: <input type="password" name="password" /></p>
    <?php if(!empty($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    <p><input type="submit" name = "login_btn" value="Login" /></p>
    <p><input type="submit" name = "signup_btn" value="Sign Up"></p>
</form>

</body>
</html>