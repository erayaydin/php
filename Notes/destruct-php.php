<?php

class c
{
    public function __destruct()
    {
        new c();
    }
}
new c();
