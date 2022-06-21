<?php

include 'bootstrap/init.php';

$home_url = site_url();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_GET['action'];
    $params = $_POST;
    if ($action == 'register') {
        $result = register($params);
        if (!$result) {
            massage("Error:an Error in Registration!");
        } else {
            massage("Registration is successful. Wellcome to 7Todo.<br>
             <a href= '{$home_url}auth.php'>Please Login</a>", 'success');
        }
    } elseif ($action == 'login') {
        $result = login($params['email'], $params['password']);
        if (!$result) {
            massage("Error:Email or Password is incorrect!");
        } else {
            // massage(" You are Logged in now.<br>
            // <a href= '$home_url'> Manage your tasks..</a>",'success');
            redirect(site_url());
        }
    }
}

include 'tpl/tpl-auth.php';
