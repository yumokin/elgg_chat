<?php
session_start();
require('../arg.php');
if (isset($_POST['login'])) {
    $password = $_POST['pswd'];
    if ($password == $admin_pswd) { //Replace mypassword with your password it login
        $_SESSION['phplogin'] = true;
        header('Location: params.php'); //Replace index.php with what page you want to go to after succesful login
        exit;
    } else {
        ?>
        <script type="text/javascript">
            <!--
            alert('Wrong Password, Please Try Again')
            //-->
        </script>
        <?php
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
    <head>
        <title> PHP Login </title>
    </head>
    <body>
        <center>
            Password:<br>
            <form method="post" action="">
                <input type="" name="pswd">(defined in freichat/arg.php)
                <input type="submit" name="login" value="Login">
            </form>
        </center>
    </body>
</html>
