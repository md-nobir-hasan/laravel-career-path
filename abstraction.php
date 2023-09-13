<?php

abstract class vehicle{
    abstract public function base_fare():int;
    abstract public function perkilo_fare():int;

    public function total_fare(int $kilo):int 
    {
       return $this->base_fare()+($this->perkilo_fare()*$kilo);
    }
}

class bike extends vehicle{
    public function base_fare(): int
    {
        return 20;
    }
    public function perkilo_fare(): int
    {
        return 5;
    }
}

$bike = new bike();
var_dump($bike->total_fare(kilo:10));