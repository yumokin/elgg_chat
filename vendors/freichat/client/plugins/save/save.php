<?php

require_once '../base.php';

class save extends base {

    public function __construct() {
        parent::__construct();

        $this->url = str_replace("upload.php", "", $this->url);
    }

    public function writeconv($download) {
        $frm_id = $_SESSION[$this->uid . 'usr_ses_id'];
        $to_id = $this->bigintval($_GET['toid']);

        $to_name = htmlentities($_GET['toname'], ENT_QUOTES, "UTF-8");
        $name = "<html><head><title>Conversation_with_" . $to_name . "</title></head><body><center><h3>Conversation with $to_name</h3></center>";
        $lines = '<hr/>';
        //$path = "tmp/".$name.".txt";

        $query = "SELECT * FROM frei_chat WHERE (frei_chat.to=? AND frei_chat.from=?) OR (frei_chat.from=? AND frei_chat.to=?) ORDER BY sent";
        $this->ISmesGquery = $this->db->prepare($query);
        $this->ISmesGquery->execute(array($frm_id, $to_id, $frm_id, $to_id));
        $messages = $this->ISmesGquery->fetchAll();

        $contents = "";


        foreach ($messages as $message) {
            $contents.= "<b>" . $message['from_name'] . ":</b>  " . str_replace("\'", "'", strip_tags($message['message'])) . " <br/>\n";
        }

        $prime = $name . "\n" . $lines . "\n\n";
        $complete_contents = $prime . str_replace("&#44;", ",", $contents) . "<hr/></body></html>";

        $filename = "conversation_with_" . $to_name . ".html";

        if ($download == true) {
            $this->downloadconv($filename, $complete_contents);
        }
        return $complete_contents;
    }

    public function downloadconv($filename, $contents) {

// Send file headers
        header("Content-type: file");
        header("Content-Disposition: attachment;filename=$filename");
        header("Content-Transfer-Encoding: binary");
        header('Pragma: no-cache');
        header('Expires: 0');
// Send the file contents.
        echo $contents;
        set_time_limit(0);
    }

}

$save = new save();
$save->writeconv(true);
?>