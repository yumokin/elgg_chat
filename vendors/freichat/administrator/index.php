<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
require('../arg.php');

$path_host = str_replace("administrator/index.php", "", "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']);

if (isset($_POST['login'])) {


    $password = $_POST['pswd'];

    if ($password == $admin_pswd) { //Replace mypassword with your password it login
        $_SESSION['phplogin'] = true;
//echo 'ddd';
        header('Location: ' . $path_host . 'server/admin.php'); //Replace index.php with what page you want to go to after succesful login

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
        <link rel="stylesheet" href="index.css"/>
        <style type="text/css">
            body{
                background-attachment:fixed;
                background-position:center;
                background-repeat:no-repeat;
                background-color: #ffffff;
            }
            
              .adminbutton {
                -moz-box-shadow:inset 0px 0px 0px 0px #bbdaf7;
                -webkit-box-shadow:inset 0px 0px 0px 0px #bbdaf7;
                box-shadow:inset 0px 0px 0px 0px #bbdaf7;
                background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5) );
                background:-moz-linear-gradient( center top, #79bbff 5%, #378de5 100% );
                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5');
                background-color:#79bbff;
                -moz-border-radius:10px;
                -webkit-border-radius:10px;
                border-radius:10px;
                border:2px solid #84bbf3;
                display:inline-block;
                color:#ffffff;
                font-family:Arial;
                font-size:28px;
                font-weight:bold;
                padding:10px 42px;
                text-decoration:none;
                text-shadow:1px 0px 0px #528ecc;
            }.adminbutton:hover {
                background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff) );
                background:-moz-linear-gradient( center top, #378de5 5%, #79bbff 100% );
                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff');
                background-color:#378de5;
            }.adminbutton:active {
                position:relative;
                top:1px;
            }
            
                @font-face {
        font-family: 'Exo';
        font-style: italic;
        font-weight: 600;
        src: local('Exo DemiBold Italic'), local('Exo-DemiBoldItalic'), url('../server/admin_files/theme_maker/exo.woff') format('woff');
    }

    @font-face {
        font-family: 'Sonsie One';
        font-style: normal;
        font-weight: 400;
        src: local('Sonsie One'), local('SonsieOne-Regular'), url('../server/admin_files/theme_maker/sonsieone.woff') format('woff');
    }


          
        </style>
        <title> FreiChat Backend Login </title>
    </head>
    <body>

        <div style="text-align:center">

            <img src="../server/admin_files/home/head.png" height=100  />
        </div>


     
        <div id="main" class="main" >
            <!--<h2>Administration Authentication</h2>-->
            <div id="container" class="container">
                <form method="post" action="index.php">

                    <b><span style="font-family: 'Sonsie One'">Enter Password:</span></b><br><br/>
                    &nbsp;<input style="width: 200px; border: 1px solid gray" type="password" name="pswd" value=''><br/>
                    <br/><span class="info">(defined in freichat/arg.php)</span><br/><br/>
                    <input class="adminbutton" type="submit" name="login" value="Login">
                </form>
            </div>
        </div>
    </body>
</html>
