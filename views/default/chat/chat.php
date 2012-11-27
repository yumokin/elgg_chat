<?php
/**
 *	Elgg chat plugin
 *	Author : Sarath C | Team Webgalli
 *	Team Webgalli | Elgg developers and consultants
 *	Mail : webgalli@gmail.com
 *	Web	: http://webgalli.com | http://plugingalaxy.com
 *	Installation info : http://webgalli.com/blog/facebook-like-chat-for-elgg/
 *	Skype : 'team.webgalli'
 *	@package Elgg-chat
 * 	Plugin info : Facebook like ajax chat for elgg
 *	Licence : GNU2
 *	Copyright : Team Webgalli 2011-2015
 */
if (elgg_get_plugin_setting('chat_installed', 'chat') == 'yes') {
	//	For uninstalling ME , first remove/comment all FreiChatX related code i.e below code
	//	Then remove FreiChatX tables frei_session & frei_chat if necessary
	//	The best/recommended way is using the module for installation
	if(isset($_SESSION["guid"])==true) {$ses=$_SESSION["guid"]; } else {$ses=0;}
	if(!function_exists("freichatx_get_hash")){
	function freichatx_get_hash($ses){
		$file_name = elgg_get_plugins_path() . 'chat/vendors/freichat/arg.php';
		   if(file_exists($file_name)){
				   require ($file_name);
				   $temp_id =  $ses . $uid;
				   return md5($temp_id);
		   } else {
				   echo "<script>alert('module freichatx says: arg.php file notfound!');</script>";
		   }
		   return 0;
	}
	}
?>
<script type="text/javascript" language="javascipt" src="<?php echo elgg_get_site_url();?>mod/chat/vendors/freichat/client/main.php?id=<?php echo $ses;?>&xhash=<?php echo freichatx_get_hash($ses); ?>"> </script>    
<link rel="stylesheet" href="<?php echo elgg_get_site_url();?>mod/chat/vendors/freichat/client/jquery/freichat_themes/freichatcss.php" type="text/css">
<?php
	//  Current Version 7.2
}
?>