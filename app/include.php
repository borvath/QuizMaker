<?php
require_once 'config/config.php';
require_once 'helpers/auth.php';
require_once 'helpers/validation.php';

spl_autoload_register(function($className) {
    require_once 'base/'.$className.'.php';
});