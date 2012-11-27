<?php

        /* FreiChatX parameters */

        if(!defined('RDIR'))
        {
         define('RDIR', dirname(__FILE__));
	     define('PARENTDIR',dirname(RDIR));
        }

		if(@$_SERVER["HTTPS"] == "on")
		{
		  $protocol = "https://";
		}
		else
		{
		  $protocol = "http://";
		}


        $parameters=unserialize(file_get_contents(str_replace('arg.php','config.dat',__FILE__)));

        $PATH = 'freichat/'; // Use this only if you have placed the freichat folder somewhere else
	    $installed=false;
        $admin_pswd='adminpass';
        $url=$protocol.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
	    $show_name=$parameters['show_name']; //you can have guest or user
        $displayname=$parameters['displayname']; //you can have username / name(nickname)
        $show_module=$parameters['show_module']; //you can have'visible' or'hidden'
        $chatspeed=$parameters['chatspeed']; //Do not change this value
        $fxval=$parameters['fxval']; //Set it to false if you do not want animations
        $draggable=$parameters['draggable'];
        $conflict=$parameters['conflict']; //Jquery Conflicts 'true' or ''
        $msgSendSpeed=$parameters['msgSendSpeed']; //Message are sent after 1 second of post, reducing it will increase FreiChatX message sending speed but also will send more requests to the server! NOTE:: Do not decrease it below 1000
        $show_avatar=$parameters['show_avatar']; //Can have block or none

        $debug=$parameters['debug']; //option for debugging ,default is false
        $freichat_theme=$parameters['freichat_theme'];
        $css=$freichat_theme; //background color
        $color=$css; //colour for chatbuttons
        $lang=$parameters['lang']; //Language please do not include .php here only file name

        $load=$parameters['load']; //chatbox
        $dyncss='disable'; //template patch
        $evnixpower='visible'; //powered by evnix
        $show_chatbox='';
        $time=$parameters['time']; //In seconds
	$GZIP_handler = $parameters['GZIP_handler'];

        $JSdebug=$parameters['JSdebug']; // Javascript debug info shown in firebug (firefox extension). No quotes around true or false
        $busy_timeOut=$parameters['busy_timeOut']; //In seconds user will be switched to busy status
        $offline_timeOut=$parameters['offline_timeOut']; //In seconds user will be switched to offline status

        /*FreiChatX plugins*/
        
        // File sending
          $show_file_sending_plugin=$parameters['plugins']['file_sender']['show'];
          $file_size_limit=$parameters['plugins']['file_sender']['file_size']; //In Kilobytes
          $expirytime=$parameters['plugins']['file_sender']['expiry']; //In minutes after which the uploaded files will be deleted
          $valid_exts=$parameters['plugins']['file_sender']['valid_exts']; //valid extensions separated by comma
          $playsound = $parameters["playsound"];
        
        //Translate
	  $show_translate_plugin = 'disabled';

	//Chatroom plugin
	  $show_chatroom_plugin = 'enabled';

        //Video Chat plugin    
          $show_videochat_plugin = 'disabled';  //Pending !!
                    
	//coversation save
          $show_save_plugin = 'enabled';
          
       //smiley plugin   
          $show_smiley_plugin = 'enabled';
        
       //send conversation plugin
          $show_mail_plugin = 'enabled';
          $smtp_username='';
	  $smtp_password='';
	  $mailtype=$parameters["plugins"]["send_conv"]["mailtype"];
	  $smtp_server=$parameters["plugins"]["send_conv"]["smtp_server"];
	  $smtp_port=$parameters["plugins"]["send_conv"]["smtp_port"];
	  $smtp_protocol=$parameters["plugins"]["send_conv"]["smtp_protocol"];
	  $mail_from_address=$parameters["plugins"]["send_conv"]["from_address"];
	  $mail_from_name=$parameters["plugins"]["send_conv"]["from_name"];
  
       //long polling 
          $poll_time = $parameters['polling_time'];
          $long_polling = $parameters['polling'];
                
       // link profile
          $linkprofile = $parameters['link_profile'];

	// ACL PERMISSIONS 
	// Here allow or noallow can be used to grant and prohibit permissions respectively 



            $ACL = array(
            'FILE' => array(          /* File upload/send plugin */
            'user' => $parameters['filesend']['user'],
            'guest' => $parameters['filesend']['guest']
            ),

            'TRANSLATE' => array(
            'user' => 'noallow',
            'guest' => 'noallow'
            ),

            'SAVE' => array(
            'user' => $parameters['save']['user'],
            'guest' => $parameters['save']['guest']
            ),

            'SMILEY' => array(
            'user' => $parameters['smiley']['user'],
            'guest' => $parameters['smiley']['guest']
            ),

            'MAIL' => array(
            'user' => $parameters['mail']['user'],
            'guest' => $parameters['mail']['guest']
            ), 
            
            'VIDEOCHAT' => array(
            'user' => 'noallow',
            'guest' => 'noallow'                
            ),
            
            'CHATROOM' => array(          /* File upload/send plugin */
            'user' => $parameters['chatroom']['user'],
            'guest' => $parameters['chatroom']['guest']
            )
 
            );

            if($parameters['chatroom']['user']=='noallow' && $parameters['chatroom']['guest']=='noallow'){
                
                $show_chatroom_plugin = 'disabled';
                
            }
            


            /* ACL PERMISSIONS */

         /* To ensure boolean is parsed */

                if($debug == "true")
                {
                    $debug = true;
                }
                else
                {
                    $debug = false;
                }

                //Also

                if($JSdebug == "true")
                {
                    $JSdebug = true;
                }
                else
                {
                    $JSdebug = false;
                }


        /* Data base details */
        $con='mysql';
        $username='root';
        $password='';
        $client_db_name='j7';
        $host='localhost';
        $driver='Joomla';
        $db_prefix='jos_';
        $uid='4fdc230b040c0';


 /* NOTE:= Below setting only applies to users using custom driver*/

 //Tell FreiChatX what to use { Pure session }  OR { Session and database }
/*
 * Psession   -> Pure sessions
 * Sdatabase  -> Session with database
 */

        $freiuse="Sdatabase"; //can have value as Psession or Sdatabase

  /* If you are using only sessions to store User details */
//Please use only the index of session variable

//The default value in user name or user id  session when user is a guest
        $default_ses=null; //If you dont make any checks leave it null

        $ses_username='root';  /* Username stored in session*/ //Only index value
        $ses_userid='loginid';      /* Userid stored in session */ //Only index value

        /* OR */

/* if you are using database table to store User details */
        $usertable='login'; //specifies the name of the table in which your user information is stored.
        $row_username='root'; //specifies the name of the field in which the user's name/display name is stored.
        $row_userid='loginid'; //specifies the name of the field in which the user's id is stored (usually id or userid)
		
	//Avatar
	$avatar_field_name = 'avatar';
?>
