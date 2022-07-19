<?php
namespace App\App;

final class dbmysql implements Interfaces\IDB
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

    public function link()
    {
        return $this->db;
    }

    public function connect()
    {
        try {
            $this->db = new \mysqli(
                $this->host,
                $this->username,
                $this->passwd,
                $this->dbname
            );
        } catch (\mysqli_sql_exception $e) {
            print_r($e->getMessage());
            die;
        }

        $this->db->set_charset("utf8");

        return $this;
    }
}