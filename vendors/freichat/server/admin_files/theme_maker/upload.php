<?php
error_reporting(E_ALL);
session_start();
        require 'streamer.php';

class upload {

    public function __construct() {
        require '../../../arg.php';
        $this->valid_exts = $valid_exts;
        $this->uid = $uid;
        $this->debug = $debug;
        $this->url = $url;
        $this->freichat_theme = $_SESSION[$this->uid . 'curr_theme'];
        $this->path = RDIR . '/client/jquery/freichat_themes/' . $this->freichat_theme . '/';
        //$this->js_variable = $_POST['variable_js'];
        $this->max_file_size = 10 * 1024 * 1024 * 1024;
    }

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

    public function sanitize($filename) {
        $parts = explode('.', $filename);
        $ext = array_pop($parts);
        $filename = implode($parts);
        $filename = preg_replace('#\W#', '', $filename);
        $filename = str_replace(" ","",$filename);
        $time = substr(time(),5);
        $filename = $filename.$time;
        $filename = $filename.".".$ext;
        return $filename;
    }
    
    public function upload_file() {

        $file_name = $this->sanitize($_SERVER['HTTP_X_FILE_NAME']);
        $file_size = $_SERVER['HTTP_X_FILE_SIZE'];
        $file_type =  $_SERVER['HTTP_X_FILE_TYPE'];       
        $original_name = $_SERVER['HTTP_X_ORIGINAL_FILE_NAME'];

        
        $file_ext = explode(",", $this->valid_exts);
        if ($file_size > $this->max_file_size) {
            $this->freichat_debug('file size exceeded');
            $status = 'exceed';
        } 
        else if(!in_array($file_type, $file_ext)){
            $this->freichat_debug('file type invalid');
            $status = 'type';
        }
        else {
                       
            $ft = new File_Streamer();
            $ft->_fileName = $file_name;
            $ft->setDestination($this->path);
            $ft->receive();
            @chmod($this->path.$file_name,0777);
            $this->replace_file($original_name,$file_name);
            $status =  $file_name;
        }
            echo $status;

    }

    public function replace_file($originalname,$newname) {

        $filename = $originalname;
        $file_path = $this->path . "argument.php";
        $file = @file_get_contents($file_path);
        $variable = strip_tags($_SERVER['HTTP_X_VARIABLE_PHP']);

        $string = '$' . $variable . ' = \'' . $filename . '\';';
        $rep = '$' . $variable . ' = \'' . $newname . '\';';
        //echo $string . $rep;
        if ($file) {
            $file = str_replace($string, $rep, $file);
        } else {
            $this->freichat_debug('Unable to get contents of argument.php file');
        }
        file_put_contents($file_path, $file);
    }

    public function freichat_debug($message) {
        if ($this->debug == true) {
            $dbgfile = fopen("../../../freixlog.log", "a");
            fwrite($dbgfile, "\n" . date("F j, Y, g:i a") . ": " . $message . "\n");
        }
    }

}



$upload = new upload();
$upload->upload_file();
?>