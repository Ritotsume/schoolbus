<?php

ob_start();
session_cache_expire(30);
session_start();
include_once './app/Config.inc.php';
include_once './header.php';
include_once './sidebar.php';
include_once './content.php';
ob_flush();
