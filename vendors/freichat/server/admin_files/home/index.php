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
public function return_checked_value($index){
    
    if(isset($_POST[$index])) 
{
    return 'allow';
}
else
{
    return 'noallow';
}

    
    
}
    
    //------------------------------------------------------------------
    public function create_file() {
        //$handle = fopen($this->configpath,'w');
//var_dump($_POST);
        $parameters = unserialize(file_get_contents($this->configpath));

        $parameters["show_name"] = $_POST['show_name'];

        if ($this->driver == "JCB" || $this->driver == "CBE" || $this->driver == "JSocial" || $this->driver == "Joomla") {
            $parameters["displayname"] = $_POST['displayname'];
        }
        $parameters["show_module"] = "visible";
        $parameters["chatspeed"] = $_POST['chatspeed'];
        $parameters["fxval"] = $_POST['fxval'];
        $parameters["draggable"] = $_POST['draggable'];
        $parameters["conflict"] = $_POST['conflict'];
        $parameters["msgSendSpeed"] = $_POST['msgSendSpeed'];
        $parameters["show_avatar"] = $_POST['show_avatar'];
        $parameters["debug"] = $_POST['debug'];
        $parameters["freichat_theme"] = $_POST['freichat_theme'];
        $parameters["lang"] = $_POST['lang'];
        $parameters["load"] = $_POST['load'];
        //$parameters["time"] = $_POST['ti 
       $parameters["JSdebug"] = $_POST['JSdebug'];
        $parameters["playsound"] = $_POST['playsound'];
        $parameters["busy_timeOut"] = $_POST['busy_timeOut'];
        $parameters["offline_timeOut"] = $_POST['offline_timeOut'];
        $parameters["GZIP_handler"] = $_POST['GZIP_handler'];
        $parameters['polling'] = $_POST['polling'];
        $parameters['polling_time'] = $_POST['polling_time'];
        $parameters['link_profile'] = $_POST['link_profile'];
        
        $parameters['chatroom']['user'] =$this->return_checked_value('p_chatroom_user');
        $parameters['chatroom']['guest'] = $this->return_checked_value('p_chatroom_guest');
        $parameters['filesend']['user'] = $this->return_checked_value('p_filesend_user');
        $parameters['filesend']['guest'] = $this->return_checked_value('p_filesend_guest');
        $parameters['mail']['user'] = $this->return_checked_value('p_mail_user');
        $parameters['mail']['guest'] = $this->return_checked_value('p_mail_guest');
        $parameters['save']['user'] = $this->return_checked_value('p_save_user');
        $parameters['save']['guest'] = $this->return_checked_value('p_save_guest');
        $parameters['smiley']['user'] = $this->return_checked_value('p_smiley_user');
        $parameters['smiley']['guest'] = $this->return_checked_value('p_smiley_guest');
        
        file_put_contents($this->configpath, serialize($parameters));
        /**/
    }

//--------------------------------------------------------------------------------------------
    public function default_param($name, $given_value,$checked=false) {
        //require $this->configpath;
        $parameters = unserialize(file_get_contents($this->configpath));
        
        if(is_array($name)) {
            $passed_value = $parameters[$name[0]][$name[1]];
        }else{
            $passed_value = $parameters[$name];
        }
        
//echo $parameters ." == ". $given_value."<br/>";
        if ($passed_value == $given_value) {
            
            if($checked==true){
                echo ' checked="checked" ';
            }
            else{
            echo ' selected="selected" ';
            }
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
    
    public function purge_mesg_history($days) {
         $time = $days * 24 * 60 * 60;
         $delete_mesg_query = "DELETE FROM frei_chat  WHERE recd =1 AND sent < NOW()-" . $time;
         global $db;
         $db->query($delete_mesg_query);
    }

//--------------------------------------------------------------------------------------------
}

/* * ***************************************************************************************** */
//require_once 'admin_files/paramclass.php';

$param = new param();
if (isset($_POST['draggable']) == true) {
    $param->create_file();
}

if(isset($_REQUEST['purge'])) {
    $param->purge_mesg_history($_GET['days']);
    die('Messages Purged successfully.');
}

?>

<script type="text/javascript">
    function purge_mesg_history(){
        
        var days = $('#purge_mesg_period').val();
        $.get('admin.php?freiload=home&purge=true',{days:days},function(resp){
            alert('Messages Purged successfully.');
        });
    }
    
</script>



<form name="params" action='<?php $_SERVER['PHP_SELF']; ?>' method="POST">

    <br/><br/>
    <div class="parameters">

        <div id="tabs">
            <ul>
                <li><a href="#general">General</a></li>
                <li><a href="#polling">Polling</a></li>
                <li><a href="#client">Client side</a></li>
                <li><a href="#server">Server side</a></li>
                <!--<li><a href="#added">Plugins parameters</a></li>-->
                <li><a href="#account">Additional</a></li>
            </ul>
            
            
            <!-- -1 tab --->
            
            <div id="polling">
                
                
                    
                        
                        <p>Polling Type</p><br/>
                        <select name="polling">
                            <option value="disabled"<?php $param->default_param("polling", "disabled"); ?>>Short Polling</option>
                            <option value="enabled"<?php $param->default_param("polling", "enabled"); ?>>Comet</option>
                        </select>
                        <br/><br/><hr/>
                        <br/>
                        Polling Time:(only for comet)<br/><br/>
                       
                        <input type="text" name="polling_time" value="<?php echo $param->default_value('polling_time'); ?>"/> seconds
                        
                        <br/><br/>
                       <hr/>
                        <p>
                        <h3>What is Comet?</h3>
Comet is a web application model in which a long-held HTTP request allows a web server to push data to a browser, without the browser explicitly requesting it. Comet is an umbrella term, encompassing multiple techniques for achieving this interaction. All these methods rely on features included by default in browsers, such as JavaScript, rather than on non-default plugins. The Comet approach differs from the original model of the web, in which a browser requests a complete web page at a time.
The use of Comet techniques in web development predates the use of the word Comet as a neologism for the collective techniques. Comet is known by several other names, including Ajax Push, Reverse Ajax,Two-way-web, HTTP Streaming, and HTTP server push among others
                            
<br/>
<br/>
Pros: you are notified when the server event happens with no delay.<br/> 
Cons: more complex and more server resources used as the connection is kept alive. 
                        </p>
                        <hr/>
                        <p>
                        <h3>What is Short Polling?</h3>
                            This is technically not in the same league, but attempts to recreate close to real-time connectivity with the server. In this model, the server is short-polled on a frequent basis (1-7 seconds as specified in the chatspeed settings).<br/>
As one can imagine, this method is very resource intensive and bandwidth hungry. Even if polling the server returns no data, just the TCP/HTTP overhead will consume a lot of bandwidth.                            
                            
                            <br/>
                            <br/>
                            Pros: simpler, not server consuming(only if the time between requests is <b>long</b>).<br/>
Cons: bad if you need to be notified when the server event happens with no delay.
<br/>

                        </p>
                    

                
                
                
            </div>
            
            
            
            
            
            
            
            <!-- zero tab -->
            
            <div id="general">
                
                
                <style type="text/css">
                    
                    .tablex {
border-top-width: 3px;
border-right-width: 3px;
border-bottom-width: 3px;
border-left-width: 3px;
border-top-left-radius: 16px 16px;
border-top-right-radius: 16px 16px;
border-bottom-right-radius: 16px 16px;
border-bottom-left-radius: 16px 16px;
padding-top: 8px;
padding-right: 8px;
padding-bottom: 8px;
padding-left: 8px;
margin-top: 0px;
margin-right: 8px;
margin-bottom: 8px;
margin-left: 8px;

height: auto;
border: solid white;
}

td {
    padding:5px;
border-top: solid 1px #EFEFEF;
text-align:center;
}

.classleft{
    text-align:left;
}

th {
    width:300px;
background-color: #08F;
padding:5px;
color:white;
background-color: rgba(0, 136, 255, 1);
}
                    </style>
                
                <table class="tablex">
                    <tr>
                    <th>Plugin</th>
                    <th>Guest Access</th>
                    
                    <th>User Access</th>
                    </tr>
                    
                    <tr>
                        <td class="classleft">Chatroom</td>
                        <td><input type="checkbox"  name="p_chatroom_guest" <?php $param->default_param(array("chatroom","guest"), "allow",true); ?> value="checked" /></td>
                        <td><input type="checkbox" name="p_chatroom_user" <?php $param->default_param(array("chatroom","user"), "allow",true); ?> value="checked" /></td>
                            
                    </tr>
                    <tr>
                        <td class="classleft">Send File</td>
                        <td><input type="checkbox" name="p_filesend_guest" value="checked" <?php $param->default_param(array("filesend","guest"), "allow",true); ?> /></td>
                        <td><input type="checkbox" name="p_filesend_user" value="checked" <?php $param->default_param(array("filesend","user"), "allow",true); ?> /></td>
                            
                    </tr>
                                        <tr>
                        <td class="classleft">Email Conversation</td>
                        <td><input type="checkbox" name="p_mail_guest" value="checked" <?php $param->default_param(array("mail","guest"), "allow",true); ?> /></td>
                        <td><input type="checkbox" name="p_mail_user" value="checked" <?php $param->default_param(array("mail","user"), "allow",true); ?> /></td>
                            
                    </tr>                   <tr>
                        <td class="classleft">Save Conversation</td>
                        <td><input type="checkbox" name="p_save_guest" value="checked" <?php $param->default_param(array("save","guest"), "allow",true); ?> /></td>
                        <td><input type="checkbox" name="p_save_user" value="checked" <?php $param->default_param(array("save","user"), "allow",true); ?> /></td>
                            
                    </tr>                    <tr>
                        <td class="classleft">Smiley</td>
                        <td><input type="checkbox" name="p_smiley_guest" value="checked" <?php $param->default_param(array("smiley","guest"), "allow",true); ?> /></td>
                        <td><input type="checkbox" name="p_smiley_user" value="checked" <?php $param->default_param(array("smiley","user"), "allow",true); ?> /></td>
                            
                    </tr>
                </table>
                
                
            </div>
            
            
            
            <!-- First TAB -->
            
            
            
            <div id="client">


                <ol id ="parametejrs" style="list-style-type: upper-roman;">
                    <li>
                        <p>Show Guests or Resgistered Users</p><br/>
                        <select name="show_name">
                            <option value="guest"<?php $param->default_param("show_name", "guest"); ?>>Guests</option>
                            <option value="user"<?php $param->default_param("show_name", "user"); ?>>Users</option>

                            <?php
                            if ($driver == "JCB" || $driver == "CBE" || $driver == "JSocial" || $driver == "Custom"  || $driver == "Elgg") {
                                echo '<option value=' . "buddy ";
                                $param->default_param("show_name", "buddy");
                                echo">Buddies</option>";
                            }
                            ?>

                        </select>
                        <br/><br/><hr/>
                    </li>
<?php
//echo $param->default_param("link_profile", "enabled");
                       if ($driver == "JCB" || $driver == "JSocial") {
                      echo '<li>
                        <p>Show link to profile</p><br/>
                        <select name="link_profile">
                            <option value="enabled" '; $param->default_param("link_profile", "enabled"); echo ' >Yes</option>
                            <option value="disabled" ';  $param->default_param("link_profile", "disabled"); echo '>No</option>
                            

                        </select>
                        <br/><br/><hr/>
                    </li>';
                    }
?>
                    
                    <li>
                        <p>Show Avatar</p><br/>
                        <select name="show_avatar">
                            <option value="block"<?php $param->default_param("show_avatar", "block"); ?>>Yes</option>
                            <option value="none"<?php $param->default_param("show_avatar", "none"); ?>>No</option>
                        </select>
                        <br/><br/><hr/>
                    </li>

                    <?php
                    if ($driver == "JCB" || $driver == "CBE" || $driver == "JSocial" || $driver == "Joomla") {
                        echo '<li><p>Show Username or Nickname(name)</p><br/><select name="displayname">';
                        echo '<option value=' . "username ";
                        $param->default_param("displayname", "username");
                        echo">username</option>";
                        echo '<option value=' . "name ";
                        $param->default_param("displayname", "name");
                        echo">nickname</option>";
                        echo '</select><br/><br/><hr/></li>';
                    }
                    ?>

                    <li>
                        <p>Select a theme for the chat</p><br/>
                        <select name="freichat_theme">
                            <?php
                            if ($handle = opendir('../client/jquery/freichat_themes/')) {
                                while (false !== ($file = readdir($handle))) {
                                    if ($file != "." && $file != ".." && $file != '.svn' && is_dir('../client/jquery/freichat_themes/' . $file)) {


                                        echo '<option value=' . "$file ";
                                        $param->default_param("freichat_theme", $file);
                                        echo">$file</option>";
                                    }
                                }
                                closedir($handle);
                            } else {
                                echo 'directory open failed';
                            }
                            ?>
                        </select>
                        <br/><br/><hr/>
                    </li>


                    <li>
                        <p>Draggable chatwindows feature should be </p>
                        <select name="draggable">
                            <option value="enable"<?php $param->default_param("draggable", "enable"); ?>>Enabled</option>
                            <option value="disable"<?php $param->default_param("draggable", "disable"); ?>>Disabled</option>
                        </select>
                        <br/><br/><hr/>
                    </li>

                    <li>
                        <p>ChatBox on load should be</p>
                        <select name="load">
                            <option value="show"<?php $param->default_param("load", "show"); ?>>Maximized</option>
                            <option value="hide"<?php $param->default_param("load", "hide"); ?>>Minimized</option>
                        </select><br/><br/><hr/>
                    </li>

                    <li>
                        <p>Remove Jquery Conflicts <span onmousedown="helpme1()"><img src="<?php echo '../client/jquery/img/about.jpeg' ?>" alt="About"/></a></span></p>
                        <select name="conflict">
                            <option value="true"<?php $param->default_param("conflict", "true"); ?>>Yes</option>
                            <option value=""<?php $param->default_param("conflict", ""); ?>>No</option>
                        </select><br/><br/><hr/>
                    </li>

                    <li>
                        <p>Show Jquery Animations</p><br/>
                        <select name="fxval">
                            <option value="true"<?php $param->default_param("fxval", "true"); ?>>Yes</option>
                            <option value="false"<?php $param->default_param("fxval", "false"); ?>>No</option>
                        </select>
                        <br/><br/><hr/>
                    </li>

                    <li>
                        <p>Play sound on new message </p><br/>
                        <select name="playsound">
                            <option value="true"<?php $param->default_param("playsound", "true"); ?>>Yes</option>
                            <option value="false"<?php $param->default_param("playsound", "false"); ?>>No</option>
                        </select>
                        <br/><br/>
                    </li>

                </ol>

            </div>

            <!-- Second TAB -->
            <div id="server">
                <ol  style="list-style-type: upper-roman;">
                    <li>
                        <p>purge/delete message history</p><br/>
                        No of days : <input type="text" id="purge_mesg_period" value="0"/><br/><br/>
                        Note: The above field specifies the no. of days prior to which all messages should be deleted.<br/>
                        0 days denotes all messages are to be deleted.<br/>
                        <br/>
                        <input type="button" value="purge messages" onclick="purge_mesg_history()" />
                        <br/><br/><hr/>
                    </li>
                    <li>
                        <p>Change Chat Speed to</p><br/>
                        <select name="chatspeed">
                            <option value="7000"<?php $param->default_param("chatspeed", "7000"); ?>>7 seconds</option>
                            <option value="5000"<?php $param->default_param("chatspeed", "5000"); ?>>5 seconds</option>
                            <option value="3000"<?php $param->default_param("chatspeed", "3000"); ?>>3 seconds</option>
                            <option value="1000"<?php $param->default_param("chatspeed", "1000"); ?>>1 second</option>
                        </select><br/><br/>
                        Note:<br/>
                        1. It is the time interval between 2 consecutive requests.<br/>
                        <br/><br/><hr/>
                    </li>

                    <li>
                        <p>Choose any Language</p><br/>
                        <select name="lang">
                            <?php
                            if ($handle = opendir('../lang/')) {
                                while (false !== ($file = readdir($handle))) {
                                    if ($file != "." && $file != ".." && $file != '.svn') {
                                        $file_name = str_replace(".php", "", $file);
                                        echo '<option value=' . "$file_name ";
                                        $param->default_param("lang", $file_name);
                                        echo">$file_name</option>";
                                    }
                                }
                                closedir($handle);
                            } else {
                                echo 'directory open failed';
                            }
                            ?>
                        </select>
                    </li>

                    <li><hr/>
                        <p>Time interval between messages</p><br/>
                        <select name="msgSendSpeed">
                            <option value="500"<?php $param->default_param("msgSendSpeed", "500"); ?>>0.5 second</option>
                            <option value="1000"<?php $param->default_param("msgSendSpeed", "1000"); ?>>1 seconds</option>
                            <option value="1500"<?php $param->default_param("msgSendSpeed", "1500"); ?>>1.5 seconds</option>
                            <option value="2000"<?php $param->default_param("msgSendSpeed", "2000"); ?>>2 seconds</option>
                        </select><br/><br/>
                        Note:<br/>
                        1. This is the time FreiChatX will wait between two requests (messages sent)<br/>
                        2. Increase the time interval if you want to reduce server resource usage<br/>
                        3. 1 second is the default time interval.Do not reduce it further if you <br/>dont
                        know what you are doing.<br/>
                        <br/><br/>
                    </li>
                    
                    
                    <li><hr/>
                        <p>Turn GZIP ob_handler </p><br/>
                        <select name="GZIP_handler">
                            <option value="ON"<?php $param->default_param("GZIP_handler", "ON"); ?>>ON</option>
                            <option value="OFF"<?php $param->default_param("GZIP_handler", "OFF"); ?>>OFF</option>
                        </select><br/><br/>
                        Note:<br/>
                        This handler compresses FreiChatX files for faster load <br/>                      
                        <br/><br/><hr/>
                    </li>

                </ol>
            </div>

            <!-- Third TAB -->



            <!-- Fourth TAB -->
            <div id ="account">
                <ol style="list-style-type: upper-roman;">
                    <!--<li>
                       Change FreiChatX administrator password<br/><br/>

                       A . Enter your old password<br/>
                       <input type="password" name="adminpassold1"/>
                       <br/>
                       B . Enter your old password again<br/>
                       <input type="password" name="adminpassold2"/>
                       <br/>
                       <br/>
                       C. Enter your new password <br/>
                       <input type ="password" name="adminpassnew"/>
                   </li>-->

                    <li>
                        Busy time out<br/><br/>
                        User status will be changed to busy after <br/>

                        <input name="busy_timeOut" value="<?php echo $param->default_value('busy_timeOut'); ?>" type="text"> seconds
                        <br/><br/><hr/>
                    </li>

                    <li>
                        Offline time out<br/><br/>
                        User status will be changed to offline after <br/>

                        <input name="offline_timeOut" value="<?php echo $param->default_value('offline_timeOut'); ?>" type="text"> seconds
                        <br/><br/><hr/>
                    </li>

                    <li>
                        <p>PHP debugging</p><br/>
                        <select name="debug">
                            <option value="true"<?php $param->default_param("debug", "true"); ?>>Yes</option>
                            <option value="false"<?php $param->default_param("debug", "false"); ?>>No</option>
                        </select>
                        <br/><br/><hr/>
                    </li>

                    <li>
                        <p>JavaScript debugging</p><br/>
                        <select name="JSdebug">
                            <option value="true"<?php $param->default_param("JSdebug", "true"); ?>>Yes</option>
                            <option value="false"<?php $param->default_param("JSdebug", "false"); ?>>No</option>
                        </select>
                        <br/><br/>
                    </li>

                </ol>
            </div>
        </div>

    </div>


    <br/>

    <input id="paramsubmit2" type="submit" value="SUBMIT">
</form>
