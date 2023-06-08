<?php

$caminho = "http://localhost/serveja/client/";

?>

<title>Pedidos | ServeJá</title>
<nav class="d-flex mb-5 align-self-center navbar navbar-expand-lg navbar-dark bg-danger shadow-sm mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $caminho?>client-index.php">ServeJá</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $caminho?>client-index-mesa1.php">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?php $caminho?>client-orders.php">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sair</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="text" name="search" placeholder="Encontre seu lanche..." aria-label="Search">
                <button class="search btn btn-outline-light" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>
</nav>

<style>

    .navbar{
        padding: 0!important;
    }
    
    .navbar form{
        margin: 0;
        padding-top: .5rem;
        padding-bottom: .5rem;
    }

    .carti {
        margin-right: 2rem;
        padding-top: 0.75rem;
        padding-bottom: 0.375rem;
    }


</style>
<!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gerenciamento
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Pedidos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Cardápio</a></li>
          </ul>
        </li> -->