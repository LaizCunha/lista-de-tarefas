<?php 
session_start();
$user = $_SESSION['user'];
if (!isset($user)) {
  header('Location: index.html');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="style-home.css">
  <link rel="icon" href="/public/favicon.png">
  <script defer src="script-home.js"></script>
  <title>Lista de Tarefas</title>
</head>
<body>
  <header>
    <nav class="navbar">
      <img src="/Front/public/avatar.png" alt="Avatar" class="avatar" id="avatar">
      <input type="file" id="avatarInput" style="display: none;">
      <button onclick="location.href='index.html'" class="home-btn">Sair</button>
    </nav>
    <div class="welcome">
      <h1>Olá, <span id="name"><?php echo $user['name']; ?></span>!</h1>
      <span>Confira suas tarefas disponíveis.</span>
    </div>
  </header>
  <main>
    <div class="title">
      <h3>Tarefas</h>
    </div>
    <ul id="taskList">
      <?php 
        foreach ($user['tasks'] as $task) {
      ?>
      <li class="task-item">
        <div class="task-card">
          <span class="task-type"></span>
          <h4 class="task-title"><?php echo $task;?></h4>
          <div class="controlers">
            <input type="checkbox" id="myCheckbox">
            <button class="edit-btn"><i class="fas fa-edit"></i></button>
            <button class="delete-btn"><i class="fas fa-trash-alt"></i></button>
          </div>
        </div>
      </li>
      <?php
        }
      ?>
    </ul>
    <?php if (sizeof($user['tasks']) == 0 ) { ?>
    <p id="noTask">Você não possui nenhuma tarefa cadastrada.</p>
     <?php } ?>
  </main> 
  <footer>
    <button class="add-task-btn" id="add-task-btn"><i class="fas fa-plus"></i></button>
  </footer>  
</body>
</html>