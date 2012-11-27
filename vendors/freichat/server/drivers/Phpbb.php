<?php

require 'base.php';

class Phpbb extends driver_base {

    public function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }

//------------------------------------------------------------------------------
    public function getDBdata($session_id, $first) {

        $query = "SELECT s.username,j.session_user_id
                      FROM " . DBprefix . "sessions as j
                      LEFT JOIN " . DBprefix . "users as s ON s.user_id=j.session_user_id
                      WHERE j.session_id='" . $session_id . "' LIMIT 1";

        $res_obj = $this->db->query($query);
        $res = $res_obj->fetchAll();

        if ($res == null) {
            $this->freichat_debug("Incorrect Query in driver CBE check parameters");
        }

        foreach ($res as $result) {
            if (isset($result['username'])) { //To avoid undefined index error. Because empty results were shown sometimes
                if ($result['session_user_id'] == 1) {
                    $_SESSION[$this->uid . 'is_guest'] = 1;
                } else {
                    $_SESSION[$this->uid . 'is_guest'] = 0;
                }
                if ($_SESSION[$this->uid . 'is_guest'] == 0) { //To check if the result from query is a guest or not
                    $_SESSION[$this->uid . 'usr_name'] = $result['username'];
                    $_SESSION[$this->uid . 'usr_ses_id'] = $result['session_user_id'];
                } else if ($_SESSION[$this->uid . 'is_guest'] == 1) { //When user loggs out his session has to be updated back to old session(the session made before he logged in)
                    $_SESSION[$this->uid . 'usr_name'] = $_SESSION[$this->uid . 'gst_nam'];
                    $_SESSION[$this->uid . 'usr_ses_id'] = $_SESSION[$this->uid . 'gst_ses_id'];
                } else {
                    $this->freichat_debug("Incorrect query wriiten for phpBB (51)");
                }
            }
        }
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