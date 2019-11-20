<?php

class Perfil
{
    public $nombre;
    public $mac;

    function __construct($nombre, $mac)
    {
        $this->nombre = $nombre;
        $this->mac = $mac;
    }
}