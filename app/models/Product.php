<?php

namespace MVC\models;

class Product extends AbstractClass
{

    protected $tableName = "products";

    protected $sku;
    protected $name;
    protected $price;

    protected $switcher;

    protected $size;

    protected $weight;

    protected $height;

    protected $width;

    protected $length;

    protected $switchers = [
        'DVD',
        'Book',
        'Furniture',
    ];

    protected $value;
    protected $errors = [];
    protected $db_fields = [
        'sku',
        'name',
        'price',
        'switcher',
        'weight',
        'size',
        'height',
        'width',
        'length'
    ];

    public function validateProduct()
    {
        return $this->errors;
    }
    public function getProducts()
    {
        return $this->display($this->tableName,"ORDER BY `id` ASC");
    }

    public function skuExists($sku) {
        $result = $this->db->query("SELECT COUNT(*) AS count FROM " . $this->tableName . " WHERE sku = '$sku'");
        $row = $result->fetch_assoc();
        if ($row['count'] > 0) {
            return true;
        }
        return false;
    }

    public function setSku($sku) {
        if (!$this->validateEmpty($sku))
        {
            $this->errors["sku"] = "Please, provide sku";
        } elseif ($this->skuExists($sku)) {
            $this->errors["sku"] = "This SKU already exists.";
        } else {
            $this->sku = $sku;
        }
    }

    public function getSku() {
        return $this->sku;
    }

    public function setName($name) {
        if (!$this->validateEmpty($name))
        {
            $this->errors["name"] = "Please, provide name";
        }
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setPrice($price) {
        if (!$this->validateEmpty($price))
        {
            $this->errors["price"] = "Please, provide price";
        }
        $this->price = $price;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setSwitcher($switcher)
    {
        if (!$this->validateEmpty($switcher))
        {
            return $this->errors["switcher"] = "Please, provide Switcher";
        } elseif(in_array($switcher, $this->switchers)) {
            return $this->switcher = $switcher;
        } else {
            return $this->errors["switcher"] = "Invalid switcher value";
        }
    }

    public function getSwitcher()
    {
        return $this->switcher;
    }

    public function setSize($size)
    {
        if (!$this->validateEmpty($size))
        {
            $this->errors["size"] = "Please, provide size";
        }
        return $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setWeight($weight)
    {
        if (!$this->validateEmpty($weight))
        {
            $this->errors["weight"] = "Please, provide weight";
        }
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setHeight($height)
    {
        if (!$this->validateEmpty($height)) {
            $this->errors["height"] = "Height cannot be empty";
        }
        $this->height = $height;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setWidth($width)
    {
        if (!$this->validateEmpty($width)) {
            $this->errors["width"] = "Width cannot be empty";
        }
        $this->width = $width;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setLength($length)
    {
        if (!$this->validateEmpty($length)) {
            $this->errors["length"] = "Length cannot be empty";
        }
        $this->length = $length;
    }

    public function getLength()
    {
        return $this->length;
    }

    private function validateEmpty($value)
    {
        return !empty($value);
    }

    private function addError($key, $value)
    {
        $this->errors[$key] = $value;
    }
}