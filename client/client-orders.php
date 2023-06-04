<?php
include "../PHP/Start.php";
include "../includes/boostrap.php";
include "navbar-client-orders.php";

?>

<h2 class="h2">Pedidos:</h2>
<div class="container my-3">
    <table class="table">
        <thead>
            <tr>
                <th>ID do Pedido</th>
                <th>Mesa</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $sql = "SELECT * FROM pedido";
            $conn = new mysqli('localhost', 'root', '', 'serveja');
            $result = $conn->query($sql);

            if (!$result) {
                die("Query inválida: " . $conn->error);
            }

            //Disponibilização do resultado da busca na tela

            while ($row = $result->fetch_assoc()) {
                echo "
                        <tr>
                            <td>$row[id]</td>
                            <td>$row[id_mesa]</td>
                            <td>R$ $row[valor_total]</td>
                            <td>$row[pratos]</td>
                            <td>
                                <a href='$caminho.php?id=$row[id]' class='btn btn-primary'>Ver detalhes</a>
                            </td>
                        </tr>
                        ";
            }

            ?>

        </tbody>
</div>
    <style>
        h2 {
            margin-left: 5.5rem;
        }
    </style>