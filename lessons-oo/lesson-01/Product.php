<?php
class Product{
    // Properties
    public $id;
    public $image;
    public $name; 
    public $price; 

    // Construct Method
    function __construct($id, $image, $name, $price){
        $this->id = $id;
        $this->image = $image;
        $this->name = $name;
        $this->price = $price;
    }

    // Methods (Functions)
    function setName($name){
        $this->name = $name;
    }

    function getName(){
        echo $this->name;
    }

    function setPrice($price){
        $this->price = $price;
    }

    function getPrice(){
        echo $this->price;
    }
}
?>