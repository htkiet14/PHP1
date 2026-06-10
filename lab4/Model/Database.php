<?php

class Database
{
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;
    public $connection;

    public function __construct()
    {

        $this->db_host = "103.57.220.210";
        $this->db_name = "vkkqwumchosting_php1";
        $this->db_user = "vkkqwumchosting_php1";
        $this->db_pass = "J(%szA*395rR38X";
    }

    public function Connection()
    {
        $dsn = "mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8";
        try {
            $pdo = new PDO($dsn, $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            return $pdo;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
