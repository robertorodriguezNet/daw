<?php 

class Rectangulo{

    public $base;

    public $altura;

    public function getArea():int{
        return $this->base * $this->altura;
    }

}