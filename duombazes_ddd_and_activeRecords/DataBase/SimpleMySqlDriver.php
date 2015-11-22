<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.21
 * Time: 16:34
 */

namespace DB;
require_once "IDriver.php";
use PDO;

include __DIR__."/config.php";

class SimpleMySqlDriver implements IDriver{

    private $db_host;
    private $db_name;
    private $db_username;
    private $db_password;
    private $is_connected = false;
    private $db;
    private $query = "";

    function __construct($db_host=DB_HOST, $db_name=DB_NAME, $db_username=DB_USER, $db_password=DB_PASSWORD)
    {
        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_username = $db_username;
        $this->db_password = $db_password;
    }


    public function connect()
    {
        $this->db = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name, $this->db_username, $this->db_password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
        $this->is_connected = true;
    }

    public function isConnected()
    {
        return $this->is_connected;
    }

    public function addQuery($q, $params = [])
    {
        if (count($params) > 0){
            foreach ($params as $key => $val){
                $q = str_replace($key, "'".mysql_real_escape_string($val)."'", $q);
            }
        }
        $this->query .= $q.';';
    }

    public function setQuery($q, $params = [])
    {
        if (count($params) > 0){
            foreach ($params as $key => $val){
                $q = str_replace($key, "'".mysql_real_escape_string($val)."'", $q);
            }
        }
        $this->query = $q;
    }

    public function getQuery(){
        return $this->query;
    }

    public function execute($return = false)
    {
        if (!$return){
            $this->db->prepare($this->query)->execute();
            $this->query = "";
            return true;
        }
        elseif (strpos(strtoupper($this->query),'INSERT') !== false ){
            $this->db->prepare($this->query)->execute();
            $this->query = "";
            return $this->db->lastInsertId();
        }
        $query = $this->db->prepare($this->query);
        $this->query = "";
        if ($query->execute())
            return $query->fetchAll();
        else
            return [];

    }

    public function queryIsEmpty()
    {
        return $this->query == "";
    }
}