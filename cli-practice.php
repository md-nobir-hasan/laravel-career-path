<?php

$inputs = getopt('',['max::','min::']);

$max = (int) ($inputs['max'] ?? 100);
$min = (int) ($inputs['min'] ?? 1);
$no = rand($min, $max);
while(true){
    $guess_nu = readline('Guess a number:');
    if($guess_nu>$no){
        printf("enter a small number \n");
    }elseif($guess_nu<$no){
        printf("enter a large number \n");
    }else{
        printf('Your guess is write. you are the winner');
        break;
    }
}