<?php

@include('PHP/Start.php');
$conn = new mysqli('localhost', 'root', '', 'serveja');

if (isset($_POST['email']) || isset($_POST['senha'])) {

  $conexao = Conexao::getConn(); //puxando a class Conexao;
  $sql_code = "SELECT * FROM pessoa WHERE email = :email AND senha = :senha"; //Realizando a verificação dos campos no banco;
  $sql_query = $conexao->prepare($sql_code);
  $sql_query->bindParam(':email', $_POST['email']); //Verificaçao por parametro;
  $sql_query->bindParam(':senha', $_POST['senha']);

  $sql_query->execute();
  $quantidade = $sql_query->rowCount();

  if ($quantidade == 1) {
    $email = $_POST['email'];
    $usuario = $sql_query->fetch(PDO::FETCH_ASSOC);

    if (!isset($_SESSION)) {
      session_start();
    }
    $cliente = "SELECT * FROM pessoa WHERE email='$email'";
    $result = $conn->query($cliente);
    while ($row = $result->fetch_assoc()) {
      $_SESSION['id'] = $row["id"];
    }
    $id = $_SESSION['id'];
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['email'] = $usuario['email'];

    header("location: /serveja/client/client-index.php?id=$id&pedido=false");
  } else {
    header("location: ?error=user");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

<?php
if (isset($_GET['error']) == "user") {
  $erro = "Usuário ou senha incorreto!";
  echo "
    <div class='position-absolute top-0 start-50 w-25 alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Error: </strong> $erro
        <button type='button' style='bottom:3px' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
}
?>

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
<style>
  .alert-dismissible .btn-close button {
    bottom: 3px;
  }

  .start-50 {
    top: 10% !important;
    left: 38% !important;
    z-index: 3;
  }

  .btn-close {
    padding: 0 !important;
  }

  .start-50 button {
    padding-right: 1.5rem !important;
    bottom:3px !important;
    top: unset !important;
    padding-bottom: 2rem !important;
  }
</style>

</html>