<?php
/**
 *	Elgg chat plugin
 *	Author : Sarath C | Team Webgalli
 *	Team Webgalli | Elgg developers and consultants
 *	Mail : info@webgalli.com
 *	Web	: http://webgalli.com | http://plugingalaxy.com
 *	Installation info : http://webgalli.com/blog/facebook-like-chat-for-elgg/
 *	Skype : 'team.webgalli'
 *	@package Elgg-chat
 * 	Plugin info : Facebook like ajax chat for elgg
 *	Licence : GNU2
 *	Copyright : Team Webgalli 2011-2015
 */

elgg_register_event_handler('init', 'system', 'chat_init');

function chat_init() {
	elgg_extend_view('page/elements/head', 'chat/chat');
}
