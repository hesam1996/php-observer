<?php

use Config\DBConnection;

session_start();

require_once __DIR__ . '/Config/app.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/Config/DBConnection.php';

new DBConnection();

