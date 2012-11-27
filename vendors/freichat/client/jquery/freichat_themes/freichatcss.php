<?php
session_start();


header("Content-Type: text/css");
require_once '../../../arg.php';

if(isset($_GET['do']) && $_GET['do']=='theme'){
if(isset($_SESSION[$uid . 'curr_theme'])) {
$freichat_theme = $_SESSION[$uid . 'curr_theme'];
}
}


if($_SESSION[$uid.'rtl'] == true) {
require $freichat_theme . '/css_rtl.php';
}else
{
require $freichat_theme . '/css.php';    
}
?>
