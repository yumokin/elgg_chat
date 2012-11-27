<?php

require 'base.php';

class Custom extends driver_base {

    public function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }

//------------------------------------------------------------------------------
    public function getDBdata($session_id, $first) {
       
            if ($session_id != null) {
                $userID = strip_tags($session_id);
                $_SESSION[$this->uid . 'is_guest'] = 0;
            } else {
                $_SESSION[$this->uid . 'is_guest'] = 1;
                $_SESSION[$this->uid . 'usr_name'] = $_SESSION[$this->uid . 'gst_nam'];
                $_SESSION[$this->uid . 'usr_ses_id'] = $_SESSION[$this->uid . 'gst_ses_id'];     
            }
           
            if (($_SESSION[$this->uid . 'time'] < $this->online_time || isset($_SESSION[$this->uid . 'usr_name']) == false || $first == 'false') && $_SESSION[$this->uid . 'is_guest'] == 0) { //To consume less resources , now the query is made only once in 15 seconds
          
                $query = "SELECT DISTINCT " . $this->row_username . "," . $this->row_userid . "
                      FROM " . DBprefix . $this->usertable . "
                      WHERE " . $this->row_userid . "='" . $userID . "'
                      LIMIT 1";

                $res_obj = $this->db->query($query);

                $res = $res_obj->fetchAll();

                if ($res == null) {
                    $this->freichat_debug("Incorrect Query :  " . $query . ", check parameters");
                    $_SESSION[$this->uid . 'is_guest'] = 1; 
                    $_SESSION[$this->uid . 'usr_name'] = $_SESSION[$this->uid . 'gst_nam'];
                    $_SESSION[$this->uid . 'usr_ses_id'] = $_SESSION[$this->uid . 'gst_ses_id'];     
                }

                foreach ($res as $result) {
                    if (isset($result[$this->row_username])) { //To avoid undefined index error. Because empty results were shown sometimes
                        $_SESSION[$this->uid . 'usr_name'] = $result[$this->row_username];
                        $_SESSION[$this->uid . 'usr_ses_id'] = $result[$this->row_userid];
                    }
                }
            }
         else {
            $this->freichat_debug("Wrong method defined!");
        }
    }

//------------------------------------------------------------------------------
    public function avatar_url($avatar) {
        $murl = str_replace("server/freichat.php", "", $this->url);
        $avatar_url = $murl . 'client/jquery/user.jpeg';
        return $avatar_url;
    }
//------------------------------------------------------------------------------
    public function getList() {

        $user_list = null;

        if ($this->show_name == 'guest') {
            $user_list = $this->get_guests();
        } else if ($this->show_name == 'user') {
            $user_list = $this->get_users();
        } else {
            $this->freichat_debug('USER parameters for show_name are wrong.');
        }
        return $user_list;
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
    public function get_buddies() {

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
    public function load_driver() {

        define("DBprefix", $this->db_prefix);
        $session_id = $this->options['id'];
        $custom_mesg = $this->options['custom_mesg'];
        $first = $this->options['first'];

// 1. Connect The DB
//      DONE
// 2. Basic Build the blocks        
        $this->createFreiChatXsession();
// 3. Get Required Data from client DB
        $this->getDBdata($session_id, $first);
// 4. Insert user data in FreiChatX Table Or Recreate Him if necessary
        $this->createFreiChatXdb();
// 5. Update user data in FreiChatX Table
        $this->updateFreiChatXdb($first, $custom_mesg);
// 6. Delete user data in FreiChatX Table
        $this->deleteFreiChatXdb();
// 7. Get Appropriate UserData from FreiChatX Table
        if ($this->usr_list_wanted == true) {
            $result = $this->getList();
            return $result;
        }
// 8. Send The final Data back
        return true;
    }

}