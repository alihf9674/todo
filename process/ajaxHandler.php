<?php
include_once '../bootstrap/init.php';

if (!isAjaxRequest()) {
    diePage("Inavalid Request!");
}

if (!isset($_POST['action']) || empty($_POST['action'])) {
    diePage("Invalid Action!");
}

switch ($_POST['action']) {
    case "doneSwitch":
        $task_id = $_POST['taskId'];
        dd($task_id);
         if(!isset($task_id) || !is_numeric($task_id)) {
            echo ".آیدی تسک معتبر نیست";
            die();
        }
        doneSwitch($task_id);
        break;
    case "addFolder":
        if (!isset($_POST['folderName']) || strlen($_POST['folderName']) < 3) {
            echo ".نام پوشه باید بزرگتر از ۲ باشد";
            die();
        }
        echo addFolder($_POST['folderName']);
        break;
    case "addTask":
        // var_dump("New task added :",$_POST);
        $folderId = $_POST['folderId'];
        $taskTitle = $_POST['taskTitle'];
        if (!isset($folderId) || empty($folderId)) {
            echo ".پوشه را انتخاب کنید";
            die();
        }
        if (!isset($taskTitle) || strlen($taskTitle) < 3) {
            echo ".عنوان تسک باید بزرگتر از ۲ حرف باشد";
            die();
        }
        echo addTask($taskTitle,$folderId);
        break;

    default:
        diePage("Invalid Action!");
}
