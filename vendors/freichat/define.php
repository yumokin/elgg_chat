<?php
date_default_timezone_set('America/Los_Angeles');

$Xmain = new freichatXconstruct();
require_once '../client/jquery/freichat_themes/' . $Xmain->freichat_theme . '/argument.php';

class freichatXconstruct {

    public function __construct() {
        //FREICHATX ARGUMENTS

        require 'arg.php';

        $this->url = $url;
        $this->show_name = $show_name; //you can have guest or user
        $this->show_avatar = $show_avatar;
        $this->displayname = $displayname;

        $this->debug = $debug; //option for debugging ,default is false
        $this->freichat_theme = $freichat_theme;
        $this->css = $this->freichat_theme; //background color
        $this->color = $this->css; //colour for chatbuttons
        $this->lang = $lang; //Language please do not include .php here only file name
        //$this->time = $time;

        //CHATROOM

        $this->show_chatroom_plugin = $show_chatroom_plugin;

        //long polling
        $this->long_polling = $long_polling;
        $this->poll_time = $poll_time;
        $this->chatspeed = $chatspeed;
        
        //link profile
        $this->linkprofile = $linkprofile;
        //DEFINES CUSTOM DRIVER
        $this->usertable = $usertable;
        $this->row_username = $row_username;
        $this->row_userid = $row_userid;
        $this->avatar_field_name = $avatar_field_name;

        //DEFINES DB
        $this->con = $con;
        $this->username = $username;
        $this->password = $password;
        $this->client_db_name = $client_db_name;
        $this->host = $host;
        $this->driver = $driver;
        $this->db_prefix = $db_prefix;
        $this->uid = $uid;
        $this->to_freichat_path = $PATH;

        // ALL DEFINITIONS
        global $onlineimg, $busyimg;

        $this->frei_trans = $this->inc_lang();
        $this->time_string = strtotime(date("Y-m-d H:i:s"));
        $this->onlineimg = $onlineimg;
        $this->busyimg = $busyimg;
        $this->online_time = ($this->time_string - 10);
        $this->online_time2 = ($this->time_string - 80);
        $this->permanent_id = time() + rand(100000, 500000);
        $this->permanent_name = $this->frei_trans['g_prefix'] . base_convert($this->permanent_id, 6, 36);

        if (!isset($_SESSION)) {
            $this->frm_id = $_SESSION[$this->uid . 'usr_ses_id'];
            $this->frm_name = $_SESSION[$this->uid . 'usr_name'];
        }
    }

//------------------------------------------------------------------------------------------------
    public function connectDB() {
        try {
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->client_db_name, $this->username, $this->password, array(
                        PDO::ATTR_PERSISTENT => true
                    ));
        } catch (PDOException $e) {
            $this->freichat_debug("unable to connect to database. Error : " . $e->getMessage());
            die();
        }

        $this->freichat_debug("connected to database successfully");
        $this->db->exec("SET CHARACTER SET utf8");
		$this->db->exec("SET NAMES utf8");
        return $this->db;
    }

//------------------------------------------------------------------------------------------------
    public function freichat_debug($message) {
        if ($this->debug == true) {
            $dbgfile = fopen("../freixlog.log", "a");
            fwrite($dbgfile, "\n" . date("F j, Y, g:i a") . ": " . $message . "\n");
        }
    }

//----------------------------------------------------------------------------------------------
    public function bigintval($value) {
        $value = trim($value);
        if (ctype_digit($value)) {
            return $value;
        }
        $value = preg_replace("/[^0-9](.*)$/", '', $value);
        if (ctype_digit($value)) {
            return $value;
        }
        return 0;
    }

//----------------------------------------------------------------------------------------------

    public function inc_lang() {
        if ($this->lang != 'english') {
            if (empty($frei_trans)) {
                $EnglishLangInc = require 'lang/english.php';
                if ($EnglishLangInc != 1) {
                    $this->freichat_debug('Enlish language file could not be included');
                }
            } else {
                $this->freichat_debug('frei_trans array already in use!');
            }

            $OtherLangInc = require 'lang/' . $this->lang . '.php';

            if ($OtherLangInc != 1) {
                $this->freichat_debug('Some error while including' . $this->lang . ' language file');
            }
        } else if ($this->lang == 'english') {
            $EnglishLangInc = require 'lang/english.php';

            if ($EnglishLangInc != 1) {
                $this->freichat_debug('path to english language incorrect');
            }
        } else {
            $this->freichat_debug('Wrong filename given in parameter');
        }
        return $frei_trans;
    }

}

?>
