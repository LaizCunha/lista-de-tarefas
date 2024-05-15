function handleRegisterFormSubmit(event) {
    event.preventDefault();
  
    const registerForm = document.getElementById('registerForm');
    const formData = new FormData(registerForm);
  
    fetch('create_user.php', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Erro ao cadastrar usuário');
      }
      return response.json();
    })
    .then(data => {
      console.log('Usuário cadastrado com sucesso:', data);
      localStorage.setItem('name', data.name);
      window.location.href = 'home.php';
    })
    .catch(error => {
      console.error('Erro ao cadastrar usuário:', error.message);
      alert('Erro ao cadastrar usuário. Tente novamente.');
    });
  }