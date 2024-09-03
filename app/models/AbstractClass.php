<?php

namespace MVC\models;

use MVC\core\Database;

Abstract class AbstractClass
{
    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    private function attributes()
    {
        $string = [];
        foreach ($this->db_fields as $field) {
            if (is_int($this->$field) || is_double($this->$field))
            {
                $string[] = $field . " = " . $this->$field;
            } elseif (strlen($this->$field) > 0) {
                $string[] = $field . " = '" . $this->$field . "'";
            }
        }
        return implode(",",$string);
    }

    public function insert()
    {
        $this->db->query("INSERT INTO " . $this->tableName . " SET " . $this->attributes());
        if ($this->db->affected_rows > 0) {
            return true;
        }
        return false;
    }

    public function display($table,$extra='')
    {
        $result = $this->db->query("SELECT * FROM $table $extra");
        if ($result && $result->num_rows > 0)
        {
            $data = [];
            while ($row = $result->fetch_assoc())
            {
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }

    public function Delete($sku) {
        $this->db->query("DELETE FROM $this->tableName WHERE `sku`='$sku'");
        if ($this->db->affected_rows > 0)
        {
            return true;
        }
        return false;
    }

}