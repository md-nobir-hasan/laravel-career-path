<?php
class TypeClass {
    public $name; 
    static public $age = 24; 
    static public function profile(){
        return 'nosto anawar';
    }
}

$arr = [
    'name' => 'nobir',
    'name' => 'nobir',
    'name' => 'nobir',
];

$typeObj = new TypeClass;
$objtoarry = (array) $typeObj;
$arrytoobj = (object) $arr;
var_dump((string) $typeObj);