<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];


    if (empty($name) || empty($username) || empty($password)) {

        echo "Por favor, preencha todos os campos.";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $user = array(
        'name' => $name,
        'username' => $username,
        'password' => $hashedPassword,
        'tasks' => []
    );

    $users = json_decode(file_get_contents('users.json'), true);

    if ($users === null) {
        $users = array();
    }

    $users[] = $user;


    if (file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT))) {
        echo "Novo usuário cadastrado com sucesso!";
        header("Location: index.html");
    } else {
        echo "Erro ao cadastrar novo usuário.";
    }
}
?>
