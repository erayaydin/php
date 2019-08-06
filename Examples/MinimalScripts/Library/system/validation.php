<?php

class Validation
{
    public static function valid($fields) {

        $errors = [];

        foreach($fields as $key => $check) {
            if($check['check'] == "required"){
                if($_POST[$key] != "0"){
                    if(!isset($_POST[$key]) || empty($_POST[$key]))
                        $errors[] = "Lütfen ".$check["text"]." alanını doldurunuz.";
                }
            }
        }

        return $errors;

    }
}