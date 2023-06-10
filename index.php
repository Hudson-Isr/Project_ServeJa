<?php

@include('PHP/Start.php');

$sql = 'INSERT INTO pessoa (nome, email, senha) VALUES (?,?,?)';
$pessoaDAO = new PessoaDAO();
$pessoa = new Pessoa();
$bd = Conexao::getConn()->prepare($sql);

if (isset($_POST['criar_cliente'])) {
  $conn = new mysqli('localhost', 'root', '', 'serveja');

  try {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    #check email before insert
    $sql = "SELECT email FROM pessoa where email='$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {

      $pessoa->setNome($nome);
      $pessoa->setEmail($email);
      $pessoa->setSenha($senha);

      $pessoaDAO->create($pessoa);

      session_start();
      $_SESSION['nome'] = $nome;
      $_SESSION['email'] = $email;
      $cliente = "SELECT * FROM pessoa WHERE email='$email'";
      $result = $conn->query($cliente);
      while ($row = $result->fetch_assoc()) {
        $_SESSION['id'] = $row["id"];
      }
      $id = $_SESSION['id'];

      header("location: /serveja/client/client-index.php?nome=$nome&pedido=false");
      exit;
    } else {

      $stmt->free_result();
      $stmt->close();

      exit(header('Location: ?error=email'));
    }
  } catch (mysqli_sql_exception $e) {
    exit($e->getMessage());
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ' crossorigin='anonymous'>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css'>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe' crossorigin='anonymous'></script>

<?php
if (isset($_GET['error']) == "user") {
  $erro = "E-mail já cadastrado!";
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

  <title>Cadastro | ServeJá</title>
</head>

<body>
  <div class="conteiner">
    <div class="page" style="width:60%;">
      <img src="imagens/Hamburger.gif" style="border-radius: 30px;" alt="Imagem Hamburguer">
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
        <a href="login.php">Já possui uma conta? Entre aqui!</a>
      </div>
    </div>
  </div>
  </div>
</body>
<style>
  .alert-dismissible .btn-close button {
    bottom: 3px;
  }

  .Cadastrar-se {
    margin: 0 0 0 0 !important;
  }

  button{
    margin-top: 10px !important;
  }

  label{
    margin: 0;
  }

  .conteiner{
    height: 31rem;
  }

  .page{
    display: inline-flex;
  }

  img{
    border-radius: 30px;
    width: 100%;
    margin-right: 5rem
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
    bottom: 3px !important;
    top: unset !important;
    padding-bottom: 2rem !important;
  }
</style>

</html>