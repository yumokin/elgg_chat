<?php

class upload {

//---------------------------------------------------------------------------------------------
    public function __construct() {

        require_once '../../../arg.php';

        $this->url = str_replace("upload.php", "", $url);
        $this->con = $con;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->client_db_name = $client_db_name;

        $this->file_size_limit = $file_size_limit * 1024;
        $this->expiry_time = $expirytime;
        $this->valid_exts = $valid_exts;

        $this->uploaded = false;
        $this->error = 0;
        $this->filename = null;
        $this->path = 'upload/';
    }

//---------------------------------------------------------------------------------------------
    function findexts($fn) {
        $str = explode('/', $fn);
        $len = count($str);
        if (strpos($str[($len - 1)], '.') === False)
            return False; // Has not .
        $str2 = explode('.', $str[($len - 1)]);
        $len2 = count($str2);
        $ext = $str2[($len2 - 1)];
        return $ext;
    }

//---------------------------------------------------------------------------------------------
    public function upload() {
        if (!isset($_FILES['file'])) {
            $this->error = TRUE;
            $this->fdie('Unknown error');
            echo '<br/><br/><a href="html.php">Send another file</a>';
            echo '<br/><br/>Window will be closed in about 6 seconds<script>setTimeout("self.close()",6000);</script>';
            exit;
        }
        $file_ext = explode(",", $this->valid_exts);
        //$this->uploaded = false;
        if (defined('FREIACCESS')) {
            //$this->error = TRUE;
            //$this->fdie("No direct Access!");
        } else if (!in_array($_FILES["file"]["type"], $file_ext)) {
            $this->error = TRUE;
            $this->fdie("Invalid file!<br/><br/>");
        } else if ($_FILES["file"]["size"] > $this->file_size_limit) {
            $this->error = TRUE;
            $this->fdie("File size too large!<br/><br/>");
        } else if ($_FILES["file"]["error"] > 0) {
            $this->error = TRUE;
            $this->fdie("File upload error<br/><br/>Return Code: " . $_FILES["file"]["error"] . "<br />");
        } else if ($_FILES["file"]["error"] == 0) {
            //if(!file_exists($this->path.$_FILES['file']['name']))
            // {
            if (is_writable($this->path)) {
                $this->error = FALSE;
                $temp_name = time() . rand(22, 333) . "." . $this->findexts($_FILES["file"]["name"]);

                move_uploaded_file($_FILES["file"]["tmp_name"], $this->path . $temp_name);
            } else {
                $this->fdie('Upload directory does not have required permissions');
            }
            // }
        } else {
            $this->error = TRUE;
            $this->fdie('Uknown error!<br/>');
        }


        if ($this->error == FALSE) {
            $this->filename = $temp_name; //$_FILES['file']['name'];
            $this->file_real_name = $_FILES['file']['name'];
            echo "File Name: " . $this->filename . "<br />";
            echo "File Type: " . $_FILES["file"]["type"] . "<br />";
            echo "File Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            echo '<br/>Your file has been succesfully sent to ' . $_POST['toname'];
            echo '<br/><a target="_blank" href=download.php?filename=' . $this->filename . '>Download your Sent file!</a><br/><br/>';
            $this->uploaded = true;
            $this->savetoDB($this->filename, $_FILES['file']['name']);
        } else {
            $this->uploaded = false;
            echo '<br/>Failed to upload file!<br/>';
        }


        echo '<a href="html.php">Send another file</a>';
        echo '<br/><br/>Window will be closed in about 6 seconds';

        $this->delete_files();
    }

//---------------------------------------------------------------------------------------------
    public function fdie($mesg) {
        echo $mesg;
    }

//---------------------------------------------------------------------------------------------
    public function savetoDB($filename, $show_name) {
        $this->connectDB();
        $this->frm_id = $_POST['fromid'];
        $this->usr_name = $_POST['fromname'];
        $this->to = $_POST['toid'];
        $this->to_name = $_POST['toname'];
        $fname = $show_name;
        $replace = "_";
        $pattern = "/([[:alnum:]_\.-]*)/";
        $fname = str_replace(str_split(preg_replace($pattern, $replace, $fname)), $replace, $fname);
        $message = "<a target='_blank' href=" . $this->url . "download.php?filename=" . $filename . ">" . $fname . "</a>";
//var_dump($this);
        $message = str_replace("'", "\'", $message);
        $time = time() . str_replace(" ", "", microtime());
//echo "e";
        $query = "INSERT INTO frei_chat (frei_chat.from,frei_chat.from_name,frei_chat.to,frei_chat.to_name,frei_chat.message,sent,time) VALUES(\"$this->frm_id\",'$this->usr_name',\"$this->to\",'$this->to_name','$message',NOW(),'$time')";
        $this->db->query($query);
//echo $query;
    }

    public function connectDB() {
        try {
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->client_db_name, $this->username, $this->password);
        } catch (PDOException $e) {

            die();
        }


        $this->db->exec("SET CHARACTER SET utf8");
    }

//---------------------------------------------------------------------------------------------

    public function delete_files() {
        $captchaFolder = $this->path;
        // Filetypes to check (you can also use *.*)
        $fileTypes = '*.*';
        $expire_time = $this->expiry_time; //in minutes
        // Find all files of the given file type
        foreach (glob($captchaFolder . $fileTypes) as $Filename) {
            // Read file creation time
            $FileCreationTime = filectime($Filename);

            // Calculate file age in seconds
            $FileAge = time() - $FileCreationTime;

            // Is the file older than the given time span?
            if ($FileAge > ($expire_time * 60)) {
                //   echo "The file $Filename is older than $expire_time minutes\n";
                unlink($Filename);
            }
        }
    }

}

$upload = new upload();
$upload->upload();
?>
<html>
    <title>
        File Upload Status
    </title>
    <head>
        <script>
            function JSup()
            {
                setTimeout("self.close()",6000);

                //if(true) {return;}

                if("<?php echo $upload->uploaded; ?>" == true  && "<?php echo $upload->error; ?>" == false)
                {
                    var objcontent = opener.document.getElementById("chatboxcontent_"+'<?php echo $upload->to; ?>');
                    var defText = objcontent.innerHTML;
                    var from_name = '<?php echo $upload->usr_name; ?>';
                    var message = "<a target='_blank' href=<?php echo $upload->url; ?>download.php?filename=<?php echo $upload->filename; ?>><?php echo $upload->file_real_name; ?></a> [Sent succesfully!]";
                    var newText = '<div class="chatboxmessage"><span class="chatboxmessagefrom">'+from_name+':&nbsp;</span><span class="chatboxmessagecontent">'+message+'</span></div>';

                    objcontent.innerHTML = defText+newText;
                    objcontent.scrollTop = objcontent.scrollHeight;
                }
            }
            JSup();
        </script>
    </head>
    <body>
    </body>
</html>

