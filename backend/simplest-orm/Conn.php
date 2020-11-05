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

class Conn extends PDO {
    private static $instance;
    protected $dbName;

    function __construct() {
        $conf = json_decode(file_get_contents(dirname(__FILE__) . '/config.json'), true);
        $dsn = self::template($conf['DSN'], $conf);
        parent::__construct($dsn, $conf['user'], $conf['password']);
        $this->dbName = $conf["db"];
        $this->exec("SET CHARACTER SET utf8");
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected static function template($str, $arr) {
        foreach ($arr as $key => $value) {
            if (is_array($value)) continue;
            $str = str_replace('{{' . $key . '}}', $value, $str);
        }

        return $str;
    }

    public function fetchTableData($table, $field = null, $values = null, $operator = "=", $orderby = array(), $invert = false, $limit = false, $fields = "*") {
        $where = array();

        if (!is_array($values)) {
            $values = array($values);
        }

        foreach ($values as $i => $value) {
            if ($value !== null && $field !== '') {
                $filter = array();

                if ($invert) {
                    $filter['query'] = "? $operator $field";
                } else {
                    $filter['query'] = "$field $operator ?";
                }
                $filter['param'] = $value;

                array_push($where, $filter);
            }
        }

        return $this->fetchTableDataF($table, $where, $orderby, $limit, $fields);
    }

    public function fetchTableDataF($table, $filter = array(), $orderby = array(), $limit = false, $andOr = "AND", $fields = "*") {
        $param = array();
        $where = array();

        foreach ($filter as $key => $value) {
            array_push($param, $value['param']);
            array_push($where, $value['query']);
        }

        $where = implode(" $andOr ", $where);
        if (strlen(trim($where)) > 0) $where = "WHERE $where";
        

        if ($limit !== false) {
            $limit = (int) $limit;
            $limit = "LIMIT $limit";
        }

        if (is_array($orderby)) {
            $orderby = implode(', ', array_filter($orderby));
            if (strlen(trim($orderby)) > 0) {
                $orderby = "ORDER BY $orderby";
            }
        } else {
            $orderby = '';
        }

        $sql = "SELECT $fields FROM `$table` $where $orderby $limit";

        return $this->getSQLArray($sql, $param);
    }

    public function fetchSimpleData($table, $options = array()) {
        $list = array();
        $list["filter"] = array();
        $list["orderby"] = array();
        $list["limit"] = false;
        $list["andOr"] = "AND";
        $list["fields"] = '*';

        foreach ($options as $key => $value) {
            if (isset($list[$key])) {
                $list[$key] = $value;
            }
        }

        $result = $this->fetchTableDataF($table, $list["filter"], $list["orderby"], $list["limit"], $list["andOr"], $list["fields"]);

        return $result;
    }

    public function assembleFilter($values, $operator = "=") {
        $result = array();

        $isContaining = ($operator == "CONTAINING");

        foreach ($values as $key => $value) {
            if ($isContaining) {
                $op = "LIKE";
                $value = "%$value%";
            } else {
                $op = $operator;
            }

            array_push($result, array(
                "query" => "$key $op ?",
                "param" => $value
            ));
        }

        return $result;
    }

    public function fetchTableMeta($table) {
        $sql =
        "SELECT
            COLUMN_NAME,
            DATA_TYPE
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE
            TABLE_NAME = ?
        AND TABLE_SCHEMA = ?
        ";

        $array = $this->getSQLArray($sql, array($table, $this->dbName));

        $result = array();

        foreach ($array as $value) {
            $result[$value['COLUMN_NAME']] = $value['DATA_TYPE'];
        }

        return $result;
    }

    public function fetchTablePK($table) {
        $sql =
        "SELECT DISTINCT
            COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE
            TABLE_NAME = ?
        AND TABLE_SCHEMA = ?
        AND COLUMN_KEY =  'PRI'
        ";

        $array = $this->getSQLArray($sql, array($table, $this->dbName));

        return $array[0]["COLUMN_NAME"];
    }

    public function getSQLArray($sql, $param = array()) {
        $result = array();

        $stmt = $this->prepare($sql);

        if (!$stmt->execute($param)) return $result;

        while ($row = $stmt->fetch(parent::FETCH_ASSOC)) {
            array_push($result, $row);
        }

        return $result;
    }

    public function executeSQL($sql, $param = array()) {
        $stmt = $this->prepare($sql);

        if (!$stmt->execute($param)) {
            $err = $stmt->errorInfo();
            throw new Exception($err[2], (int) $err[0]);
            return false;
        }

        return true;
    }

    public function runInsert($sql, $param = array()) {
        $result = false;

        $this->beginTransaction();
        $stmt = $this->prepare($sql);

        if ($stmt->execute($param)) {
            $result = $this->lastInsertId();
            $this->commit();
        } else {
            $err = $stmt->errorInfo();
            $this->rollBack();
            throw new Exception($err[2], $err[0]);
        }

        return $result;
    }
}
