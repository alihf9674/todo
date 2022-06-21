<?php

#connect to dataBase
include 'bootstrap/init.php';
// use Hekmatinasser\Verta\Verta;
// var_dump(verta::now());

if (isset($_GET['logout'])) {
     logOut();
}
if (!isLoggedIn()) {   
    redirect(site_url('auth.php'));
}

$user = getloggedInUser();

if (isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])) {
    $deletedCount = deleteFolder($_GET['delete_folder']);
    // echo "$deletedCount folder succesfully deleted!";
}

if (isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])) {
    $deletedCount = deleteTask($_GET['delete_task']);
}

$folders = getFolder();

$tasks = getTasks();

include 'tpl/tpl-index.php';
