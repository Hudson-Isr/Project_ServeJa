<?php

@include('PHP/Start.php');

$sql = 'INSERT INTO pessoa (nome, email, senha) VALUES (?,?,?)';
$pessoaDAO = new PessoaDAO();
$pessoa = new Pessoa();
$bd = Conexao::getConn()->prepare($sql);

if (isset($_POST['criar_cliente'])) {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $pessoa->setNome($nome);
  $pessoa->setEmail($email);
  $pessoa->setSenha($senha);
          
  $pessoaDAO->create($pessoa);

  session_start();
  $_SESSION['nome'] = $nome;
  $_SESSION['email'] = $email;

  header("location: /serveja/client/client-index.php?id=$nome");
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/normalize.css">

  <title>Login</title>
</head>

<body>
  <div class="conteiner">
    <div class="logo-page">
      <img src="imagens/Hamburger.gif" alt="Imagem Hamburguer">
    </div>
    <div class="left-row">
      <div class="top">
        <h2>Olá! Seja bem-vindo</h1>
          <h4>ao <strong><span class="emp">ServeJá!</span></strong></h4>
      </div>
      <div class="test">
        <form action="" method="POST" autocomplete="off">
          <label for="nome">Nome:</label>
          <input type="text" onchange="this.value = this.value.trim()" placeholder="Digite seu nome." name="nome" required />
          <label for="E-mail">E-mail:</label>
          <input type="email" onchange="this.value = this.value.trim()" placeholder="Digite seu e-mail." name="email" required />
          <label for="Password">Senha:</label>
          <input type="password" onchange="this.value = this.value.trim()" placeholder="Digite sua senha." name="senha" required />
          <button type="submit" name="criar_cliente">Entrar</button>
        </form>
      </div>
      <div class="Cadastrar-se">
        <a href="cadastro.php">Ainda não possui uma conta? Cadastrar-se</a>
      </div>
    </div>
  </div>
  </div>
</body>
</html>