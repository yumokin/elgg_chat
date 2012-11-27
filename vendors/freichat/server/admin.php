<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

if(isset($_GET['logout'])){
    
    unset($_SESSION['phplogin']);
    
}

if (!isset($_SESSION['phplogin']) || $_SESSION['phplogin'] !== true) {
    header('Location: ../administrator/index.php'); //Replace that if login.php is somewhere else
    exit;
}

define('FREI_ADMIN', 'true');
require_once '../arg.php';
require_once '../define.php';
$construct = new freichatXconstruct();
$db = $construct->connectDB();
function get_file_names($path, $type, $replace=false) {
    $handle = opendir($path);
    $store = array();
    if ($type == "dir" || $type == "file") {
        if ($path) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && $file != '.svn') {
                    if ((is_dir($path . $file) && $type == "dir") || $type == "file") {
                        if ($type == "file" && $replace == true) {
                            $file = str_replace(".php", "", $file);
                        }
                        $store[] = $file;
                    }
                }
            }
            closedir($handle);
        }
    }
    return $store;
}
?><html>
    <head>
        <title>
            FreiChatX Parameters
        </title>
        
<script type="text/javascript" src="../client/jquery/js/jquery.1.7.1.js"></script>

<script type="text/javascript" src="../client/jquery/js/jquery-ui.js"></script>


<link rel="stylesheet" href="../client/jquery/js/smoothness/jquery-ui.css">

        
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <style type="text/css">
            body{
                background-attachment:fixed;
                background-position:center;
                background-repeat:no-repeat;
                background-color:#FFFFFF;
                color:black;
            }
            a{

                color:white;
                font-style:underline;

            }
            a:hover{
                color:red;
            }
        </style>
<link href="../favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <?php
        if (isset($_REQUEST['freiload'])) {
            if (is_file('admin_files/' . $_REQUEST['freiload'] . '/head.php')) {
                require('admin_files/' . $_REQUEST['freiload'] . '/head.php');
            } else {
                //var_dump($_REQUEST);


                echo "\n<!-- requested loadable header could not be found! -->\n";
            }
        } else {
            require('admin_files/home/head.php');
            //require('admin_files/home/index.php');
        }
        ?>

    </head>
    <body>

        <div style="position:fixed;left:0px;top:0px;">
            <a href="admin.php"><img src="admin_files/home/home.jpg" height="40" width="40" /></a>
            <a href="admin.php?logout=true"><img src="admin_files/home/logout.png" height="40" width="40"/></a>
            
        </div>
        
        <div style="text-align:center">

            <a href="admin.php" title="home"><img src="admin_files/home/head.png" height=100 style="width:contain" /></a>
            
        </div>
        

        
        <style>
            
.container  {
    display:inline-block;
    
    background: url(admin_files/home/csg-4fc0ca9e286e3.png) no-repeat top left;
}
            
.sprite-chatroom{ background-position: 0 0; width: 200px; height: 201px; } 
.sprite-chatroom_b{ background-position: 0 -251px; width: 200px; height: 201px; } 
.sprite-file1{ background-position: 0 -502px; width: 200px; height: 201px; } 
.sprite-file1_b{ background-position: 0 -753px; width: 200px; height: 201px; } 
.sprite-general{ background-position: 0 -1004px; width: 200px; height: 201px; } 
.sprite-general_b{ background-position: 0 -1255px; width: 200px; height: 201px; } 
.sprite-mail{ background-position: 0 -1506px; width: 200px; height: 201px; } 
.sprite-mail_b{ background-position: 0 -1757px; width: 200px; height: 201px; } 
.sprite-theme_maker{ background-position: -250px 0; width: 200px; height: 201px; } 
.sprite-theme_maker_b{ background-position: -250px -251px; width: 200px; height: 201px; } 
            </style>

            
            
            <div style="text-align: center">
            <div id="homecontainer" style="text-align:left;width:60%;margin: 0px auto;">
            
            
            <!--
        <table border=0 cellpadding="6" align="center">
            <tr>


                <td valign=top width="80%">-->
                    <?php
                    if (isset($_REQUEST['freiload'])) {
                        
                   
                        
                        if (is_file('admin_files/' . $_REQUEST['freiload'] . '/index.php')) {
                            require('admin_files/' . $_REQUEST['freiload'] . '/index.php');
                        } else {
                            var_dump($_REQUEST);
                            echo "requested loadable could not be found!";
                        }
                    } else {
                        require('admin_files/default/index.php');
                    }
                    ?>
                <!--</td>
            </tr>

        </table>-->
</div> 
            </div>
    </body>
</html>
