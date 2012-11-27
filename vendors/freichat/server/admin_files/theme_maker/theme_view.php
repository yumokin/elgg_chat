
        
    <link rel="stylesheet" type="text/css" href="../client/jquery/freichat_themes/freichatcss.php?do=theme" />
    <link rel="stylesheet" type="text/css" href="../server/admin_files/theme_maker/style.css" />
 
<script type="text/javascript">
<?php

//session_start();
//error_reporting(-1);

$path = '../';
require $path . 'arg.php';

//$_SESSION[$uid . 'new_project'] = $chk->chk_project();


$_SESSION[$uid.'curr_theme']=$_GET['theme_name'];
require $path . 'client/jquery/freichat_themes/'.$_SESSION[$uid . 'curr_theme'].'/argument.php';
//require $path . 'client/jquery/js/jquery.1.7.1.js';
//require $path . 'client/jquery/js/jquery-ui.js';
require $path . 'server/admin_files/theme_maker/definitions.js';
require $path . 'server/admin_files/theme_maker/plugins.js';
require $path . 'server/admin_files/theme_maker/functions.js';
require $path . 'client/plugins.js';
//require $path . 'client/chatroom.js';

require $path . 'server/admin_files/theme_maker/theme_builder.js';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
</script>