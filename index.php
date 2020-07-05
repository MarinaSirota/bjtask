<?php
ini_set('default_charset', 'utf-8');
require 'app/core/router.php';
session_start(
    [
        'cookie_lifetime' => 864000
    ]
);
Router::route();