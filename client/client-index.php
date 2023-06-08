<?php 
//include('PHP/Start.php');
include "../includes/boostrap.php";
include "navbar-client.php";

session_start();
$nome = $_SESSION['nome'];

//FAZER UM IF PARA VERIFICAR SE POSSUI UMA MESA ATRIBUIDA AO USUARIO,
//CASO NÃO EXIBIR APENAS O MAIN, CASO SIM EXIBIR O CARDÁPIO.
?>

<main role="main" class="mt-3">

    <section class="jumbotron text-center mt-5">
        <div class="container">
            <h2 class="jumbotron-heading ">Seja bem-vindo, <?php echo $nome; ?>.</h2>
            <h3>ao<h3>
            <h1 class="logo text-danger">ServeJá</h1>
            <p class="lead text-dark">Mude sua forma de fazer o seu pedido. Escaneie o código e aproveite!</p>
            <p class="t">
            <a href="<?php $caminho?>client-index-mesa1.php" class="btn btn-danger my-2 bg-danger">Escaneie o código QR <i class="bi bi-camera"></i></a>
            <p>ou</p>
            <a href="#" class="btn btn-secondary my-2">Digite o código da mesa <i class="bi bi-keyboard"></i></a>
            </p>
        </div>
        <img src="/serveja/images/Hamburger-rafiki.png" alt="">
    </section>
    <style>img{width:13%;}</style>
</main>