<?php

use function PHPSTORM_META\type;

class Car
{
    public $name = 'Nobir';
    public $age = 25;
    private $profession = 'farmer';

    private function life()
    {
        return 'okk';
    }
    public function familly()
    {
        echo 'okk';
    }
}

$arry = [
    'name' => "nobir",
    'age'=>24,
    "an"=>[
        'name' => 'Anawar',
        'age'=>26
    ]
];
$familly = function ()
    {
        return 'nobir';
    };
function familly()
    {
        return 'nobir';
    };
   echo gettype(familly()) . "\n"; //return na korle type null dekhaibe
   echo gettype($familly) . "\n";
   var_dump($familly);
$obj1 = new Car;
$obj2 = new Car;
$objtoarray= (array) $obj2;
$arraytoobj= (object) $arry;
// var_dump($arraytoobj->an['name']);
