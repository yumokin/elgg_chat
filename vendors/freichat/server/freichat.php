<?php

session_start();
error_reporting(-1);

if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}


require '../arg.php';

if ($_REQUEST['freimode'] == 'post' || $_REQUEST['freimode'] == 'update_status') {
    $id = $_POST['id'];
    if (isset($_SESSION[$uid . "is_xc"]) && $_SESSION[$uid . "is_xc"] == true) {
        $_POST['xhash'] = md5($id . $uid);
    }
    $xhash = $_POST['xhash'];
} else {
    $id = $_GET['id'];
    if (isset($_SESSION[$uid . "is_xc"]) && $_SESSION[$uid . "is_xc"] == true) {
        $_GET['xhash'] = md5($id . $uid);
    }
    $xhash = $_GET['xhash'];
}



if (md5($id . $uid) != $xhash) {
    $_SESSION[$uid . 'usr_ses_id'] = 0;
    echo 'invalid install uid';
    $_GET['id'] = 0;
    $_GET['first'] = 'false';
    exit;
}

require("../define.php");

//*******************************//OOP ROCKS !//***********************************//
class freichat {
    
}

class freichatX extends freichatXconstruct {

    public $userdata;
    public $messages = array();
    public $chatroom_raw_mesgs = array();

    public function __construct() {
        parent::__construct();
        require_once RDIR . '/server/drivers/' . $this->driver . '.php';
        $this->url = str_replace('server/freichat.php', '', $this->url);
        $this->frm_id = $_SESSION[$this->uid . 'usr_ses_id'];
        $this->frm_name = $_SESSION[$this->uid . 'usr_name'];
        $this->connectDB();


        if ($this->debug == true) {

            error_reporting(-1);
        }
    }

//-------------------------------------------------------------------------
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

//-----------------------------------------------------------------------------
    function str_pad_html($strInput = "", $intPadLength, $strPadString = "&nbsp;", $intPadType = STR_PAD_RIGHT) {
        if (strlen(trim(strip_tags($strInput))) < intval($intPadLength)) {

            switch ($intPadType) {
                // STR_PAD_LEFT
                case 0:
                    $offsetLeft = intval($intPadLength - strlen(trim(strip_tags($strInput))));
                    $offsetRight = 0;
                    break;

                // STR_PAD_RIGHT
                case 1:
                    $offsetLeft = 0;
                    $offsetRight = intval($intPadLength - strlen(trim(strip_tags($strInput))));
                    break;

                // STR_PAD_BOTH
                case 2:
                    $offsetLeft = intval(($intPadLength - strlen(trim(strip_tags($strInput)))) / 2);
                    $offsetRight = round(($intPadLength - strlen(trim(strip_tags($strInput)))) / 2, 0);
                    break;

                // STR_PAD_RIGHT
                default:
                    $offsetLeft = 0;
                    $offsetRight = intval($intPadLength - strlen(trim(strip_tags($strInput))));
                    break;
            }

            $strPadded = str_repeat($strPadString, $offsetLeft) . $strInput . str_repeat($strPadString, $offsetRight);
            unset($strInput, $offsetLeft, $offsetRight);

            return $strPadded;
        } else {
            return $strInput;
        }
    }

//----------------------------------------------------------------------------
    public function makeClickableLinks($text) {
        $text = preg_replace('#(script|about|applet|activex|chrome):#is', "\\1:", $text);
        $ret = ' ' . $text;
        $ret = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);
        $ret = preg_replace("#(^|[\n ])((www|ftp)\.[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);
        $ret = preg_replace("#(^|[\n ])([a-z0-9&\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $ret);
        $ret = substr($ret, 1);
        return $ret;
    }

//----------------------------------------------------------------------------

    public function mywordwrap($string) {
        $wrap = null;
        $skip = NULL;
        $returnvar = NULL;
        $length = strlen($string);

        for ($i = 0; $i <= $length; $i = $i + 1) {

            $char = substr($string, $i, 1);

            if ($char == "<")
                $skip = 1;
            elseif ($char == ">")
                $skip = 0;
            elseif ($char == " ")
                $wrap = 0;

            if ($skip == 0)
                $wrap = $wrap + 1;

            $returnvar = $returnvar . $char;

            if ($wrap > 9) { // alter this number to set the maximum word length
                $returnvar = $returnvar . "&#8203;";
                $wrap = 0;
            }
        }

        return $returnvar;
    }

//-------------------------------------------------------
    public function msubstr($str, $from, $len) {
        return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $from . '}' .
                        '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $len . '}).*#s', '$1', $str);
    }

//-------------------------------------------------------
    public function json_encode($a = false) {
        if (!function_exists('json_encode')) {
            if (is_null($a))
                return 'null';
            if ($a === false)
                return 'false';
            if ($a === true)
                return 'true';
            if (is_scalar($a)) {
                if (is_float($a)) {
// Always use "." for floats.
                    return floatval(str_replace(",", ".", strval($a)));
                }

                if (is_string($a)) {
                    static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
                    return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
                }
                else
                    return $a;
            }
            $isList = true;
            for ($i = 0, reset($a); $i < count($a); $i++, next($a)) {
                if (key($a) !== $i) {
                    $isList = false;
                    break;
                }
            }
            $result = array();
            if ($isList) {
                foreach ($a as $v)
                    $result[] = json_encode($v);
                return '[' . join(',', $result) . ']';
            } else {
                foreach ($a as $k => $v)
                    $result[] = json_encode($k) . ':' . json_encode($v);
                return '{' . join(',', $result) . '}';
            }
        }
    }

//----------------------------------------------------------------------
    public function check_perms() {
        if (($this->show_name == 'buddy' || $this->show_name == 'user') && $_SESSION[$this->uid . 'is_guest'] == 1) {
            $status = "guesthasnopermissions";
        } else if ($this->show_name == 'guest' && $_SESSION[$this->uid . 'is_guest'] == 1) {
            $status = "guesthaspermissions";
        } else if (($this->show_name == 'buddy' || $this->show_name == 'user' || $this->show_name == 'guest') && $_SESSION[$this->uid . 'is_guest'] == 0) {
            $status = "userloggedin";
        } else {
            $this->freichat_debug('Something seems to be wrong in ' . RDIR . '/server/freichat.php (get_members)');
        }
        return $status;
    }

//----------------------------------------------------------------------
    public function get_statusimg_url($status) {

        $img_url = '';
        if ($status == 1 || $status == 4) {
            $status = "online";
            $img_url = $this->url . 'client/jquery/freichat_themes/' . $this->color . '/' . $status . '.png';
        } else if ($status == 3) {
            $status = "busy";
            $img_url = $this->url . 'client/jquery/freichat_themes/' . $this->color . '/' . $status . '.png';
        } else {
            /* USer should be offline */
        }

        return $img_url;
    }

//----------------------------------------------------------------------
//-------------CHATROOM RELATED CODE---------------//
//---------------------------------------------------------------------
//-------------------------------------------------------------------
    public function load_chatroom() {

        $freichat = new freichat();

        $active_room = (int) $_GET['in_room'];
        $_SESSION[$this->uid . 'in_room'] = $active_room;

        $chatroom_mesg_time = $_GET['chatroom_mesg_time'];

        $query2 = "SELECT  r.room_name,r.id as room_id,count(s.id) as online_count
                FROM frei_rooms as r
                LEFT   join  frei_session as s
                on r.id=s.in_room
                AND time>" . $this->online_time2 . "
                Group BY r.id ORDER BY r.room_order";


        $query = "UPDATE frei_session set in_room = " . $active_room . " WHERE permanent_id=" . $_SESSION[$this->uid . 'gst_ses_id'];
        $this->db->query($query);

        $options = array(
            "id" => $_GET['id'],
            "custom_mesg" => htmlentities($_GET['custom_mesg'], ENT_QUOTES),
            "usr_list_wanted" => false,
            "first" => true,
            "in_room" => $active_room
        );

        $this->call_driver($options);

        $curr_time = $_GET['time'];


        $users = $this->get_chatroom_users($active_room);
        $messages = $this->get_chatroom_messages($active_room, 'multi', $chatroom_mesg_time);
        $rooms = $this->db->query($query2)->fetchAll();
        $get_mesg = $this->get_messages($_GET['time']);
        $last_mesg_time = $this->get_last_message_time($get_mesg, $curr_time);
        $chatroom_mesg_time = $this->get_last_message_time($this->chatroom_raw_mesgs, $chatroom_mesg_time);
      //  $this->delete_messages();
        $this->update_messages($active_room);


        $freichat->room_array = $rooms;
        $freichat->chatroom_users_div = $users;
        $freichat->in_room = $active_room;
        $freichat->chatroom_messages = $messages;
        $freichat->messages = $get_mesg;
        $freichat->time = $last_mesg_time;
        $freichat->chatroom_mesg_time = $chatroom_mesg_time;

// $freichat->username = $usr_name;
//$freichat->message = $messages;

        //echo $_SESSION[$this->uid . "in_room"];
        echo json_encode($freichat);
    }

//----------------------------------------------------------------------

    public function get_chatroom_users($active_room) {

        $query = "SELECT DISTINCT  * FROM frei_session WHERE (in_room=" . $active_room . " OR permanent_id=" . $_SESSION[$this->uid . 'gst_ses_id'] . ") AND time>" . $this->online_time2 . " AND in_room<>-1";
        $users = $this->db->query($query)->fetchAll();
        $userdiv = "<div></div>";

        foreach ($users as $user) {
            $userdiv .= '<div id="frei_userlist" class="frei_userlist" onmouseover="$jn(this).addClass(\'frei_userlist_onhover\');" onmouseout="$jn(this).removeClass(\'frei_userlist_onhover\');"><span class="freichat_userscontentname">' . $user['username'] . '</span></div>';
        }//echo $query;
        return $userdiv;
    }

//-------------------------------------------------------------------
    public function get_chatroom_messages($active_room, $all, $time) {

        $frm_id = $this->frm_id;

        if ($active_room == -1) {
            $active_room = 0;
        }

        if ($all == 'multi') {
            $get_mesg_query = "SELECT DISTINCT * FROM frei_chat WHERE room_id=" . $active_room . " AND message_type=1 ORDER BY sent DESC LIMIT 50";
            //echo $get_mesg_query;
        } else if ($all === 'single') {
            $get_mesg_query = "SELECT DISTINCT * FROM frei_chat AS f  WHERE f.from != " . $frm_id . " AND f.room_id=" . $active_room . " AND f.time> " . $time . "  AND f.message_type=1 ORDER BY sent DESC";
        } else {
            $get_mesg_query = "SELECT DISTINCT * FROM frei_chat WHERE room_id=1 AND message_type=1 ORDER BY sent DESC LIMIT 50";
        }
//echo $get_mesg_query;

        $this->chatroom_raw_mesgs = array_reverse($this->db->query($get_mesg_query)->fetchAll());
//var_dump($this->chatroom_raw_mesgs);
        return $this->chatroom_raw_mesgs;
    }
//----------------------------------------------------------------------
  /*  public function delete_messages() {
        if (isset($_SESSION[$this->uid . 'delay'])) {
            if ($_SESSION[$this->uid . 'delay'] > 50) {
                $_SESSION[$this->uid . 'delay'] = 0;

                $delete_mesg_query = "DELETE FROM frei_chat  WHERE recd =1 AND sent < NOW()-" . $this->time;
                $this->db->query($delete_mesg_query);
            } else {
                $_SESSION[$this->uid . 'delay'] = $_SESSION[$this->uid . 'delay'] + 5;
            }
        } else {
            $_SESSION[$this->uid . 'delay'] = 0;
        }
    }
*/
//----------------------------------------------------------------------
    public function update_messages($active_room) {
        $update_mesg_query = "UPDATE frei_chat set recd = 1 WHERE (frei_chat.to = " . $this->frm_id . " || room_id=" . $active_room . ") and recd = 0";
        $this->db->query($update_mesg_query);
    }

//----------------------------------------------------------------------
    public function get_last_message_time($get_mesg, $time) {


        if ($get_mesg != null) {
            $end_mesg = end($get_mesg);
            $time = $end_mesg['time'];
        }

        if (isset($_SESSION[$this->uid . 'msg_time'])) {
            if (!isset($time)) {
//          $time = $_SESSION[$this->uid . 'msg_time'];
            }
        }

        //var_dump($end_mesg);

        if ($time == 0) {
            $time = time() . str_replace(" ", "", microtime());
            return $time;
        }
        return $time;
    }

//----------------------------------------------------------------------
    public function call_driver($options) {

        $update_usr_info = false;

        if ($_SESSION[$this->uid . 'custom_mesg'] != $options['custom_mesg']
                || $_SESSION[$this->uid . 'in_room'] != $options['in_room']) {
            $update_usr_info = true;
        }

        $sessions = new $this->driver($this->db);
        $sessions->uid = $this->uid;
        $sessions->permanent_name = $this->permanent_name;
        $sessions->permanent_id = $this->permanent_id;
        $sessions->online_time = $this->online_time;
        $sessions->online_time2 = $this->online_time2;
        $sessions->time_string = $this->time_string;
        $sessions->show_name = $this->show_name;
        $sessions->options = $options;
        $sessions->usr_list_wanted = $options['usr_list_wanted'];
        $sessions->db_prefix = $this->db_prefix;
        $sessions->displayname = $this->displayname;
        $sessions->frei_trans = $this->frei_trans;
        $sessions->debug = $this->debug;
        $sessions->update_usr_info = $update_usr_info;
        $sessions->url = $this->url;
        $sessions->driver = $this->driver;
        $sessions->to_freichat_path = $this->to_freichat_path;
        $sessions->long_polling = $this->long_polling;

        $sessions->row_username = $this->row_username;
        $sessions->row_userid = $this->row_userid;
        $sessions->usertable = $this->usertable;

        return $sessions;
    }

//----------------------------------------------------------------------
    public function get_messages($time) {

        $frm_id = $this->frm_id;
        $result = array();

        if ($time == 0) {
//$get_mesg_query = "SELECT DISTINCT * FROM frei_chat WHERE frei_chat.to=" . $frm_id . "AND time<2 ORDER BY sent";
        } else {
            $get_mesg_query = "SELECT * FROM frei_chat WHERE frei_chat.to=" . $frm_id . " AND time>" . $time . " AND frei_chat.message_type=0 ORDER BY sent ";
            $result = $this->db->query($get_mesg_query)->fetchAll();
        }

//echo $get_mesg_query;
        return $result;
    }

//----------------------------------------------------------------------
    public function get_members() {

        $freichat = new freichat();

        $onlcnt = 0;
        $online_time = $this->online_time2;
        $text = null;
        $guest = NULL;
        $freichat->user_array = array();
        $freichat->id_array = array();
        $freichat->img_array = array();

        if (isset($_SESSION[$this->uid . 'freistatus']) == false) {
            $_SESSION[$this->uid . 'freistatus'] = 1;
        }

        $active_room = (int) $_GET['in_room'];


        $update_usr_info = false;


        $_SESSION[$this->uid . 'in_room'] = $active_room;


        if (!isset($_SESSION[$this->uid . 'custom_mesg'])) {
            $_SESSION[$this->uid . 'custom_mesg'] = $this->frei_trans['default_status'];
        }

        $custom_mesg = htmlentities($_GET['custom_mesg'], ENT_QUOTES, "UTF-8");

        if ($_GET['custom_mesg'] != 'i am null') {
            $_SESSION[$this->uid . 'custom_mesg'] = $custom_mesg;
        }

        $options = array(
            "id" => $_GET['id'],
            "custom_mesg" => $custom_mesg,
            "usr_list_wanted" => true,
            "first" => $_GET['first'],
            "in_room" => $active_room
        );

        $first = $_GET['first'];

        $object = $this->call_driver($options);
        $result = $object->load_driver();
        //var_dump($result);
        $profile_text = '';
        $profile_img = $this->url . 'client/jquery/freichat_themes/' . $this->color . '/profilelink.png';
        $path = str_replace($this->to_freichat_path, "", $this->url);



        foreach ($result as $res) {

            $guest = $res['username'];
            $guest = strlen($guest) > 30 ? $this->msubstr($guest, 0, 16) . "..." : $guest;
            $img_url = $this->get_statusimg_url($res['status']);




            if ($this->linkprofile != 'disabled' && isset($res['profile_iden']) && $_SESSION[$this->uid . "is_guest"] == 0) {

                $iden = str_replace(":", "-", $res['profile_iden']);
                $params = array(
                    'id' => $res['session_id'],
                    'iden' => $iden,
                    'path' => $path,
                    'img' => $profile_img
                );
                $profile_text = $object->linkprofile_url($params);
                $guest = strlen($guest) > 18 ? $this->msubstr($guest, 0, 12) . "..." : $guest;
            }


            $avatar_url = "http://www.gravatar.com/avatar/" . md5($guest) . "?s=24&d=wavatar"; //$this->url . "/client/jquery/user.jpeg";

            if (isset($res[$this->avatar_field_name])) {

                if ($res['avatar'] != null || $res[$this->avatar_field_name] != "") {
                    $avatar_url = $object->avatar_url($res[$this->avatar_field_name]);
                } else {
                    $avatar_url = "http://www.gravatar.com/avatar/" . md5($guest) . "?s=24&d=wavatar";
                }
            }

            $guest = str_replace("'", " ", $guest);

// $text.="<span  onmousedown=\"FreiChat.createChatBoxmesg('" . $guest . "','" . $res['session_id'] . "')\"><a title='" . $res['status_mesg'] . "' class=\"online-usr-list\" href='javascript:void(0)'><span style='display:" . $this->show_avatar . "'><img src='" . $avatar_url . "' height='22' width='22' alt='avatar' align='left'/></span>&nbsp;<img style='padding:4px;'src='" . $img_url . "' height='12' width='12' alt='status' align='right'/>" . (strlen($guest) > 13 ? $this->msubstr($guest, 0, 10) . "..." : $guest) . "</a></span><hr style='margin-top:5px;margin-bottom:5px;color:black'/>";


            $text.="<div id='freichat_user_" . $res['session_id'] . "' title='" . $res['status_mesg'] . "'  onmousedown=\"FreiChat.createChatBoxmesg('" . $guest . "','" . $res['session_id'] . "')\" class=\"freichat_userlist\" onmouseover='FreiChat.show_profilelink(" . $res['session_id'] . ")' onmouseout='FreiChat.hide_profilelink(" . $res['session_id'] . ")'>
  <span >
<span style='display:" . $this->show_avatar . "' class='freichat_userscontentavatar'><img src='" . $avatar_url . "' height='22' width='22' alt='avatar' align='left' class='freichat_userscontentavatarimage'/></span>
  </span>
  <span class=\"freichat_userscontentname\">" . (strlen($guest) > 20 ? $this->msubstr($guest, 0, 10) . "..." : $guest) . "</span>
  <span >&nbsp;<img class ='freichat_userscontentstatus' style='padding-top:4px; padding-right:4px;' src='" . $img_url . "' height='12' width='12' alt='status' /></span>" . $profile_text . "
</div>";
            $onlcnt++;
            $freichat->user_array[] = $guest;
            $freichat->id_array[] = $res['session_id'];
            $freichat->img_array[] = $avatar_url;
            $logged = true;
        }

        $frm_id = $this->frm_id;


        $active_room = $_SESSION[$this->uid . 'in_room'];


        if ($this->show_chatroom_plugin == 'enabled') {


            $query2 = "SELECT  r.room_name,r.id as room_id,count(s.id) as online_count
                FROM frei_rooms as r
                LEFT   join  frei_session as s
                on r.id=s.in_room
                
                Group BY r.id ORDER BY r.room_order";
//echo $query2;
            $users = $this->get_chatroom_users($active_room);

            $rooms = $this->db->query($query2)->fetchAll();


            $freichat->room_array = array();
            $freichat->room_array = $rooms;

            $freichat->chatroom_users_div = $users;
            $freichat->in_room = $active_room;
        }
//$this->change_custom_status_mesg($_GET['custom_mesg']);     

        $freichat->islog = $this->check_perms();
        $freichat->status = $_SESSION[$this->uid . 'freistatus'];

        $freichat->userdata = $text;
        $freichat->count = $onlcnt;
        $freichat->username = str_replace("'", "", $this->frm_name);
        $freichat->userid = $this->frm_id;


        if (is_array($_GET['clrchtids'])) {
            if ($_GET['clrchtids'][0] != '') {
                $this->clrcht($_GET["clrchtids"]);
            }
        }

        if ($this->long_polling == "enabled" && $_GET['long_poll'] != 'false' && isset($_SESSION[$this->uid . 'main_loaded'])) {
            session_write_close();
            $new_data = false;

            $time = time();
            while ((time() - $time) < $this->poll_time) {

                // $new_data = array();    

                $freichat = $this->update_message_data($freichat);
                if ($freichat->time > $_GET['time']) {
                    // a new message !
                    $new_data = true;
                }


                if ($this->show_chatroom_plugin == "enabled") {
                    if ($freichat->chatroom_mesg_time > $_GET['chatroom_mesg_time']) {
                        // a new message 
                        $new_data = true;
                    }
                }


                if ($new_data == true) {
                    echo json_encode($freichat);
                    break;
                }

                usleep(($this->chatspeed * 1000));
            }

            if ($new_data == false) {
                echo json_encode($freichat);
            }
        } else {
            $freichat = $this->update_message_data($freichat);
            echo json_encode($freichat);
        }
    }

//-------------------------------------------------------------------
    public function update_message_data($freichat) {


        $curr_time = $_GET['time'];
        $chatroom_mesg_time = $_GET['chatroom_mesg_time'];
        $active_room = $_SESSION[$this->uid . 'in_room'];

        $get_mesg = $this->get_messages($curr_time);
       // $this->delete_messages();
        $this->update_messages($active_room);
        $freichat->time = $this->get_last_message_time($get_mesg, $curr_time);
        $freichat->messages = $get_mesg;

        if ($this->show_chatroom_plugin == 'enabled') {


            $chatroom_messages = null;
            if ($_GET['first'] == 'false') {
                $chatroom_messages = $this->get_chatroom_messages($active_room, 'default', $chatroom_mesg_time);
            } else {
                $chatroom_messages = $this->get_chatroom_messages($active_room, 'single', $chatroom_mesg_time);
            }

            $freichat->chatroom_messages = $chatroom_messages;
            $last_chatroom_message = end($this->chatroom_raw_mesgs);
            $freichat->last_chatroom_usr_id = $last_chatroom_message['from'];

            $chatroom_mesg_time = $this->get_last_message_time($chatroom_messages, $chatroom_mesg_time);
            $freichat->chatroom_mesg_time = $chatroom_mesg_time;
        }

        return $freichat;
    }

//-------------------------------------------------------------------
    public function post_mesg() {
        $freichat = new freichat();
        $frm_id = $this->frm_id;
        $usr_name = str_replace("'", "", $this->frm_name);
        $room_id = -1;
        if ($_POST['message_type'] == 0) {
            if ($this->driver == "Sugarcrm") {
                $to = $_POST['to'];
            } else {
                $to = $this->bigintval($_POST['to']);
            }
        } else {
            
        }


        /*
          0 => normal message
          1 => chatroom message
         */
        $message_type = null;
        $chatroom_mesg_time = 0.00;
        $active_room = (int) $_POST['in_room'];


        if (isset($_POST['message_type'])) {

            $message_type = strip_tags($_POST['message_type']);
        }

        if (isset($_POST['in_room'])) {
            $room_id = (int) $_POST['in_room'];
        }
        $mesg = $_POST['message'];
        $last_mesg_time = null;
        $get_mesg = null;

        foreach ($mesg as $message) {
            if ($message_type == 0) {
                $messages = array($message);
            } else {
                $messages = explode(',', $message);
            }
        }


        $GMT_time = $this->bigintval($_POST['GMT_time']);
        $insert_mesg_query = "INSERT INTO frei_chat (frei_chat.from,frei_chat.from_name,frei_chat.to,frei_chat.to_name,frei_chat.message,frei_chat.sent,frei_chat.time,frei_chat.message_type,frei_chat.room_id,frei_chat.GMT_time) VALUES(?,?,?,?,?,NOW(),?,?,?,?)";
        $this->insert_mesg_query = $this->db->prepare($insert_mesg_query);

        if ($_POST['to'] == 'FcX_AlIcE') {
            $_REQUEST['oreqmode'] = 'json';
            var_dump($messages);
            $_REQUEST['chatbotmessage'] = $messages[0];
            require '../client/plugins/bot/chat.php';
        }

        foreach ($messages as $message) {
            $message = nl2br($message);

            $to_name = htmlentities($_POST['to_name'], ENT_QUOTES, "UTF-8");
            $time = time() . str_replace(" ", "", microtime());
            if ($message_type == 0) {
                $chatroom_mesg_time = $_POST['chatroom_mesg_time']; //echo $message_type;
                $this->insert_mesg_query->execute(array($frm_id, $usr_name, $to, $to_name, $message, $time, $message_type, '-1', $GMT_time));
            } else {
                //$chatroom_mesg_time = $time;
                $chatroom_mesg_time = $_POST['chatroom_mesg_time'];
                $this->insert_mesg_query->execute(array($frm_id, $usr_name, $room_id, $room_id, $message, $time, $message_type, $room_id, $GMT_time));
            }
        }
        $custom_mesg = htmlentities($_POST['custom_mesg'], ENT_QUOTES, "UTF-8");
        if ($_POST['passBYpost'] == true) {



            $options = array(
                "id" => $_POST['id'],
                "custom_mesg" => $custom_mesg,
                "usr_list_wanted" => false,
                "first" => true,
                "in_room" => $active_room
            );


            $this->call_driver($options);


            if (!isset($_SESSION[$this->uid . 'in_room'])) {
                $_SESSION[$this->uid . 'in_room'] = -1;
            }


            $get_mesg = $this->get_messages($_POST['time']);
            $last_mesg_time = $this->get_last_message_time($get_mesg, $_POST['time']);
           // $this->delete_messages();
            $this->update_messages($active_room);

            $_SESSION[$this->uid . 'custom_mesg'] = $custom_mesg;

            $freichat->chatroom_messages = $this->get_chatroom_messages($active_room, 'single', $chatroom_mesg_time);
            //$last_chatroom_message = end($this->chatroom_raw_mesgs);
            // $freichat->last_chatroom_usr_id = $last_chatroom_message['from'];
        }

        $freichat->messages = $get_mesg;
        $freichat->time = $last_mesg_time;
        $freichat->username = $usr_name;
        $freichat->message = $messages;
        $freichat->chatroom_mesg_time = $this->get_last_message_time($freichat->chatroom_messages, $chatroom_mesg_time);

        echo json_encode($freichat);
    }

//-------------------------------------------------------------------------
    public function get_data() {
        $freichat = new freichat();

        $frm_id = $this->frm_id;
        $exist = false;


        $getdata_query = "SELECT * FROM frei_chat WHERE (frei_chat.to=" . $frm_id . " OR frei_chat.from=" . $frm_id . ") AND message_type<>1 ORDER BY sent";
        $messages = $this->db->query($getdata_query)->fetchAll();


        foreach ($messages as $analyse) {
            if ($analyse == NULL) {
                $exist = false;
            } else {
                $exist = true;
            }
        }


        $freichat->exist = $exist;
        $freichat->messages = $messages;

        echo json_encode($freichat);
    }

//-------------------------------------------------------------------------------
    public function isset_msg() {
        $freichat = new freichat();
        $frm_id = $this->frm_id;
        $to_id = (int) $_GET['Cid'];


        $isset_mesg_query = "SELECT * FROM frei_chat WHERE (frei_chat.to=" . $frm_id . " AND frei_chat.from=" . $this->db->quote($to_id) . ") OR (frei_chat.from=" . $frm_id . " AND frei_chat.to=" . $this->db->quote($to_id) . ") ORDER BY sent";
        $get_mesg = $this->db->query($isset_mesg_query)->fetchAll();
//echo $isset_mesg_query;

        $freichat->messages = $get_mesg;
        $analyze = $freichat->messages;
        $exist = false;
        foreach ($analyze as $analyse) {
            if ($analyse == NULL) {
                $exist = false;
            } else {
                $exist = true;
            }
        }
        $freichat->exist = $exist;
        echo json_encode($freichat);
    }

//-------------------------------------------------------------------------------
    public function clrcht($id) {
        $id = implode(',', $id);

        $clrcht_query = "DELETE FROM frei_chat where (frei_chat.to IN (" . $this->db->quote($id) . ") AND  frei_chat.from IN(" . $this->frm_id . ")) OR (frei_chat.from IN(" . $this->db->quote($id) . ") AND  frei_chat.to IN(" . $this->frm_id . "))";
        $this->db->query($clrcht_query);
    }

//---------------------------------------------------------------------------------
    public function update_status() {
        $freichat = new freichat();
        $user_id = $_SESSION[$this->uid . 'gst_ses_id'];
        $freistatus = (int) $_POST['freistatus'];

        if ($_SESSION[$this->uid . 'freistatus'] != $_POST['freistatus']) {
            $freistatus = ($freistatus == 4) ? 3 : $freistatus;

            $query = "UPDATE frei_session set status=" . $this->db->quote($freistatus) . " WHERE permanent_id=" . $user_id;
            $this->db->query($query);
        }

        $_SESSION[$this->uid . 'freistatus'] = (int) $_POST['freistatus'];

        $freichat->status = (int) $_POST['freistatus'];
        $freichat->id = $user_id;
        echo json_encode($freichat);
    }

//---------------------------------------------------------------------------------
}

/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */

$freichat = new freichatX();

if ($_REQUEST['freimode'] == "getmembers") {
    $freichat->get_members();
} else if ($_REQUEST['freimode'] == "post") {
    $freichat->post_mesg();
} else if ($_REQUEST['freimode'] == "getdata") {
    $freichat->get_data();
} else if ($_REQUEST['freimode'] == "clrcht") {
    $freichat->clrcht();
} else if ($_REQUEST['freimode'] == "update_status") {
    $freichat->update_status();
} else if ($_REQUEST['freimode'] == "isset_mesg") {
    $freichat->isset_msg();
} else if ($_REQUEST['freimode'] == "sendvideo") {
    $freichat->video_request();
} else if ($_REQUEST['freimode'] == "loadchatroom") {
    $freichat->load_chatroom();
} else {
    echo "Request Not Working!";
    $freichat->freichat_debug("Request Not Working!");
}


if (isset($_SESSION[$freichat->uid . 'usr_name']) == false) {
    echo "Unable To Store In session";
    $freichat->freichat_debug("Unable to store in session");
    var_dump($_SESSION);
}
?>
