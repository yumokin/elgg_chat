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

        $parameters["plugins"]["send_conv"]["show"] = 'true';
        $parameters["plugins"]["send_conv"]["mailtype"] = $_POST['mailtype'];
        $parameters["plugins"]["send_conv"]["smtp_server"] = $_POST['smtp_server'];
        $parameters["plugins"]["send_conv"]["smtp_port"] = $_POST['smtp_port'];
        $parameters["plugins"]["send_conv"]["smtp_protocol"] = $_POST['smtp_protocol'];
        $parameters["plugins"]["send_conv"]["from_address"] = $_POST['from_address'];
        $parameters["plugins"]["send_conv"]["from_name"] = $_POST['from_name'];
        //$parameters["plugins"]["translator"]["show"]='true';

        file_put_contents($this->configpath, serialize($parameters));
    }

//--------------------------------------------------------------------------------------------
    public function default_param($name, $given_value, $plugin=null) {
        //require $this->configpath;
        $parameters = unserialize(file_get_contents($this->configpath));

        if ($plugin != null) {
            if ($parameters['plugins'][$plugin][$name] == $given_value) {
                echo "selected";
            }
        } else if ($parameters[$name] == $given_value) {
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
if (isset($_POST['mailtype']) == true) {
    $param->create_file();
}
?>





<form name="params" action='admin.php?freiload=_send_conv' method="POST">

    <br/><br/>
    <div class="parameters">

        <div id="tabs">
            <ul>
                <li><a href="#client">Send Conversation By Email Plugin</a></li>

            </ul>
            <!-- First TAB -->
            <div id="client">




                <ol>
                    <li>
                        <p>Mail() or SMTP</p>
                        <select name='mailtype'>
                            <option value='mail' <?php $param->default_param("mailtype", 'mail', 'send_conv'); ?>>mail()</option>
                            <option value='smtp'  <?php $param->default_param("mailtype", 'smtp', 'send_conv'); ?>>SMTP</option>

                        </select>
                        <br/><br/><hr/>
                    </li>
                </ol>
                <p><br/><br/><b>SMTP Related Settings(Required if you choose SMTP)</b></p>
                <ol>
                    <li>
                        <p>SMTP server</p>
                        <input name="smtp_server" value="<?php echo $param->default_value(array("plugins", "send_conv", "smtp_server"), 3); ?>" type="text">
                        <br/><br/><hr/>
                    </li>

                    <li>
                        <p>SMTP port</p>
                        <input size="60px" name="smtp_port" value="<?php echo $param->default_value(array("plugins", "send_conv", "smtp_port"), 3); ?>" type="text">
                        <br/><br/><hr/>
                    </li>
                    <li>
                        <p>Use encrypted protocol</p>
                        <select name='smtp_protocol'>
                            <option value='none' <?php $param->default_param("smtp_protocol", 'none', 'send_conv'); ?>>none</option>
                            <option value='ssl'  <?php $param->default_param("smtp_protocol", 'ssl', 'send_conv'); ?>>SSL</option>
                            <option value='tls'  <?php $param->default_param("smtp_protocol", 'tls', 'send_conv'); ?>>TLS</option>
                        </select>
                        <br/><br/><hr/>
                    </li>
                    <li>
                        <p style="font-weight:bold;color:green;">Username and password for SMTP must be defined in arg.php</p><br/><br/><hr/>
                    </li>

                    <li>
                        <p>E-mail from address</p>
                        <input size="60px" name="from_address" value="<?php echo $param->default_value(array("plugins", "send_conv", "from_address"), 3); ?>" type="text">
                        <br/><br/><hr/>
                    </li>
                    <li>
                        <p>E-mail from name</p>
                        <input size="60px" name="from_name" value="<?php echo $param->default_value(array("plugins", "send_conv", "from_name"), 3); ?>" type="text">
                        <br/><br/><hr/>
                    </li>


                </ol>


            </div>


        </div>

    </div>


    <br/>

    <input id="paramsubmit2" type="submit" value="SUBMIT">
</form>
