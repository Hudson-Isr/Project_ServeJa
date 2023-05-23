<?php
@include('PHP/Start.php')
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="css/paginainicial.css" 
</head>
<body>
  <header>
    <ul class="">
      <button class="btn-ver-mais" id="btn-gerenciamento">
        <span>Área Gerenciamento</span>
        <ul class="menubar">
          <li><a href="cadastro.php">Entrar</a></li>
          <li><a href="admpedidos.php">Pedidos</a></li>
          <li><a href="admestoque.php">Estoque</a></li>
          <li><a href="admclientes.php">Clientes</a></li>
          <li><a href=""></a></li>
        </ul>
      </button>
      <li><a href="cadastrocliente.php">Cadastre-se aqui!</a></li>
      <li><a href="Login.php">Login</a></li>
      <div class="pesquisa">
        <input type="text" placeholder="Encontre seu lanche" />
        <button class="btn-pesquisa" type="submit">Buscar</button>
      </div>
      <button class="menu">
        <img src="imagens/shopping-cart.png" alt="carrinho" />
      </button>
    </ul>
  </header>
  <main>
  <div class="container">
      <section class="boasvindas">
        <div class="container">
          <h2 class="titulo">
            Seja bem-vindo <br />
            a plataforma ServeJá!
          </h2>
          <p class="paragrafo">
            Mude sua forma de fazer o seu pedido. Escaneie o código e
            aproveite!
          </p>
          <div class="btn-codes">
            <button>
              <a href="#" class="">Escaneie o código QR <i class="bi bi-camera"></i></a>
            </button>
            <p>ou</p>
            <button>
              <a href="#" class="">Digite o código da mesa <i class="bi bi-keyboard"></i></a>
            </button>
          </div>
        </div>
      </section>
      <h2 class="secoes">Categorias</h2>
      <section class="album">
        <div class="item">
          <a href="">
            <img src="imagens/burguer3.jpg" height="200px" alt="" />
            <p>Hamburgueres</p>
          </a>
        </div>
        <div class="item">
          <a href="">
            <img src="imagens/macarrao2.jpg" height="200px " alt="" />
            <p>Massas</p>
          </a>
        </div>
        <div class="item">
          <a href="">
            <img src="imagens/12Z_2104.w018.n001.898B.p15.898.jpg" height="200px" alt="" />
            <p>Bebidas</p>
          </a>
        </div>
      </section>
    </div>
    <div class="tes">
      <h2 class="secoes">Mais Pedidos</h2>
    </div>
    <section class="card">
      <?php foreach ($pratoDAO->read() as $prato) : ?>
        <div class="cardpedido">
          <div class="pedido">
            <img src="imagens/burguer4.jpg" height="" alt="" />
          </div>
          <div class="infos">
            <h3><?php echo $prato['nome_prato'] ?> - <span> <?php echo "R$ " . $prato['valor'] ?></span>
          </div>
          <div class="descricao">
            <?php echo $prato['descricao'] ?>
          </div>
          <div class="carrinhodisplay">
            <div class="carrinho">
              <button><a href="#">Adicionar ao carrinho</a></button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </section>
  </main>
  <footer class="container">
    <p>
      &copy;2023 ServeJa, LTDA. &middot; <a href="#">Privacy</a> &middot;
      <a href="#">Terms</a>
    </p>
    <p class="float-end"><a href="#">Back to top</a></p>
  </footer>
</body>
</html>