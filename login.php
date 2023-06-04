<?php

@include('PHP/Start.php');

if (isset($_POST['email']) || isset($_POST['senha'])) {
  
  $conexao = Conexao::getConn(); //puxando a class Conexao;
  $sql_code = "SELECT * FROM pessoa WHERE email = :email AND senha = :senha"; //Realizando a verificação dos campos no banco;
  $sql_query = $conexao->prepare($sql_code);
  $sql_query->bindParam(':email', $_POST['email']); //Verificaçao por parametro;
  $sql_query->bindParam(':senha', $_POST['senha']);

  $sql_query->execute();
  $quantidade = $sql_query->rowCount();

  if ($quantidade == 1) {
    $usuario = $sql_query->fetch(PDO::FETCH_ASSOC);

    if (!isset($_SESSION)) {
      session_start();
    }

    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['email'] = $usuario['email'];

    header("location: /serveja/client/client-index.php");
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
      <form action="" method="POST" autocomplete="OFF">
        <label for="E-mail">E-mail:</label>
        <input type="email" placeholder="Digite seu e-mail." name="email" required />
        <label for="senha">Senha:</label>
        <input type="password" placeholder="Digite sua senha." name="senha" required />
        <button type="submit">Entrar</button>
      </form>
      <div class="Cadastrar-se">
        <a href="index.php">Ainda não possui uma conta? Cadastrar-se</a>
      </div>
    </div>
  </div>
  </div>
</body>

</html>