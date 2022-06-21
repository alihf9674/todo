<?php

/**FOLDER FUNCTION **/
function deleteFolder($folder_id)
{
    global $pdo;
    $sql = "delete from folders where id=$folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function addFolder($folder_name)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "INSERT INTO folders (name,user_id) VALUES (:folder_name,:user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':folder_name'=>$folder_name,':user_id'=>$currentUserId));
    return $stmt->rowCount();
}

function doneSwitch ($task_id)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "UPDATE tasks SET is_done = 1 - is_done where user_id=:userID AND id=:taskID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':taskID'=>$task_id,':userID'=>$currentUserId));
    return $stmt->rowCount();
}

function getFolder()
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "select * from folders where user_id = $currentUserId ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

/**TASK FUNCTIONS **/
function getTasks()
{
    global $pdo;
    $folder = $_GET['folder_id'] ?? null;
    $folderCondition = '';
    if (isset($folder) and is_numeric($folder)) {
        $folderCondition = " and folder_id=$folder";
    }
    $currentUserId = getCurrentUserId();
    $sql = "select * from tasks where user_id = $currentUserId $folderCondition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records;
}

function addTask($taskTitle,$folderId)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "INSERT INTO tasks (title,user_id,folder_id) VALUES (:title,:user_id,:folder_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':title'=>$taskTitle,':user_id'=>$currentUserId,':folder_id'=>$folderId));
    return $stmt->rowCount();
}

function deleteTask($task_id)
{
    global $pdo;
    $sql = "delete from tasks where id = $task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}
