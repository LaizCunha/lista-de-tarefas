
function handleFormSubmit(event) {
  event.preventDefault();
  
  const loginForm = document.getElementById('loginForm');
  const formData = new FormData(loginForm);

  fetch('validate_login.php', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Erro ao fazer login');
    }
    return response.json();
  })
  .then(data => {
    console.log('Login bem-sucedido:', data);
    localStorage.setItem('name', data.name);
    window.location.href = 'home.php';
  })
  .catch(error => {
    console.error('Erro ao fazer login:', error.message);
    alert('Usuário ou senha inválidos.');
  });
}
