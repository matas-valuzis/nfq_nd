<?php
/**
 * Created by PhpStorm.
 * User: Matas
 * Date: 2015.11.22
 * Time: 18:06
 */

namespace ActiveRecord;
require_once "../DataBase/SimpleMySqlDriver.php";

use DB\IDriver;
use DB\SimpleMySqlDriver;
use Iterator;

abstract class AbstractActiveRecord implements Iterator{

    protected $id = null;

    protected $recordList = [];

    protected $poss = 0;

    protected $db_driver;

    function __construct(IDriver $driver = null){
        if ($driver != null)
            $this->db_driver = $driver;
        else
            $this->db_driver = new SimpleMySqlDriver();
    }

    abstract protected function getTable();

    abstract protected function getFields();

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;

    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    abstract protected function getSaveValues();

    protected function flush($select = false){

        if ($this->db_driver->queryIsEmpty())
            return [];

        if(!$this->db_driver->isConnected())
            $this->db_driver->connect();
        if (!$select)
            return $this->db_driver->execute();
        else
            return $this->db_driver->execute(true);

    }

    public function createTable(){
        $fields = $this->getFields();
        $name = $this->getTable();
        $table_query = "CREATE TABLE IF NOT EXISTS $name (".implode(' ,', $fields).");";

        $table_query .= $this->db_driver->getQuery();
        $this->db_driver->setQuery($table_query);
    }

    abstract protected function createFromAssoc($arr);

    public function getAll($where = []){
        $table = $this->getTable();

        $q = "SELECT * FROM $table ";
        $args = [];

        if (count($where) > 0){
            $conditions = [];
            foreach ($where as $clause){
                $conditions[] = $clause[0].$clause[1].":".$clause[0];
                $args[":".$clause[0]] = $clause[2];
            }
            $q .= "WHERE ".implode(' AND ', $conditions);
        }

        $this->flush();
        $this->db_driver->setQuery($q, $args);
        $results =  $this->flush(true);

        $active_records = [];
        if (count($results) < 1){
            return [];
        }
        foreach ($results as $result){
            $active_records[] = $this->createFromAssoc($result);
        }

        return $active_records;
    }

    public function save(){
        $vals = $this->getSaveValues();
        $table = $this->getTable();
        $id = $this->id;
        if ($id != null){

            $set_fields = [];
            $set_vals = [];
            foreach ($vals as $name => $val){
                $set_fields[] = $name."=:".$name;
                $set_vals[":".$name] = $val;
            }
            $set_vals[":id"] = $id;

            $q = "UPDATE $table SET ";
            $q .= implode(", ", $set_fields);
            $q .= " WHERE id=:id";

            $this->db_driver->addQuery($q, $set_vals);
            $this->flush();
        }
        else{
            $set_fields = [];
            $set_vals = [];
            foreach ($vals as $name => $val){
                $set_fields[] = $name;
                $set_vals[":".$name] = $val;
            }
            $q = "INSERT INTO $table (";
            $q .= implode(" ,", $set_fields);
            $q .= ") VALUES (:";
            $q .= implode(", :", $set_fields);
            $q .= ")";

            $this->flush();
            $this->db_driver->addQuery($q, $set_vals );
            $id = $this->flush(true);
            $this->setId($id);
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->recordList[$this->poss];
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        ++$this->poss;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        $this->poss;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return isset($this->recordList[$this->poss]);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->recordList = $this->getAll();
        $this->poss = 0;
    }


}