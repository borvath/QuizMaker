<?php
    require_once '../../include.php';
    require_once '../../controllers/Users.php';

    $user = new Users;
    $user->UserLoggedIn();