<?php
function getCurrentUserId()
{
    // get login user id
    return getloggedInUser()->id ?? 0 ;
}

function isLoggedIn()
{

    return isset($_SESSION['login']) ? true : false;
}

function getloggedInUser()
{
    return $_SESSION['login'] ?? null;
}

function register($userData)
{
    global $pdo;
    $passHash = password_hash($userData['password'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (name,email,password) VALUES (:name,:email,:pass)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':name' => $userData['name'], ':email' => $userData['email'], ':pass' => $passHash));
    return $stmt->rowCount() ? true : false;
}

function getUserByEmail($email)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records[0] ?? null;
}

function logOut()
{
    unset($_SESSION['login']);
}

function login($email, $pass)
{
    $user = getUserByEmail($email);
    if (is_null($user)) {
        return false;
    }
    if (password_verify($pass, $user->password)) {
        $user->image = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->email ) ) ) ;
        $_SESSION['login'] = $user;
        return true;
    }
    return false;
}
