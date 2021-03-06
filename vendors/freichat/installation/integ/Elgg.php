<?php

require 'base.php';

class Elgg extends base {
        
    
public $set_file="engine/settings.php";    
public $redir=false; 

function info($path_host) {


    $url = str_replace("installation/integ", "", str_replace('\\', '/', dirname(__FILE__)));



    $this->info['jsloc'] = 'header.php in views/default/page_elements/';
    $this->info['phpcode'] = '<!--===========================FreiChatX=======START=========================-->
<!--	For uninstalling ME , first remove/comment all FreiChatX related code i.e below code
	 Then remove FreiChatX tables frei_session & frei_chat if necessary
         The best/recommended way is using the module for installation                         -->

<?php

if(isset($_SESSION["guid"])==true) {$ses=$_SESSION["guid"]; } else {$ses=0;}
if(!function_exists("freichatx_get_hash")){
function freichatx_get_hash($ses){

       if(is_file("' . $url . 'arg.php")){

               require "' . $url . 'arg.php";

               $temp_id =  $ses . $uid;

               return md5($temp_id);

       }
       else
       {
               echo "<script>alert(\'module freichatx says: arg.php file not
found!\');</script>";
       }

       return 0;
}
}
?>';
    $this->info['jscode'] = '<script type="text/javascript" language="javascipt"src="' . $path_host . 'client/main.php?id=<?php echo $ses;?>&xhash=<?php echo freichatx_get_hash($ses); ?>"></script>';
    $this->info['csscode'] = '
	<link rel="stylesheet" href="' . $path_host . 'client/jquery/freichat_themes/freichatcss.php" type="text/css">
<!--===========================FreiChatX=======END=========================-->';

    return $this->info;
}



function get_config() {

        require_once $_SESSION['config_path'];

        global $CONFIG;

        if (!isset($CONFIG)) {
            return false;
        }

        $conf[0] = $CONFIG->dbhost;
        $conf[1] = $CONFIG->dbuser;
        $conf[2] = $CONFIG->dbpass;
        $conf[3] = $CONFIG->dbname;
        $conf[4] = $CONFIG->dbprefix;

        return $conf;
  }


}
//Except for Elgg users: Add it in footer.php in views/default/page_elements/
