<?php 
include "../php/config.php";
include "../includes/boostrap.php";
include "navbar-admin.php";
$conn = new mysqli('localhost', 'root', '', 'serveja');
$sql = "SELECT * FROM pedido";
$result = $conn->query($sql);
?>

<main role="main" class="mt-3">

    <section class="jumbotron text-center mt-5">
        <div id="myChart" style="max-width:700px; height:400px"></div>
    </section>
    <style>img{width:13%;}</style>
</main>

