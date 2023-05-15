<?php

include('PHP/Config.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {
      $email = $mysqli->real_escape_string($_POST['email']);
      $senha = $mysqli->real_escape_string($_POST['senha']);

      $sql_code = "SELECT * FROM login WHERE email = '$email' AND senha = '$senha'";
      $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

      $quantidade = $sql_query->num_rows;

      if($quantidade == 1) {
          
          $usuario = $sql_query->fetch_assoc();

          if(!isset($_SESSION)) {
              session_start();
          }

          $_SESSION['id'] = $usuario['id'];
          $_SESSION['nome'] = $usuario['nome'];

          header("Location: index.php");
  }
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
          <form action="" method="POST">
            <label for="E-mail">E-mail:</label>
            <input type="email" placeholder="Digite seu e-mail." name="email" required/>
            <label for="Password">Senha:</label>
            <input type="password" placeholder="Digite sua senha." name="senha" required/>
            <button type="submit">Entrar</button>
          </form>
        <div class="Cadastrar-se">
          <a href="/login/Cadastro.html">Ainda não possui uma conta? Cadastrar-se</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>