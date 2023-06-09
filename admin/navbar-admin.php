<?php

$caminho = "http://localhost/projeto-serveja/admin/";

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];


?>
<title>Administração | ServeJá</title>
<nav class="d-flex mb-5 align-self-center navbar navbar-expand-lg navbar-dark bg-danger shadow-sm mb-3">
    <div class="container">
        <a class="navbar-brand" href="<?php $caminho ?>admin-menu.php">ServeJá</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Gerenciamento
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php $caminho ?>admin-orders.php">Pedidos</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?php $caminho ?>admin-menu.php">Cardápio</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?php $caminho ?>admin-mesas.php">Mesas</a></li>
                    </ul>
                </li>
            </ul>
            <?php 

            if ($url == 'http://localhost/serveja/admin/admin-menu.php'){
                echo"
                    <form class='d-flex' method='POST'>
                        <input class='form-control me-2' type='text' name='busca' value='' placeholder='Busque aqui o prato...' aria-label='Search'>
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
    if($url == 'http://localhost/serveja/admin/admin-menu.php'){
        echo"
        .navbar {
            padding: 0 !important;
        }";
    } else {
        echo"    
        .navbar {
            padding: .45rem !important;
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