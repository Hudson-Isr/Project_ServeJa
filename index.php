<?php
include('PHP/Protect.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/paginainicial.css" />
    <title>ServeJá - Página inicial</title>
    <script src=""></script>
  </head>
  <body>
    <header>
      <ul class="">
        <li><a href="index.html">Serve Já</a></li>
        <li><a href="cadastrocliente.html">Cadastre-se aqui!</a></li>
        <li><a href="">Login</a></li>
        <button class="btn-ver-mais" id="btn-gerenciamento">
          Área Gerenciamento
          <ul class="menubar">
            <li><a href="cadastro.html">Entrar</a></li>
            <li><a href="admpedidos.html">Pedidos</a></li>
            <li><a href="gerenciacardapio.html">Cardápio</a></li>
            <li><a href="admestoque.html">Estoque</a></li>
            <li><a href="admclientes.html">Clientes</a></li>
            <li><a href=""></a></li>
          </ul>
        </button>
        <div class="pesquisa">
          <input type="text" placeholder="Encontre seu lanche" />
          <button class="btn-pesquisa" type="submit">Buscar</button>
        </div>
        <button class="menu">
          <img src="imagens/shopping-cart.png" alt="" />
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
                <a href="#" class=""
                  >Escaneie o código QR <i class="bi bi-camera"></i
                ></a>
              </button>
              <p>ou</p>
              <button>
                <a href="#" class=""
                  >Digite o código da mesa <i class="bi bi-keyboard"></i
                ></a>
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
              <img
                src="imagens/12Z_2104.w018.n001.898B.p15.898.jpg"
                height="200px "
                alt=""
              />
              <p>Bebidas</p>
            </a>
          </div>
        </section>

        <h2 class="secoes">Mais Pedidos</h2>

        <section class="card">
          <div class="cardpedido">
            <div class="pedido">
              <img src="imagens/burguer4.jpg" height="" alt="" />
            </div>
            <div class="infos">
              <h3>Texano - <a href="3">R$ 26.99</a></h3>
            </div>
            <div class="descricao">
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste
                eveniet incidunt nobis, doloribus impedit magnam nostrum,
                minima, veritatis alias deleniti voluptates optio rem aspernatur
                repellat voluptatibus provident sapiente! Quia, recusandae?
              </p>
            </div>
            <div class="carrinhodisplay">
              <div class="carrinho">
                <button><a href="">Adicionar ao carrinho</a></button>
              </div>
              <small class="text-muted">10 min</small>
            </div>
          </div>

          <div class="cardpedido">
            <div class="pedido">
              <img src="imagens/macarrao1.jpg" alt="" />
            </div>
            <div class="infos">
              <h3>Carbonara - <a href="3">R$ 19.99</a></h3>
            </div>
            <div class="descricao">
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste
                eveniet incidunt nobis, doloribus impedit magnam nostrum,
                minima, veritatis alias deleniti voluptates optio rem aspernatur
                repellat voluptatibus provident sapiente! Quia, recusandae?
              </p>
            </div>
            <div class="carrinhodisplay">
              <div class="carrinho">
                <button><a href="">Adicionar ao carrinho</a></button>
              </div>
              <small class="text-muted">10 min</small>
            </div>
          </div>

          <div class="cardpedido">
            <div class="pedido">
              <img src="imagens/4Z_2104.w018.n001.882B.p15.882.jpg" alt="" />
            </div>
            <div class="infos">
              <h3>Coca-Cola - 350ml - <a href="3">R$ 6.99</a></h3>
            </div>
            <div class="descricao">
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste
                eveniet incidunt nobis, doloribus impedit magnam nostrum,
                minima, veritatis alias deleniti voluptates optio rem aspernatur
                repellat voluptatibus provident sapiente! Quia, recusandae?
              </p>
            </div>
            <div class="carrinhodisplay">
              <div class="carrinho">
                <button><a href="">Adicionar ao carrinho</a></button>
              </div>
              <small class="text-muted">10 min</small>
            </div>
          </div>

          <div class="cardpedido">
            <div class="pedido">
              <img src="imagens/burguer1.jpg" height="" alt="" />
            </div>
            <div class="infos">
              <h3>Binário Burguer - <a href="3">R$ 23.99</a></h3>
            </div>
            <div class="descricao">
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste
                eveniet incidunt nobis, doloribus impedit magnam nostrum,
                minima, veritatis alias deleniti voluptates optio rem aspernatur
                repellat voluptatibus provident sapiente! Quia, recusandae?
              </p>
            </div>
            <div class="carrinhodisplay">
              <div class="carrinho">
                <button><a href="">Adicionar ao carrinho</a></button>
              </div>
              <small class="text-muted">12 min</small>
            </div>
          </div>
        </section>

        <section class="card2">
          <div class="cardpedido">
            <div class="pedido">
              <img src="imagens/macarrao2.jpg" height="" alt="" />
            </div>
            <div class="infos">
              <h3>Fettuccine - <a href="3">R$ 20.99</a></h3>
            </div>
            <div class="descricao">
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste
                eveniet incidunt nobis, doloribus impedit magnam nostrum,
                minima, veritatis alias deleniti voluptates optio rem aspernatur
                repellat voluptatibus provident sapiente! Quia, recusandae?
              </p>
            </div>
            <div class="carrinhodisplay">
              <div class="carrinho">
                <button><a href="">Adicionar ao carrinho</a></button>
              </div>
              <small class="text-muted">15 min</small>
            </div>
          </div>

          <div class="cardpedido">
            <div class="pedido">
              <img src="imagens/guarana.jpg" alt="" />
            </div>
            <div class="infos">
              <h3>Guaraná - 350ml - <a href="3">R$ 21.99</a></h3>
            </div>
            <div class="descricao">
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste
                eveniet incidunt nobis, doloribus impedit magnam nostrum,
                minima, veritatis alias deleniti voluptates optio rem aspernatur
                repellat voluptatibus provident sapiente! Quia, recusandae?
              </p>
            </div>
            <div class="carrinhodisplay">
              <div class="carrinho">
                <button><a href="">Adicionar ao carrinho</a></button>
              </div>
              <small class="text-muted">10 min</small>
            </div>
          </div>

          <div class="cardpedido">
            <div class="pedido">
              <img src="imagens/burguer5.jpg" alt="" />
            </div>
            <div class="infos">
              <h3>SQL burguer - <a href="3">R$ 22.99</a></h3>
            </div>
            <div class="descricao">
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste
                eveniet incidunt nobis, doloribus impedit magnam nostrum,
                minima, veritatis alias deleniti voluptates optio rem aspernatur
                repellat voluptatibus provident sapiente! Quia, recusandae?
              </p>
            </div>
            <div class="carrinhodisplay">
              <div class="carrinho">
                <button><a href="">Adicionar ao carrinho</a></button>
              </div>
              <small class="text-muted">12 min</small>
            </div>
          </div>

          <div class="cardpedido">
            <div class="pedido">
              <img src="imagens/macarrao3.jpg" height="" alt="" />
            </div>
            <div class="infos">
              <h3>Alho e Óleo - <a href="3">R$ 14.99</a></h3>
            </div>
            <div class="descricao">
              <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste
                eveniet incidunt nobis, doloribus impedit magnam nostrum,
                minima, veritatis alias deleniti voluptates optio rem aspernatur
                repellat voluptatibus provident sapiente! Quia, recusandae?
              </p>
            </div>
            <div class="carrinhodisplay">
              <div class="carrinho">
                <button><a href="">Adicionar ao carrinho</a></button>
              </div>
              <small class="text-muted">15 min</small>
            </div>
          </div>
        </section>
        <section class="card3">
          <div class="produtos">
            <img class="produt" src="imagens/burguer3.jpg" alt="" />
            <p>Tech Burguer</p>
            <p>Tempo de preparo - 10 min</p>
            <p>Preço: <a href="3">R$ 24.99</a></p>
            <p>Lote: <a href="#">C531f</a></p>
            <p>Validade: <a href="">10/12/24</a></p>
            <button class="btn-ver">
              Editar
              <ul class="menubar">
                <li>Alterar informações</li>
                <li>Imagem</li>
                <li>Ativar item</li>
                <li>Bloquear item</li>
                <li>Excluir</li>
              </ul>
            </button>
          </div>
        </section>
      </div>
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
