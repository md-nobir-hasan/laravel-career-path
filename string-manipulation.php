<?php

// echo chr(334); //output: N

$str ="I am a string but not a sentence or word, I am with only letter. Welcome";
$split =  chunk_split($str,20);
// echo ($str,2);
// var_dump($split);
$cchar = count_chars($str);
echo count($cchar);
// var_dump($cchar);

