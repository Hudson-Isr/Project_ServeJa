<?php

$caminho = "http://localhost/serveja/client/";
@$mesa = $_GET['code'];
$pedido = false;

if (@$_GET['code'] == NULL) {
    $index = "http://localhost/serveja/client/client-index.php?";
    $orders = "http://localhost/serveja/client/client-orders.php?";
    $logout = "http://localhost/serveja/PHP/Logout.php";
} else {
    $index = "http://localhost/serveja/client/client-index-mesa.php?code=$mesa";
    $orders = "http://localhost/serveja/client/client-orders.php?code=$mesa";
    $logout = "http://localhost/serveja/PHP/Logout.php?code=$mesa";
}
?>

<title>Cliente | ServeJá</title>
<nav class="d-flex mb-5 align-self-center navbar navbar-expand-lg navbar-dark bg-danger shadow-sm mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $index ?>&pedido=false ">ServeJá</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                if (@$_GET['pedido'] == 'true') {
                    echo "
                        <li class='nav-item'>
                        <a class='nav-link' href='$index&pedido=false'>Início</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link active' href='$orders&pedido=true'>Pedidos</a>
                        </li>
                        ";
                } else {
                    echo "
                        <li class='nav-item'>
                        <a class='nav-link active' href='$index&pedido=false'>Início</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='$orders&pedido=true'>Pedidos</a>
                        </li>
                        ";
                }

                ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $logout ?>">Sair</a>
                </li>
            </ul>
            <?php
            if (@$_GET['code'] != NULL && @$_GET['pedido'] == 'false') {
                echo "
                    <form class='d-flex' method='POST'>
                        <input class='form-control me-2' type='text' name='busca' value='' placeholder='Encontre seu lanche...' aria-label='Search'>
                        <button class='search btn btn-outline-light' type='submit'>
                            <i class='bi bi-search'></i>
                        </button>
                    </form>
                    ";
            }
            ?>
        </div>
    </div>
</nav>

<style>
    <?php 
    if(@$_GET['pedido'] == 'true'){
        echo"    
        .navbar {
            padding: .45rem !important;
        }";
    } else {
        echo"
        .navbar {
            padding: 0 !important;
        }";
    }
    
    ?>

    .navbar form {
        margin: 0;
        padding-top: .5rem;
        padding-bottom: .5rem;
    }

    html::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #F5F5F5;
    }

    html::-webkit-scrollbar {
        width: 6px;
        background-color: #F5F5F5;
    }

    html::-webkit-scrollbar-thumb {
        background-color: #dc3545;
    }
</style>