<?php

session_start(); //Start the session
//Base class for Plugins

class base {

//------------------------------------------------------------------------------------------------

    public function __construct() {
        require '../../../arg.php';

        $this->url = $url;
        $this->uid = $uid;

        $this->con = $con;
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->client_db_name = $client_db_name;


        $this->smtp_username = $smtp_username;
        $this->smtp_password = $smtp_password;
        $this->mailtype = $mailtype;
        $this->smtp_server = $smtp_server;
        $this->smtp_port = $smtp_port;
        $this->smtp_protocol = $smtp_protocol;
        $this->mail_from_address = $mail_from_address;
        $this->mail_from_name = $mail_from_name;

        $this->debug = $debug;

        $this->connectDB();
    }

//------------------------------------------------------------------------------------------------
    public function connectDB() {
        try {
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->client_db_name, $this->username, $this->password);
        } catch (PDOException $e) {
            $this->freichat_debug("unable to connect to database. Error : " . $e->getMessage());
            die();
        }

        $this->freichat_debug("connected to database successfully");
        $this->db->exec("SET CHARACTER SET utf8");
    }

//------------------------------------------------------------------------------------------------
    public function freichat_debug($message) {
        if ($this->debug == true) {
            $dbgfile = fopen("../freixlog.log", "a");
            fwrite($dbgfile, date("F j, Y, g:i a") . ": " . $message . "\n");
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
}