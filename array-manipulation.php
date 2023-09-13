<?php
$fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");

function test_alter(&$value, $key, $prefix)
{
    $value = "$prefix: $value";
}

function test_print($item2, $key)
{
    echo "$key. $item2\n";
}
$transport = array('foot', 'bike', 'car', 'plane');

// $prev = prev($transport);
$next = next($transport);
$next2 = next($transport);
$crrent  = current($transport);
//  echo end($fruits);

var_dump($crrent);