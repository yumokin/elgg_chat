<?php
if (!isset($_SESSION['phplogin'])
        || $_SESSION['phplogin'] !== true) {
    header('Location: ../administrator/index.php'); //Replace that if login.php is somewhere else
    exit;
}

require "../arg.php";
/* * ***************************************************************************************** */

class param {

    public function __construct() {

        require("../arg.php");
        $this->argpath = "../arg.php";
        $this->configpath = "../config.dat";
        $this->themepath = '../client/jquery/freichat_themes/';
        $this->langpath = '../lang/';
        $this->themeray = $this->langray = array();
        $this->driver = $driver;
    }

//--------------------------------------------------------------------------------------------

    public function create_file() {
        //$handle = fopen($this->configpath,'w');
//var_dump($_POST);
        $parameters = unserialize(file_get_contents($this->configpath));

        // $parameters["show_name"]=$_POST['show_name'];
        // $parameters["displayname"]=$_POST['displayname'];
        // $parameters["show_module"]="visible";
        // $parameters["chatspeed"]=$_POST['chatspeed'];
        // $parameters["fxval"]=$_POST['fxval'];
        // $parameters["draggable"]=$_POST['draggable'];
        // $parameters["conflict"]=$_POST['conflict'];
        // $parameters["msgSendSpeed"]=$_POST['msgSendSpeed'];
        // $parameters["show_avatar"]=$_POST['show_avatar'];
        // $parameters["debug"]=$_POST['debug'];
        // $parameters["freichat_theme"]=$_POST['freichat_theme'];
        // $parameters["lang"]=$_POST['lang'];
        // $parameters["load"]=$_POST['load'];
        // $parameters["time"]=$_POST['time'];
        // $parameters["JSdebug"]=$_POST['JSdebug'];
        // $parameters["busy_timeOut"]=$_POST['busy_timeOut'];
        // $parameters["offline_timeOut"]=$_POST['offline_timeOut'];
        $parameters["plugins"]["file_sender"]["show"] = 'true';
        $parameters["plugins"]["file_sender"]["file_size"] = $_POST['max_file_size'];
        $parameters["plugins"]["file_sender"]["expiry"] = $_POST['max_file_expiry'];
        $parameters["plugins"]["file_sender"]["valid_exts"] = $_POST['valid_exts'];
        //$parameters["plugins"]["translator"]["show"]='true';

        file_put_contents($this->configpath, serialize($parameters));
        /*
          $contents ='<?php

          $parameters = array(

          "show_name"         => "'.$_POST['show_name'].'",
          "displayname"       => "'.$_POST['displayname'].'",
          "show_module"       => "visible",
          "chatspeed"         => "'.$_POST['chatspeed'].'",
          "fxval"             => "'.$_POST['fxval'].'",
          "draggable"         => "'.$_POST['draggable'].'",
          "conflict"          => "'.$_POST['conflict'].'",
          "msgSendSpeed"     => "'.$_POST['msgSendSpeed'].'",
          "show_avatar"       => "'.$_POST['show_avatar'].'",
          "debug"             => '.$_POST['debug'].',
          "freichat_theme"    => "'.$_POST['freichat_theme'].'",
          "lang"              => "'.$_POST['lang'].'",
          "load"              => "'.$_POST['load'].'",
          "time"              => "'.$_POST['time'].'",
          "JSdebug"           => '.$_POST['JSdebug'].',
          "busy_timeOut"      => '.(int)$_POST['busy_timeOut'].',
          "offline_timeOut"   => '.(int)$_POST['offline_timeOut'].',
          "plugins"           => array(
          "file_sender"    => array(
          "show"          => "true",
          "file_size"     => '.(int)$_POST['max_file_size'].',
          "expiry"        => '.(int)$_POST['max_file_expiry'].',
          "valid_exts"     => "'.$_POST['valid_exts'].'"
          ),
          "translator"    => array(
          "show"         => "enabled"
          )
          )

          );

          ?>'; */
        //fwrite($handle,$contents);
        //fclose($handle);
    }

//--------------------------------------------------------------------------------------------
    public function default_param($name, $given_value) {
        //require $this->configpath;
        $parameters = unserialize(file_get_contents($this->configpath));

        if ($parameters[$name] == $given_value) {
            echo "selected";
        } else {
            // echo 'selected';
        }
    }

    public function default_value($name, $dim=1) {
        //require $this->configpath;
        $parameters = unserialize(file_get_contents($this->configpath));

        if ($dim == 1) {
            return $parameters[$name];
        } else if ($dim == 2) {
            return $parameters[$name[0]][$name[1]];
        } else if ($dim == 3) {
            return $parameters[$name[0]][$name[1]][$name[2]];
        } else {
            echo "Out of bounds!";
        }
    }

//--------------------------------------------------------------------------------------------
}

/* * ***************************************************************************************** */
//require_once 'admin_files/paramclass.php';

$param = new param();
if (isset($_POST['max_file_size']) == true) {
    $param->create_file();
}
?>





<form name="params" action='admin.php?freiload=_file_send' method="POST">
 
    <br/><br/>
    <div class="parameters">

        <div id="tabs">
            <ul>
                <li><a href="#client">File sending Plugin parameters</a></li>

            </ul>
            <!-- First TAB -->
            <div id="client">




                <ol>
                    <li>
                        <p>Maximum file size for uploading </p>
                        <input name="max_file_size" value="<?php echo $param->default_value(array("plugins", "file_sender", "file_size"), 3); ?>" type="text"> KiloBytes
                        <br/><br/><hr/>
                    </li>

                    <li>
                        <p>Uploaded files will be deleted after</p>
                        <input name="max_file_expiry" value="<?php echo $param->default_value(array("plugins", "file_sender", "expiry"), 3); ?>" type="text"> minutes
                        <br/><br/><hr/>
                    </li>

                    <li>
                        <p>Valid file extensions for uploading</p>
                        <input size="60px" name="valid_exts" value="<?php echo $param->default_value(array("plugins", "file_sender", "valid_exts"), 3); ?>" type="text">
                        <br/><br/><hr/>
                    </li>

                </ol>


            </div>


        </div>

    </div>


    <br/>

    <input id="paramsubmit2" type="submit" value="SUBMIT">
</form>