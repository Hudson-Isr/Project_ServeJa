<?php
include "../PHP/Start.php";
include "../includes/boostrap.php";
include "navbar-client.php";
session_start();
@$mesa = $_GET['code'];
if ($_SESSION["nome"] == null){
    header("location: /serveja/index.php?user=empty");
}

if (isset($_POST['cancelar'])) {
    $conn = new mysqli('localhost', 'root', '', 'serveja');
    $id = $_POST["id"];
    $status = 'Cancelado';

    $query = "UPDATE pedido SET status='$status' WHERE id=$id";

    $query_run = mysqli_query($conn, $query);
    header("location: /serveja/client/client-orders.php?code=$mesa&pedido=true");


    //Verifica se a query executou corretamente, caso não irá exibir o erro na tela.
    if (!$query_run) {
        $error = "Invalid query: " . $conn->error;
    }
}

?>

<h2 class="h2">Pedidos:</h2>
<div class="container my-3">
    <table class="table">
        <thead>
            <tr>
                <th>ID do Pedido</th>
                <th>Mesa</th>
                <th>Valor Total</th>
                <th>Data do Pedido</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn = new mysqli('localhost', 'root', '', 'serveja');     
            $id_cliente = $_SESSION['id'];
            $sql = "SELECT * FROM pedido where id_cliente='$id_cliente'";
            $result = $conn->query($sql);

            if (!$result) {
                die("Query inválida: " . $conn->error);
            }

            //Disponibilização do resultado da busca na tela

            while ($row = $result->fetch_assoc()) {
                $valor_unit = $row['valor_total'] / $row['quant'];
                $data = date('d-m-Y', strtotime($row['data']));
                if ($row['status'] == "Pronto") {
                    $status = "<span class='badge bg-primary'> $row[status]</span>";
                } else if ($row['status'] == "Aguardando") {
                    $status = "<span class='badge bg-warning'> $row[status]</span>";
                } else if ($row['status'] == "Cancelado") {
                    $status = "<span class='badge bg-danger'> $row[status]</span>";
                } else {
                    $status = "<span class='badge bg-success'> $row[status]</span>";
                }
                echo "
                        <tr>
                            <td>$row[id]</td>
                            <td>$row[id_mesa]</td>
                            <td>R$ $row[valor_total]</td>
                            <td>$data</td>
                            <td>$status</td>
                            <td>
                                <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#verModal$row[id]'>Ver detalhes</button>
                            </td>
                        </tr>
                    ";
            ?>
                <div class='modal fade' id='verModal<?php echo $row['id']?>' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-scrollable'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'><b>Detalhes do Pedido:</b> nº <?php echo $row['id'] ?></h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <p class='card-text'><b>Prato:</b> <?php echo $row['pratos'] ?> | <b>Quantidade:</b> <?php echo $row['quant'] ?></p>
                                <p class='card-text'><b>Data do pedido:</b> <?php echo $data ?> | <b>Valor Unitário:</b> R$ <?php echo $valor_unit ?></p>
                                <b>Valor Total:</b> R$ <?php echo $row['valor_total'] ?> | <b>Status: </b><?php echo $status ?></p>
                                <p><b>Observação:</b> <?php echo $row['observacao'] ?></p>
                            </div>
                            <div class='modal-footer'>
                                <?php if ($row['status'] == "Aguardando"){
                                    echo "<form method='POST'><input type='hidden' name='id' value='$row[id]'><button type='submit' name='cancelar' class='btn btn-danger' data-bs-dismiss='modal'>Cancelar</button></form>";
                                } ?>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }

            ?>

        </tbody>
</div>
<style>
    h2 {
        margin-left: 5.5rem;
    }
</style>