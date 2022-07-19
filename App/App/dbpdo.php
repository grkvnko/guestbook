<?php
namespace App\App;

use PDO;
use PDOException;

final class dbpdo implements Interfaces\IDB
{
    private $host,
            $username,
            $passwd,
            $dbname;

    private $db;

    public function __construct($param)
    {
        $this->host = $param['host'];
        $this->username = $param['username'];
        $this->passwd = $param['passwd'];
        $this->dbname = $param['dbname'];
    }

    public function query($sql)
    {
        return $this->db->query($sql);
    }

    public function connect()
    {
        try {
            $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->username, $this->passwd);
        } catch (PDOException  $e) {
            print_r($e->getMessage());
            die;
        }

        return $this;
    }
}