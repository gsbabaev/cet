<?php

include_once __DIR__."/../lib/safemysql.class.php";

class connectMySQL extends SafeMySQL{
    public function __construct()
    {
        $opts = [
            'user'    => 'u0168991_uaagg',
            'pass'    => 'Z2e9D1w7',
            'db'      => 'u0168991_aagg'
        ];
        parent::__construct($opts);
    }
}