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
if (!isset($vars['entity']->chat_installed)) {
	$vars['entity']->chat_installed = 'no';
}
if ($vars['entity']->chat_installed == 'no'){
?>
Step 1 : <a href="<?php echo elgg_get_site_url()."mod/chat/vendors/freichat/installation/index.php";?>" target="_blank"><b> <?php echo elgg_echo('chat:install');?>  </b></a>
<?php } else { ?>
<a href="<?php echo elgg_get_site_url()."mod/chat/vendors/freichat/server/admin.php";?>" target="_blank"><?php echo elgg_echo('chat:admin');?> </a>
<?php } 
echo '<div>';
echo elgg_echo('chat:step2');
echo ' ';
echo elgg_view('input/dropdown', array(
	'name' => 'params[chat_installed]',
	'options_values' => array(
		'no' => elgg_echo('option:no'),
		'yes' => elgg_echo('option:yes')
	),
	'value' => $vars['entity']->chat_installed,
));
echo '</div>';
