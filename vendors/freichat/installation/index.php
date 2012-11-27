<?php
$url = (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
session_start();
if (!isset($_SESSION['FREIX'])) {
    $_SESSION['FREIX'] = 'authenticated';
}
require('../arg.php');
$_SESSION['index'] = time() + rand(989, 98999);
if ($installed == true) {
    
    $_SESSION['error']="FreiChatX is already installed on your server<br/>Hence for security reasons , the install has been locked.<br/>Yet if you want to install it again or think if FreiChatX is wrong <br/> please change the variable \$installed to false in ~/freichat/arg.php and then try again";
    header('Location: error.php');
    exit;
}
?>
<?php


require 'header.php';

?>

<div>

<p style="text-align:center"><b>Please Read The Below Document Carefully</b></p>

<br/>

<div style='overflow:scroll;overflow-x:hidden;width:80%;height:300px;text-align:left;font-size:small;padding-left:10%'>
<i>
<?php echo str_replace("\n", "<br/>", file_get_contents('license.txt')); ?>
</i>
</div>

<br/>
<br/>
<form id="theform" action="specific.php?<?php echo $_SESSION['index']; ?>=true" method="post">
    
    <div style="text-align:center">
    <a href="JavaScript:void(0);" onclick="$('#theform').submit()" class="acceptbutton">Accept</a>
    <a href="../index.php" class="rejectbutton">Reject</a>
    </div>
</form>

</div>

<?php
require 'footer.php';
?>