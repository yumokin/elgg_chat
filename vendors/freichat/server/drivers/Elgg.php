<?php

require 'base.php';

class Elgg extends driver_base {

    public function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }

//------------------------------------------------------------------------------
    public function getDBdata($session_id, $first) {
        if ($session_id == 0) {
            $_SESSION[$this->uid . 'is_guest'] = 1;
        } else {
            $_SESSION[$this->uid . 'is_guest'] = 0;
        }
        if ($_SESSION[$this->uid . 'is_guest'] == 0) {
            if ($_SESSION[$this->uid . 'time'] < $this->online_time || isset($_SESSION[$this->uid . 'usr_name']) == false || $first == 'false') { //To consume less resources , now the query is made only once in 15 seconds
                $query = "SELECT username FROM " . DBprefix . "users_entity WHERE guid='" . $session_id . "'  LIMIT 1";
                $res_obj = $this->db->query($query);
                $res = $res_obj->fetchAll();

                if ($res == null) {
                    $this->freichat_debug("Incorrect Query :  " . $query . ", check parameters");
                }
                foreach ($res as $result) {
                    if (isset($result['username'])) { //To avoid undefined index error. Because empty results were shown sometimes
                        $_SESSION[$this->uid . 'usr_name'] = $result['username'];
                        $_SESSION[$this->uid . 'usr_ses_id'] = $session_id;
                    }
                }
            }
        } else {
            $_SESSION[$this->uid . 'usr_name'] = $_SESSION[$this->uid . 'gst_nam'];
            $_SESSION[$this->uid . 'usr_ses_id'] = $_SESSION[$this->uid . 'gst_ses_id'];
        }
    }

//------------------------------------------------------------------------------   
    public function get_buddies() {

        $query = "SELECT DISTINCT f.status_mesg,f.username,f.session_id,f.status,f.guest,e.guid_two
                   FROM " . DBprefix . "entity_relationships AS e 				   
                   LEFT JOIN frei_session as f ON e.guid_two = f.session_id 
                   WHERE
                       e.guid_one = " . $_SESSION[$this->uid . 'usr_ses_id'] . "
                   AND e.relationship = 'friend'      
				    	
                   AND f.time>" . $this->online_time2 . "
                   AND f.session_id!=" . $_SESSION[$this->uid . 'usr_ses_id'] . "
                   AND f.guest=0
                   AND f.status!=2
                   AND f.status!=0
                 ";

        $list = $this->db->query($query)->fetchAll();
        return $list;
    }
//------------------------------------------------------------------------------
    public function getList() {

        $user_list = null;

        if ($this->show_name == 'guest') {
            $user_list = $this->get_guests();
        } else if ($this->show_name == 'user') {
            $user_list = $this->get_users();
        } else if ($this->show_name == 'buddy') {
            $user_list = $this->get_buddies();
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