<?php

function old($key, $value = null) {
    return isset($_POST[$key]) ? $_POST[$key] : $value;
}

function redirect($url) {
    header("Location: ".$url);
}

function humanDate($date) {
    return date("d.m.Y", strtotime($date));
}

function pcDate($date) {
    $exp = explode(".", $date);
    return $exp[2]."-".$exp[1]."-".$exp[0];
}