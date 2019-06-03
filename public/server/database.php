<?php
    class Database{
        var $conn;
        function __construct($address,$user,$password,$database){
            $this->conn = new mysqli($address,$user,$password,$database) or die("数据库连接失败!");
            @$this->conn->query("set names utf8");
        }
        function select($col,$from,$else){
            $query = "select $col from $from";
            @ $query .= $else ? " $else" : "";
            return $this->conn->query($query);
        }
        function insert($table,$data){
            end($data);
            $key_last = key($data);

            $query = "insert into $table";
            $keys = "(";
            $values = "values(";
            
            foreach($data as $key => $value){
                $keys .= "`$key`";
                $values .= "$value";
                $symbol = $key === $key_last ? ")" : ",";
                $keys .= $symbol;
                $values .= $symbol;
            }
            
            $query.= " $keys $values";
            return $this->conn->query($query);
        }
        function del($from,$where){
            $query = "delete from $from where $where";
            return $this->conn->query($query);
        }
        function update($from,$else){
            $query = "update $from $else";
            return $this->conn->query($query);
        }
    }