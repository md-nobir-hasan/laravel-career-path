<?php

function str_alpha_count($text)
{
    $count = 0;
    for (
        $i = 0;
        $i < strlen($text);
        $i++
    ) {
        if (ctype_alpha($text[$i])) {
            $count++;
        }
    }
    return $count;
}