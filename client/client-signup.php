<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Cadastro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" media="screen" href="css/client-signup.css" />
</head>

<body>
  <div class="container">
    <div class="svg">
      <img src="/serveja/images/singup-content/Hamburger-bro.png" alt="">
      <form action="" autocomplete="off">
        <div class="text">
          <h2>Olá, tudo bem?</h2>
          <h4>Por favor, insira seus dados</h4>
          <div class="inputBox">
            <input type="text" name="name" id="name" class="inputUser" required />
            <label for="nome" class="labelInput">Nome completo</label>
          </div>
          <div class="inputBox">
            <input type="email" name="email" id="email" class="inputUser" required />
            <label for="email" class="labelInput">E-mail</label>
          </div>
          <div class="inputBox">
            <input type="password" name="password" id="password" class="inputUser" required />
            <label for="senha" class="labelInput">Senha</label>
          </div>
          <input type="submit" name="submit" id="submit" class="submit" value="Cadastrar" />
          <a href="login.php" class="cadastrar">Já tem uma conta? Entre aqui!</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>