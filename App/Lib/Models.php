<?php

namespace App\Lib;

class Models
{
    public $table;
    public $primaryKey;
    public $uniqueVal;

    private $db;
    protected $data = array();

    public function __construct($id = 0)
    {

        $this->db = DBC::connect();

        $this->data[$this->primaryKey] = $id;

        if ($this->data[$this->primaryKey] !== 0) {

            $data = array(
                ':id' => $id,
            );

            $sql = "select * from " . $this->table . " where " . $this->primaryKey . " = :id";

            $stm = $this->db->prepare($sql);
            if ($stm->execute($data)) {
                $results = $stm->fetch();
                if ($results) {
                    foreach ($results as $key => $val) {
                        $this->data[$key] = $val;
                    }
                }
            }
        }

    }


    public function uniqueCheck($unique)
    {
        $this->db = DBC::connect();

        $this->data[$this->uniqueVal] = $unique;

        if ($this->data[$this->uniqueVal] !== 0) {

            $data = array(
                ':unique' => $unique,
            );

            $sql = "select * from " . $this->table . " where " . $this->uniqueVal . " = :unique limit 1";

            $stm = $this->db->prepare($sql);
            if ($stm->execute($data)) {
                $results = $stm->fetch();
                if ($results) {
                    foreach ($results as $key => $val) {
                        $this->data[$key] = $val;
                    }
                }
            }
        }
    }


    public function save()
    {
        $data = array();
        $keys = array();
        $sqlParts = array();

        foreach ($this->data as $key => $val) {
            if ($key !== $this->primaryKey) {
                $keys[$key] = $key;
                $data[":$key"] = $val;
            }
        }

        if ($this->data[$this->primaryKey] === 0) {
            $sql = "insert into " . $this->table . " (`";
            $sql .= implode("`,`", array_keys($keys));
            $sql .= "`) values (";
            $sql .= implode(",", array_keys($data));
            $sql .= ")";
        } else {
            $sql = "update " . $this->table . " set ";
            foreach ($data as $key => $val) {
                $sqlParts[] = ltrim($key, ':')." = $key";
            }

            $data[":".$this->primaryKey] = $this->data[$this->primaryKey];

            $sql .= implode(", ", $sqlParts);
            $sql .= " where " . $this->primaryKey . " = :".$this->primaryKey;
        }

        $stm = $this->db->prepare($sql);

        if ($stm->execute($data)) {
            if ($this->data[$this->primaryKey] === 0) {
                $this->data[$this->primaryKey] = $this->db->lastInsertId();
            }
        }
    }


    public function setData($key, $value)
    {
        $this->data[$key] = $value;
        return $this->data[$key];
    }


    public function getData($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }
    }


}
