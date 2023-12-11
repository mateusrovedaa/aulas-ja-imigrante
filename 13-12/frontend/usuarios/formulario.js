const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('id');

let inputNome = document.getElementById('nome');
let inputEmail = document.getElementById('email');
let form = document.getElementById('formulario');

async function buscarDados () {
  let resposta = await fetch('http://localhost:8000/usuarios/' + id);
  if (resposta.ok) {
    let usuario = await resposta.json();
    inputNome.value = usuario.nome;
    inputEmail.value = usuario.email;
  } else {
    alert('Ops! Algo deu errado!');
  }
}

// Está editando
if (id) {
  buscarDados();
}

form.addEventListener('submit', async (event) => {
  event.stopPropagation();
  event.preventDefault();

  let nome = inputNome.value;
  let email = inputEmail.value;

  let payload = {
    nome,
    email,
  }

  let url = 'http://localhost:8000/usuarios';
  let method = 'POST';
  if (id) {
    url += '/' + id;
    method = 'PUT';
  }

  let resposta = await fetch(url, {
    method: method,
    headers: {
      'Content-type': 'application/json',
      'Accept': 'application/json'
    },
    body: JSON.stringify(payload)
  });

  if (resposta.ok) {
    window.location.href = 'index.html'
  } else {
    alert('Ops! Algo deu errado!');
  }
});