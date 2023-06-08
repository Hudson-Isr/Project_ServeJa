<?php
include "../PHP/Start.php";
include "navbar-admin.php";
//FAZER UM IF PARA VERIFICAR SE POSSUI UMA MESA ATRIBUIDA AO USUARIO,
//CASO NÃO EXIBIR APENAS O MAIN, CASO SIM EXIBIR O CARDÁPIO.
if (isset($_POST['preparar'])) {
    $conn = new mysqli('localhost', 'root', '', 'serveja');
    $id = $_POST["id"];
    $status = 'Em Preparo';

    $query = "UPDATE pedido SET status='$status' WHERE id=$id";

    $query_run = mysqli_query($conn, $query);
    header("location: /serveja/admin/admin-orders.php");


    //Verifica se a query executou corretamente, caso não irá exibir o erro na tela.
    if (!$query_run) {
        $error = "Invalid query: " . $conn->error;
    }
}

if (isset($_POST['pronto'])) {
    $conn = new mysqli('localhost', 'root', '', 'serveja');
    $id = $_POST["id"];
    $status = 'Pronto';

    $query = "UPDATE pedido SET status='$status' WHERE id=$id";

    $query_run = mysqli_query($conn, $query);
    header("location: /serveja/admin/admin-orders.php");


    //Verifica se a query executou corretamente, caso não irá exibir o erro na tela.
    if (!$query_run) {
        $error = "Invalid query: " . $conn->error;
    }
}


?>

<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <div class="rounded">
                <div class="table-responsive table-borderless">
                    <table class="table" style="border-collapse: collapse;" border=1 frame=void rules=rows>
                        <thead>
                            <h2>Aguardando:</h2>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Nome do Cliente</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Data</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php

                            $sql = "SELECT * FROM pedido WHERE status='Aguardando'";
                            $conn = new mysqli('localhost', 'root', '', 'serveja');
                            $aguardando = $conn->query($sql);

                            if (!$aguardando) {
                                die("Query inválida: " . $conn->error);
                            }

                            //Disponibilização do resultado da busca na tela

                            while ($row = $aguardando->fetch_assoc()) {
                                echo "

                                <tr class='cell-1' style='border: solid; border-width: 1px 0;'>
                                    <td>$row[id]</td>
                                    <td>$row[nome_cliente]</td>
                                    <td><span class='badge bg-warning'>$row[status]</span></td>
                                    <td>R$ $row[valor_total]</td>
                                    <td>$row[data]</td>
                                    <td><i class='fa fa-ellipsis-h text-black-50'></i><button type='button' class='btn btn-sm btn-outline-secondary' data-bs-toggle='modal' data-bs-target='#verModal$row[id]''>Ver Detalhes</button></td>
                                </tr>


                                <div class='modal fade' id='verModal$row[id]' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-scrollable'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='exampleModalLabel'><b>CLiente:</b> $row[nome_cliente]</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <p class='card-text'><b>Prato:</b> $row[pratos] | <b>Quantidade:</b> $row[quant] | <b>Valor Total:</b> R$ $row[valor_total]</p>
                                            <p><b>Observação:</b> $row[observacao]</p>
                                        </div>
                                        <div class='modal-footer'>
                                            <form method='POST'>
                                                <input type='hidden' name='id' value='$row[id]'>
                                                <button type='submit' name='preparar' class='btn btn-primary' data-bs-dismiss='modal'>Em Preparo</button>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ";
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <div class="rounded">
                <div class="table-responsive table-borderless ">
                    <table class="table">
                        <thead>
                            <h2>Em Preparo:</h2>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Nome do Cliente</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Data</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php

                            $sql = "SELECT * FROM pedido WHERE status='Em Preparo'";
                            $conn = new mysqli('localhost', 'root', '', 'serveja');
                            $preparo = $conn->query($sql);

                            if (!$preparo) {
                                die("Query inválida: " . $conn->error);
                            }

                            //Disponibilização do resultado da busca na tela

                            while ($row = $preparo->fetch_assoc()) {
                                echo "

                                <tr class='cell-1' style='border: solid; border-width: 1px 0;'>
                                    <td>$row[id]</td>
                                    <td>$row[nome_cliente]</td>
                                    <td><span class='badge bg-success'>$row[status]</span></td>
                                    <td>R$ $row[valor_total]</td>
                                    <td>$row[data]</td>
                                    <td><i class='fa fa-ellipsis-h text-black-50'></i><button type='button' class='btn btn-sm btn-outline-secondary' data-bs-toggle='modal' data-bs-target='#verModal$row[id]''>Ver Detalhes</button></td>
                                </tr>
                                <div class='modal fade' id='verModal$row[id]' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-scrollable'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='exampleModalLabel'><b>CLiente:</b> $row[nome_cliente]</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <p class='card-text'><b>Prato:</b> $row[pratos] | <b>Quantidade:</b> $row[quant] | <b>Valor Total:</b> R$ $row[valor_total]</p>
                                            <p><b>Observação:</b> $row[observacao]</p>
                                        </div>
                                        <div class='modal-footer'>
                                            <form method='POST'>
                                                <input type='hidden' name='id' value='$row[id]'>
                                                <button type='submit' name='pronto' class='btn btn-primary' data-bs-dismiss='modal'>Pronto</button>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ";
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <div class="rounded">
                <div class="table-responsive table-borderless">
                    <table class="table">
                        <thead>
                            <h2>Prontos</h2>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Nome do Cliente</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Data</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php

                            $sql = "SELECT * FROM pedido WHERE status='Pronto' ORDER BY id DESC ";
                            $conn = new mysqli('localhost', 'root', '', 'serveja');
                            $prontos = $conn->query($sql);

                            if (!$prontos) {
                                die("Query inválida: " . $conn->error);
                            }

                            //Disponibilização do resultado da busca na tela

                            while ($row = $prontos->fetch_assoc()) {
                                echo "

                                <tr class='cell-1' style='border: solid; border-width: 1px 0;'>
                                    <td>$row[id]</td>
                                    <td>$row[nome_cliente]</td>
                                    <td><span class='badge bg-primary'>$row[status]</span></td>
                                    <td>R$ $row[valor_total]</td>
                                    <td>$row[data]</td>
                                    <td class='botao'><i class='fa fa-ellipsis-h text-black-50'></i><button type='button' class='btn btn-sm btn-outline-secondary' data-bs-toggle='modal' data-bs-target='#verModal$row[id]''>Ver Detalhes</button></td>
                                </tr>
                        ";
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('.toggle-btn').click(function() {
            $(this).toggleClass('active').siblings().removeClass('active');
        });

    });
</script>

<style>
    @import url('https://fonts.googleapis.com/css?family=Assistant');

    body {
        background: #eee;
        font-family: Assistant, sans-serif;
    }

    table {
        border-collapse: collapse;
    }

    tr {
        border: solid;
        border-width: 1px 0;
    }

    tr:first-child {
        border-top: none;
    }

    tr:last-child {
        border-bottom: none;
    }

    .cell-1 {
        border-collapse: separate;
        border-spacing: 0 4em;
        background: #fff;
        border-bottom: 5px solid transparent;
        /*background-color: gold;*/
        background-clip: padding-box;
    }

    thead {
        background: #dddcdc;
    }

    .toggle-btn {
        width: 40px;
        height: 21px;
        background: grey;
        border-radius: 50px;
        padding: 3px;
        cursor: pointer;
        -webkit-transition: all 0.3s 0.1s ease-in-out;
        -moz-transition: all 0.3s 0.1s ease-in-out;
        -o-transition: all 0.3s 0.1s ease-in-out;
        transition: all 0.3s 0.1s ease-in-out;
    }

    .toggle-btn>.inner-circle {
        width: 15px;
        height: 15px;
        background: #fff;
        border-radius: 50%;
        -webkit-transition: all 0.3s 0.1s ease-in-out;
        -moz-transition: all 0.3s 0.1s ease-in-out;
        -o-transition: all 0.3s 0.1s ease-in-out;
        transition: all 0.3s 0.1s ease-in-out;
    }

    .toggle-btn.active {
        background: blue !important;
    }

    .toggle-btn.active>.inner-circle {
        margin-left: 19px;
    }
</style>