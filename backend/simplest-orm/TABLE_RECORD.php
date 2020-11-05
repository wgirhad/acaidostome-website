<?php

/*
 * The MIT License (MIT)
 * 
 * Copyright (c) 2015 Willian Girhad
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

class TABLE_RECORD implements Iterator {
    protected $data;
    protected $columns;
    protected $primaryKey;
    protected $table;
    protected $conn;

    function __construct($table, $data = null) {
        $this->conn = Conn::getInstance();
        $this->table = $table;
        $this->columns    = $this->conn->fetchTableMeta($table);
        $this->primaryKey = $this->conn->fetchTablePK($table);
        
        if ($data === null) {
            $data = array();
            foreach ($this->columns as $field => $value) {
                $data[$field] = null;
            }
        }

        $this->data = $data;
    }

    function __set($key, $value) {
        $this->data[$key] = $value;
    }

    function __get($key) {
        return $this->data[$key];
    }

    function getTable() {
        return $this->table;
    }

    function toArray() {
        return $this->data;
    }
    
    function post() {
        return $this->shouldInsert()? $this->insert(): $this->update();
    }

    function insert() {
        $this->stripInexistentFields();
        $this->dealWithPKOnInsert();

        $param = $this->assembleInsertQuery();

        return $this->parseResult($param[0], $param[1], true);
    }

    function update() {
        $this->stripInexistentFields();
        $param = $this->assembleUpdateQuery();
        
        return $this->parseResult($param[0], $param[1]);
    }

    function delete() {
        $this->stripInexistentFields();
        $param = $this->assembleDeleteQuery();
        
        return $this->parseResult($param[0], $param[1]);
    }

    protected function parseResult($sql, $param, $insert = false) {
        $result = array();

        try {
            if ($insert) {
                $this->data[$this->primaryKey] = $this->conn->runInsert($sql, $param);
                $result["status"] = true;
            } else {
                $result["status"] = $this->conn->executeSQL($sql, $param);
            }
        } catch (Exception $e) {
            $result["status"] = false;
            $result["error"]  = $e->getMessage();
        }

        return $result;
    }

    protected function assembleDeleteQuery() {
        $param = array($this->data[$this->primaryKey]);
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = ?";

        return array($sql, $param);
    }

    protected function assembleInsertQuery() {
        $into  = array_keys($this->data);
        $param = array_values($this->data);

        $values = trim(str_repeat('?,', count($param)), ',');
        $into = implode(', ', $into);

        $sql = "INSERT INTO $this->table($into) VALUES($values)";

        return array($sql, $param);
    }

    protected function assembleUpdateQuery() {
        $set = array();

        foreach ($this->data as $key => $value) {
            array_push($set, "$key = ?");
        }

        $set = implode(', ', $set);
        $param = array_values($this->data);

        array_push($param, $this->data[$this->primaryKey]);

        $sql = "UPDATE $this->table SET $set WHERE $this->primaryKey = ?";

        return array($sql, $param);
    }

    protected function dealWithPKOnInsert() {
        $primaryKey = isset($this->data[$this->primaryKey])? $this->data[$this->primaryKey]: "";

        if (strlen($primaryKey) == 0 || $primaryKey === 0) {
            unset($this->data[$this->primaryKey]);
        }
    }

    protected function shouldInsert() {
        return ($this->data[$this->primaryKey] == 0 || strlen($this->data[$this->primaryKey]) == 0);
    }

    protected function stripInexistentFields() {
        $this->data = array_intersect_key($this->data, $this->columns);
    }

    public static function fetch($table, $idValue, $field = "ID") {
        $result = array();

        $rows = Conn::getInstance()->fetchTableData($table, $field, $idValue);

        foreach ($rows as $row) {
            array_push($result, new self($table, $row));
        }

        if (count($result) > 0) {
            return $result[0];
        } else {
            return false;
        }
    }

    public static function indexResultSet($set, $indexField = "ID") {
        $result = array();

        foreach ($set as $row) {
            $id = $row[$indexField];

            $result[$id] = $row;
        }

        return $result;
    }

    public static function fetchList($table, $idList, $field = "ID") {
        $result = array();
        $filter = array();

        // You may send a simple variable as parameter
        if (!is_array($idList)) {
            $idList = array($idList);
        }

        foreach ($idList as $id) {
            array_push($filter, array(
                "query"   => "$field = ?",
                "param"   => $id
            ));
        }

        $rows = Conn::getInstance()->fetchSimpleData($table, array(
            "andOr"   => "OR",
            "orderby" => array($field),
            "filter"  => $filter
        ));

        foreach ($rows as $row) {
            array_push($result, new self($table, $row));
        }

        return $result;
    }

    /**
     * Iterator Methods
     */
    public function rewind() {
        return reset($this->data);
    }

    public function current() {
        return current($this->data);
    }

    public function key() {
        return key($this->data);
    }

    public function next() {
        return next($this->data);
    }

    public function valid() {
        return key($this->data) !== null;
    }
}
