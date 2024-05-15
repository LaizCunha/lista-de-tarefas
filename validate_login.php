<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; 
    $password = $_POST['password'];

    $users = json_decode(file_get_contents('users.json'), true);

    $userFound = null;
    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $userFound = $user;
            break;
        }
    }

    if ($userFound) {
        $_SESSION['user'] = $userFound;
        header("Location: home.php");
        exit();
    } else {
        echo "Usuário ou senha inválidos. Por favor, tente novamente.";
    }
}
?>
