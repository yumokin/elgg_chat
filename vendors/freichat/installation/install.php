<?php
session_start();


//security check
if (!isset($_SESSION['FREIX']) || $_SESSION['FREIX'] != 'authenticated' || !isset($_POST['host'])) {
    header("Location:index.php");
    exit;
}

if (!is_writable("../arg.php")) {
    //die("arg.php is not writable!<br/>Go back and change ~/freichat/arg.php permisssions");
    $_SESSION['error'] = 'arg.php is not writable!<br/>Go back and change ~/freichat/arg.php permisssions';
    header('Location: error.php');
}

class Install {

    public function __construct() {
        $this->installed = 'true';
        $this->path_host = str_replace("installation/install.php", "", "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME']);
    }

    public function argument() {
        $filepath = "../arg.php";
        $handle = fopen($filepath, 'w');

        $contents = '<?php

        /* FreiChatX parameters */

        if(!defined(\'RDIR\'))
        {
         define(\'RDIR\', dirname(__FILE__));
	     define(\'PARENTDIR\',dirname(RDIR));
        }

		if(@$_SERVER["HTTPS"] == "on")
		{
		  $protocol = "https://";
		}
		else
		{
		  $protocol = "http://";
		}


        $parameters=unserialize(file_get_contents(str_replace(\'arg.php\',\'config.dat\',__FILE__)));

        $PATH = \'' . $_POST["freichat_to_path"] . '/\'; // Use this only if you have placed the freichat folder somewhere else
	    $installed=' . $this->installed . ';
        $admin_pswd=\'' . $_POST["adminpass"] . '\';
        $url=$protocol.$_SERVER[\'HTTP_HOST\'].$_SERVER[\'SCRIPT_NAME\'];
	    $show_name=$parameters[\'show_name\']; //you can have guest or user
        $displayname=$parameters[\'displayname\']; //you can have username / name(nickname)
        $show_module=$parameters[\'show_module\']; //you can have\'visible\' or\'hidden\'
        $chatspeed=$parameters[\'chatspeed\']; //Do not change this value
        $fxval=$parameters[\'fxval\']; //Set it to false if you do not want animations
        $draggable=$parameters[\'draggable\'];
        $conflict=$parameters[\'conflict\']; //Jquery Conflicts \'true\' or \'\'
        $msgSendSpeed=$parameters[\'msgSendSpeed\']; //Message are sent after 1 second of post, reducing it will increase FreiChatX message sending speed but also will send more requests to the server! NOTE:: Do not decrease it below 1000
        $show_avatar=$parameters[\'show_avatar\']; //Can have block or none

        $debug=$parameters[\'debug\']; //option for debugging ,default is false
        $freichat_theme=$parameters[\'freichat_theme\'];
        $css=$freichat_theme; //background color
        $color=$css; //colour for chatbuttons
        $lang=$parameters[\'lang\']; //Language please do not include .php here only file name

        $load=$parameters[\'load\']; //chatbox
        $dyncss=\'disable\'; //template patch
        $evnixpower=\'visible\'; //powered by evnix
        $show_chatbox=\'\';
        $time=$parameters[\'time\']; //In seconds
	    $GZIP_handler = $parameters[\'GZIP_handler\'];

        $JSdebug=$parameters[\'JSdebug\']; // Javascript debug info shown in firebug (firefox extension). No quotes around true or false
        $busy_timeOut=$parameters[\'busy_timeOut\']; //In seconds user will be switched to busy status
        $offline_timeOut=$parameters[\'offline_timeOut\']; //In seconds user will be switched to offline status

        /*FreiChatX plugins*/
        
        // File sending
          $show_file_sending_plugin=$parameters[\'plugins\'][\'file_sender\'][\'show\'];
          $file_size_limit=$parameters[\'plugins\'][\'file_sender\'][\'file_size\']; //In Kilobytes
          $expirytime=$parameters[\'plugins\'][\'file_sender\'][\'expiry\']; //In minutes after which the uploaded files will be deleted
          $valid_exts=$parameters[\'plugins\'][\'file_sender\'][\'valid_exts\']; //valid extensions separated by comma
          $playsound = $parameters["playsound"];
        
        //Translate
	  $show_translate_plugin = \'disabled\';

	//Chatroom plugin
	  $show_chatroom_plugin = \'enabled\';

        //Video Chat plugin    
          $show_videochat_plugin = \'disabled\';  //Pending !!
                    
	//coversation save
          $show_save_plugin = \'enabled\';
          
       //smiley plugin   
          $show_smiley_plugin = \'enabled\';
        
       //send conversation plugin
          $show_mail_plugin = \'enabled\';
          $smtp_username=\'\';
	  $smtp_password=\'\';
	  $mailtype=$parameters["plugins"]["send_conv"]["mailtype"];
	  $smtp_server=$parameters["plugins"]["send_conv"]["smtp_server"];
	  $smtp_port=$parameters["plugins"]["send_conv"]["smtp_port"];
	  $smtp_protocol=$parameters["plugins"]["send_conv"]["smtp_protocol"];
	  $mail_from_address=$parameters["plugins"]["send_conv"]["from_address"];
	  $mail_from_name=$parameters["plugins"]["send_conv"]["from_name"];
  
       //long polling 
          $poll_time = $parameters[\'polling_time\'];
          $long_polling = $parameters[\'polling\'];
                
       // link profile
          $linkprofile = $parameters[\'link_profile\'];

	// ACL PERMISSIONS 
	// Here allow or noallow can be used to grant and prohibit permissions respectively 



            $ACL = array(
            \'FILE\' => array(          /* File upload/send plugin */
            \'user\' => $parameters[\'filesend\'][\'user\'],
            \'guest\' => $parameters[\'filesend\'][\'guest\']
            ),

            \'TRANSLATE\' => array(
            \'user\' => \'noallow\',
            \'guest\' => \'noallow\'
            ),

            \'SAVE\' => array(
            \'user\' => $parameters[\'save\'][\'user\'],
            \'guest\' => $parameters[\'save\'][\'guest\']
            ),

            \'SMILEY\' => array(
            \'user\' => $parameters[\'smiley\'][\'user\'],
            \'guest\' => $parameters[\'smiley\'][\'guest\']
            ),

            \'MAIL\' => array(
            \'user\' => $parameters[\'mail\'][\'user\'],
            \'guest\' => $parameters[\'mail\'][\'guest\']
            ), 
            
            \'VIDEOCHAT\' => array(
            \'user\' => \'noallow\',
            \'guest\' => \'noallow\'                
            ),
            
            \'CHATROOM\' => array(          /* File upload/send plugin */
            \'user\' => $parameters[\'chatroom\'][\'user\'],
            \'guest\' => $parameters[\'chatroom\'][\'guest\']
            )
 
            );

            if($parameters[\'chatroom\'][\'user\']==\'noallow\' && $parameters[\'chatroom\'][\'guest\']==\'noallow\'){
                
                $show_chatroom_plugin = \'disabled\';
                
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
        $con=\'mysql\';
        $username=\'' . $_POST["muser"] . '\';
        $password=\'' . $_POST["mpass"] . '\';
        $client_db_name=\'' . $_POST["dbname"] . '\';
        $host=\'' . $_POST["host"] . '\';
        $driver=\'' . $_POST["driver"] . '\';
        $db_prefix=\'' . $_POST["dbprefix"] . '\';
        $uid=\'' . uniqid() . '\';


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

        $ses_username=\'root\';  /* Username stored in session*/ //Only index value
        $ses_userid=\'loginid\';      /* Userid stored in session */ //Only index value

        /* OR */

/* if you are using database table to store User details */
        $usertable=\'login\'; //specifies the name of the table in which your user information is stored.
        $row_username=\'root\'; //specifies the name of the field in which the user\'s name/display name is stored.
        $row_userid=\'loginid\'; //specifies the name of the field in which the user\'s id is stored (usually id or userid)
		
	//Avatar
	$avatar_field_name = \'avatar\';
?>';

        fwrite($handle, $contents);
        fclose($handle);
    }

    public function connectDB() {
        try {
            $this->db = new PDO('mysql:host=' . $_POST["host"] . ';dbname=' . $_POST["dbname"], $_POST["muser"], $_POST["mpass"]);
        } catch (PDOException $e) {
            $this->installed = 'false';
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function dropTables() {
        $this->db->query("DROP TABLE IF EXISTS `frei_chat`");
        $this->db->query("DROP TABLE IF EXISTS `frei_session`");
        $this->db->query("DROP TABLE IF EXISTS `frei_rooms`");
    }

    public function createTables() {
        $this->db->query("CREATE TABLE IF NOT EXISTS `frei_chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `from_name` varchar(30) NOT NULL,
  `to` int(11) NOT NULL,
  `to_name` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  `time` decimal(15,0) NOT NULL,
  `GMT_time` bigint(20) NOT NULL,
  `message_type` int(11) NOT NULL DEFAULT '0',
  `room_id` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");


        $this->db->query("CREATE TABLE IF NOT EXISTS `frei_session` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `time` int(100) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `permanent_id` int(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `status_mesg` varchar(100) NOT NULL,
  `guest` tinyint(3) NOT NULL,
  `in_room` int(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permanent_id` (`permanent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

        $this->db->query("CREATE TABLE IF NOT EXISTS `frei_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` text NOT NULL,
  `room_order` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;");

        $this->db->query("INSERT INTO `frei_rooms` (`id`, `room_name`, `room_order`) VALUES
(1, 'Innovative Talk', 3),
(2, 'Fun Talk', 1),
(3, 'Boring Talk', 0),
(4, 'General Talk', 2),
(5, 'Supreme talk', -4);");
    }

    public function init() {

        $this->connectDB();
        $this->dropTables();
        $this->createTables();
        $this->argument();

        $cname = $_POST['driver'];
        require 'integ/' . $cname . '.php';
        $cls = new $cname();
        $cls->path_host = $this->path_host;
        $output = $cls->info($this->path_host);
        $output['auto_install'] = $cls->self_install();

        return $output;
    }

}

$install = new Install();
$info = $install->init();

?>
<?php
require("header.php");
?>

<script>
    $(document).ready(function(){
        $('#content_manual').dialog({ autoOpen: false, minWidth: 800 ,title:"Manual Installation" });
    });

    function maximize()
    {                       
        $('#content_manual').dialog('open');       
    }


</script>


<?php
$submit_url = (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>
<!---COMMERCIAL_CODE--->




<div style="text-align: center"> 
    <span  style="font-family: 'Sonsie One', cursive;font-size: 18pt;text-align: center">
        Last step:
<?php
if ($info['auto_install'] == true) {
    echo '<br/><br/>' . $_SESSION['cms'] . " has been auto installed";
} else {
    ?>
        </span>    

        <span  style="font-family: 'Sonsie One', cursive;font-size: 18pt;text-align: center">

    <?php
    if ($info['integ_url'] != '') {
        echo "Download and install the following module</span>";
        echo '<br/><br/><a href="' . $info["integ_url"] . '" class="acceptbutton" target="_blank">Download</a>';
        ?>


                <span  style="font-family: 'Sonsie One', cursive;font-size: 25pt;text-align: right">
                    <br/><br/> OR
                </span>
                <br/>
        <?php
    }
    ?>             
            <br/>


            <br/>
            <span id ="manual">
                <a style="text-align:center"class="nextbutton" href="javascript:void(0)"onmousedown="maximize()">Manual installation</a>
                <span id ="content_manual">
                    <span  style="font-family: 'Sonsie One', cursive;font-size: 8pt;text-align: center">
    <?php
    echo $info['addn_info'];
    ?>
                        <br/><br/>
                        Add the following lines in your <br/>
                        <?php
                        echo $info['jsloc'];
                        echo $info['js_where'];
                        ?>
                    </span>

                    <textarea style="font-size:12pt"rows="8" cols="95" readonly="readonly"><?php echo $info['phpcode']; ?>
                        <?php echo $info['jscode']; ?>
    <?php echo $info['csscode']; ?>
                    </textarea>

                    <br/><br/>

                </span>
            </span>

    </div>  

<?php } ?><br/><br/><div align='center'>
    <a class="adminbutton" href='../server/params.php' target="_blank">Administer</a>
</div><br/><br/>
<?php
require("footer.php");
//session_destroy();
?>
