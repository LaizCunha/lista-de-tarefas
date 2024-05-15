<?php

header('Content-Type: application/json');

session_start();
$user = $_SESSION['user'];
if (!isset($user)) {
  header('Location: index.html');
  exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  $response = array('success' => false, 'error' => 'Método de requisição inválido');
  echo json_encode($response);
  exit;
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$databaseFile = 'users.json';
$users = json_decode(file_get_contents($databaseFile), true);
$userFound = false;
foreach ($users as &$usr) {
  if ($usr['username'] === $user['username']) {
      $usr['tasks'][] = $data['description'];
      $userFound = true;
      $_SESSION['user'] = $usr;
      break;
  }
}

file_put_contents($databaseFile, json_encode($users));

if (!$userFound) {
  $response = array('success' => false, 'error' => 'Usuário não encontrado');
  echo json_encode($response);
  exit;
}

file_put_contents($databaseFile, json_encode($users, JSON_PRETTY_PRINT));

$response = array('success' => true);
echo json_encode($response);
exit;

?>