// Adicionar nova task

const addTaskBtn = document.getElementById('add-task-btn');
const taskList = document.getElementById('taskList');
const noTask = document.getElementById('noTask');

addTaskBtn.addEventListener('click', async () => {

  const taskTitle = prompt('Digite o título de sua tarefa: (máx 25 caracteres)');
  
  if (taskTitle !== null && taskTitle.trim() !== '') {
    const response = await fetch('create_task.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ description: taskTitle }),
    });
    console.log('Resposta do servidor:', response);
        
    if (!response.ok) {
      throw new Error('Erro ao adicionar tarefa' + response.status);
    }
    const contentType = response.headers.get('content-type');
    if (!contentType || !contentType.includes('application/json')) {
      throw new Error('Resposta não está no formato JSON');
    }

    const data = await response.json();
    console.log('Tarefa adicionada com sucesso:', data);

    const taskItem = document.createElement('li');
    taskItem.classList.add('task-item');
    taskItem.innerHTML =
      `
      <div class="task-card">
        <span class="task-type"></span>
        <h4 class="task-title">${taskTitle}</h4>
        <div class="controlers">
          <input type="checkbox" id="myCheckbox">
          <button class="edit-btn"><i class="fas fa-edit"></i></button>
          <button class="delete-btn"><i class="fas fa-trash-alt"></i></button>
        </div>
      </div>
    `;

    taskList.appendChild(taskItem);

  if(noTask && taskList.children.length > 0) {
    noTask.style.display = 'none';
  }

  // Concluir task

  const completeTask = taskItem.querySelector('#myCheckbox')
  completeTask.addEventListener("change", function() {
    const taskTitleElement = taskItem.querySelector('.task-title');
    if(this.checked) {
      taskTitleElement.style.textDecoration = 'line-through';
      taskItem.style.backgroundColor = '#9aee9d';
    } else {
      taskTitleElement.style.textDecoration = 'none';
      taskItem.style.backgroundColor = 'initial';
    }
  })

  // Editar título da task

  const editTitle = taskItem.querySelector('.edit-btn');
  editTitle.addEventListener('click', function() {
    newTaskTitle = prompt('Digite o título de sua tarefa: (máx 25 caracteres)');
    const taskTitleElement = taskItem.querySelector('.task-title');
    taskTitleElement.textContent = newTaskTitle;
  });

  // Excluir task

  const deleteTask = taskItem.querySelector('.delete-btn');
  deleteTask.addEventListener('click', function() {
  const confirmDeleteTask = confirm('Deseja deletar tarefa?');
    if(confirmDeleteTask == true) {
      taskItem.remove();
    }
  });
}
});

// Alterar avatar

const avatar = document.getElementById('avatar');
const avatarInput = document.getElementById('avatarInput');

avatar.addEventListener('click', function() {
  avatarInput.click();
});

avatarInput.addEventListener('change', function() {
  if(avatarInput.files && avatarInput.files[0]) {
    const file = new FileReader();
    file.onload = function(e) {
      avatar.src = e.target.result;
    };
    file.readAsDataURL(avatarInput.files[0]);
  };
});
