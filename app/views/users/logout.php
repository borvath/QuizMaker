<?php
    require_once '../../include.php';
    require_once '../../controllers/Users.php';

    Auth::RequireLogin();
    $user = new Users;
    $user->Logout();
?>