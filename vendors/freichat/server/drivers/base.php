<?php

class driver_base {

    public $db;                 //PDO connection
    public $uid;                //SESSION uniq id
    public $permanent_name;     //Unique guest name
    public $permanent_id;       //Unique id
    public $online_time;        //current_time - 10
    public $online_time2;       //current_time - 80
    public $time_string;        //current_time
    public $show_name;          //registered or guest or buddy option
    public $usr_list_wanted;    //User list wanted or not
    public $db_prefix;          //Table prefix
    public $displayname;        //username  or nickname option
    public $frei_trans;         //Language Translation
    public $debug;              //Debug enabled or disabled
    public $update_usr_info;     //Whether user info has to be updated for this request
    public $url;                //URL to freichat/server/freichat.php
    public $options;            //All the options passed by freichat.php
    public $driver;             //current driver name
    public $to_freichat_path;   //Path to freichat folder inside CMS dir
    public $long_polling;       //long polling method 
    // Custom driver variables 
    public $usertable;
    public $row_username;
    public $row_userid;

    public function __construct() {
        
    }

    public function createFreiChatXsession() {
        //Create a Premanent Session as a reference to recognize when user loggs in or out [I dont know why i am doing this recognizing thing but when i was solving issues regarding sessions and updating tables it automatically got developed]
        if (!isset($_SESSION[$this->uid . 'gst_nam'])) { //To check if guest name is previously created to avoid multiple guest names for a single user
            $_SESSION[$this->uid . 'gst_nam'] = $this->permanent_name;
            $_SESSION[$this->uid . 'gst_ses_id'] = $this->permanent_id;
            $_SESSION[$this->uid . 'time'] = time();
        }
    }

    //------------------------------------------------------------------------------
    public function createFreiChatXdb() {
        if (!isset($_SESSION[$this->uid . 'isset_freichatx']) || $_SESSION[$this->uid . 'time'] < $this->time_string - 100) { //To check if session is created or not
            $query = "INSERT INTO frei_session (username,session_id,time,permanent_id,status,status_mesg,guest)
                      VALUES (" . $this->db->quote($_SESSION[$this->uid . 'usr_name']) . "," . $_SESSION[$this->uid . 'usr_ses_id'] . "," . $this->time_string . "," . $_SESSION[$this->uid . 'gst_ses_id'] . ",1,'" . $this->frei_trans['default_status'] . "'," . $_SESSION[$this->uid . 'is_guest'] . ")";
            $this->db->query($query);

            $this->freichat_debug('Inserted the user with the following data :: Username = ' . $_SESSION[$this->uid . 'usr_name'] . ' And ID = ' . $_SESSION[$this->uid . 'usr_ses_id'] . ' Default status  = ' . $this->frei_trans['default_status']);
            $_SESSION[$this->uid . 'time'] = time();
            $_SESSION[$this->uid . 'isset_freichatx'] = 0;
        }
    }

//------------------------------------------------------------------------------
    public function updateFreiChatXdb($first, $custom_mesg) {
        if ($_SESSION[$this->uid . 'time'] < $this->online_time || isset($_SESSION[$this->uid . 'usr_name']) == false || $first == 'false' || $this->update_usr_info === true) { //To update old session as well as table
            $query = "UPDATE frei_session
                       SET username=" . $this->db->quote($_SESSION[$this->uid . 'usr_name']) . ",
                       session_id=" . $_SESSION[$this->uid . 'usr_ses_id'] . ",
                       time=" . $this->time_string . ",
                       status_mesg='" . $_SESSION[$this->uid . 'custom_mesg'] . "',
                       guest=" . $_SESSION[$this->uid . 'is_guest'] . ",
                       in_room=" . $_SESSION[$this->uid . 'in_room'] . "
                        WHERE permanent_id=" . $_SESSION[$this->uid . 'gst_ses_id'];

            $this->db->query($query);

            $_SESSION[$this->uid . 'time'] = time();
        } else {
            $_SESSION[$this->uid . 'isset_freichatx'] = $_SESSION[$this->uid . 'isset_freichatx'] + 5;
        }
    }

//------------------------------------------------------------------------------
    public function deleteFreiChatXdb() {
        if ($_SESSION[$this->uid . 'isset_freichatx'] > 30 || ($this->long_polling == true && $this->options['first'] != 'false')) {
            $offline_time = $this->time_string - 300;
            $query = "DELETE FROM frei_session WHERE time<" . $offline_time;
            $this->db->query($query);
            $_SESSION[$this->uid . 'isset_freichatx'] = 0;
        }
    }

//------------------------------------------------------------------------------   
    public function avatar_url($avatar) {
        $murl = str_replace("server/freichat.php", "", $this->url);
        $avatar_url = $murl . 'client/jquery/user.jpeg';
        return $avatar_url;
    }

//------------------------------------------------------------------------------   
    public function get_guests() {

        $query = "SELECT DISTINCT status_mesg,username,session_id,status,guest
                   FROM frei_session
                  WHERE time>" . $this->online_time2 . "
                   AND session_id!=" . $_SESSION[$this->uid . 'usr_ses_id'] . "
                   AND status!=2
                   AND status!=0";
//echo $query;

        $list = $this->db->query($query)->fetchAll();
        return $list;
    }

//------------------------------------------------------------------------------ 
    public function get_users() {

        $query = "SELECT DISTINCT status_mesg,username,session_id,status,guest
                   FROM frei_session
                  WHERE time>" . $this->online_time2 . "
                   AND session_id!=" . $_SESSION[$this->uid . 'usr_ses_id'] . "
                   AND guest=0
                   AND status!=2
                   AND status!=0";

        $list = $this->db->query($query)->fetchAll();

        return $list;
    }

//------------------------------------------------------------------------------ 
    public function freichat_debug($message) {
        if ($this->debug == true) {
            $dbgfile = fopen("../freixlog.log", "a");
            fwrite($dbgfile, "\n" . date("F j, Y, g:i a") . ": " . $message . "\n");
        }
    }

}

?>