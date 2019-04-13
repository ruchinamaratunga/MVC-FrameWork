<?php

/**
 * dump and die 
 * use to debug
 * organized the structure of things we want to dump
 */

function dnd($data) {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function sanitize($dirty) {
    return htmlentities($dirty,ENT_QUOTES, 'UTF-8' );
}

function currentUser() {
    return Users::currentLoggedInUser();
}

