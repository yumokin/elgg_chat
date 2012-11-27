<?php

require 'base.php';

class JSocial extends driver_base {

    public function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }

//------------------------------------------------------------------------------
    public function getDBdata($session_id, $first) {
        if ($_SESSION[$this->uid . 'time'] < $this->online_time || isset($_SESSION[$this->uid . 'usr_name']) == false || $first == 'false') {   //To consume less resources , now the query is made only once in 15 seconds
            //  var_dump($this);
            $query = "SELECT DISTINCT u." . $this->displayname . ",j.userid,j.guest
                                    FROM " . DBprefix . "session AS j
                                    LEFT JOIN " . DBprefix . "users AS u ON j.userid=u.id
                                    WHERE j.session_id='" . $session_id . "'
                                    AND j.client_id=0  LIMIT 1";


            $res_obj = $this->db->query($query);

            $res = $res_obj->fetchAll();

            if ($res == null) {
                $this->freichat_debug("Incorrect Query, check parameters");
            }

            foreach ($res as $result) {
                if (isset($result['guest'])) { //To avoid undefined index error. Because empty results were shown sometimes
                    $_SESSION[$this->uid . 'is_guest'] = $result['guest'];
                    if ($result['guest'] == 0) { //To check if the result from query is a guest or not
                        $_SESSION[$this->uid . 'usr_name'] = $result[$this->displayname];
                        $_SESSION[$this->uid . 'usr_ses_id'] = $result['userid'];
                    } else if ($result['guest'] == 1) { //When user loggs out his session has to be updated back to old session(the session made before he logged in)
                        $_SESSION[$this->uid . 'usr_name'] = $_SESSION[$this->uid . 'gst_nam'];
                        $_SESSION[$this->uid . 'usr_ses_id'] = $_SESSION[$this->uid . 'gst_ses_id'];
                    } else {
                        $this->freichat_debug('you are neither a guest nor a user , are you a alien?');
                    }
                }
            }
        }
    }

//------------------------------------------------------------------------------
    public function avatar_url($avatar) {
        return $avatar;
    }
//------------------------------------------------------------------------------
    public function linkprofile_url($params) {
        return "<span id = 'freichat_profile_link_".$params['id']."'  class='freichat_linkprofile_s'><a href='".$params['path']."index.php?option=com_community&view=profile&userid=".$params['id']."'> <img title = '".$this->frei_trans['profilelink']."' class ='freichat_linkprofile' src='" . $params['img'] . "' alt='view' /></a></span>";
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
    public function get_guests() {

        $query = "SELECT DISTINCT u.avatar,f.status_mesg,f.username,f.session_id,f.status,f.guest,u.alias AS profile_iden
                               FROM frei_session AS f
                               LEFT JOIN " . DBprefix . "community_users AS u ON f.session_id=u.userid
                              WHERE time>" . $this->online_time2 . "
                               AND f.session_id!=" . $_SESSION[$this->uid . 'usr_ses_id'] . "
                               AND f.status!=2
                               AND f.status!=0";
//echo $query;

        $list = $this->db->query($query)->fetchAll();
        return $list;
    }

//------------------------------------------------------------------------------ 
    public function get_users() {

        $query = "SELECT DISTINCT u.avatar,f.status_mesg,f.username,f.session_id,f.status,f.guest
                               FROM frei_session AS f
                               LEFT JOIN " . DBprefix . "community_users AS u ON f.session_id=u.userid
                              WHERE time>" . $this->online_time2 . "
                               AND f.session_id!=" . $_SESSION[$this->uid . 'usr_ses_id'] . "
                               AND f.guest=0
                               AND f.status!=2
                               AND f.status!=0";

        $list = $this->db->query($query)->fetchAll();

        return $list;
    }

    //------------------------------------------------------------------------------
    public function get_buddies() {

        $query = "SELECT DISTINCT f.status_mesg,f.status_mesg,u.avatar,f.username,f.session_id,f.status,f.guest
            FROM frei_session as f
            LEFT JOIN " . DBprefix . "community_users AS u ON f.session_id=u.userid
            LEFT JOIN " . DBprefix . "community_connection AS c ON f.session_id=c.connect_to
            WHERE f.time>" . $this->online_time2 . "
            AND f.guest=0
            AND f.status!=2
            AND f.status!=0

            AND c.connect_from=" . $_SESSION[$this->uid . 'usr_ses_id'] . "
            AND f.session_id!=c.connect_from
            AND c.status=1";


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