<?php

$caminho = "http://localhost/serveja/client/";
@$mesa= $_GET['code'];
$pedido = false;

if (@$_GET['code'] == NULL){
    $index = "http://localhost/serveja/client/client-index.php?";
    $orders = "http://localhost/serveja/client/client-orders.php?";
    $logout = "http://localhost/serveja/PHP/Logout.php";
}
else {
    $index = "http://localhost/serveja/client/client-index-mesa.php?code=$mesa";
    $orders = "http://localhost/serveja/client/client-orders.php?code=$mesa";
    $logout = "http://localhost/serveja/PHP/Logout.php?code=$mesa";
}
?>

<title>Cliente | ServeJá</title>
<nav class="d-flex mb-5 align-self-center navbar navbar-expand-lg navbar-dark bg-danger shadow-sm mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $index?>&pedido=false ">ServeJá</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php 
                    if ($_GET['pedido'] == 'false'){
                        echo "
                        <li class='nav-item'>
                        <a class='nav-link active' href='$index'>Início</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='$orders&pedido=true'>Pedidos</a>
                        </li>
                        ";
                    }
                    else{
                        echo "
                        <li class='nav-item'>
                        <a class='nav-link' href='$index&pedido=false'>Início</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link active' href='$orders'>Pedidos</a>
                        </li>
                        ";
                    }

                ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $logout ?>">Sair</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2 disabled" type="" placeholder="Encontre seu lanche..." aria-label="Search">
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
