<?php
session_start();
require_once 'classes/User.php';
require_once 'classes/Validation.php';
require_once 'classes/DB.php';
require_once 'classes/Config.php';
require_once 'classes/Historique.php';
require_once 'classes/Content.php';
Historique::addURL();