<?php
include "../PHP/Start.php";
include "navbar-admin.php";
$caminho = "http://localhost/projeto-serveja/admin/";
$conn = new mysqli('localhost', 'root', '', 'serveja');

if (isset($_POST['add_mesa'])) {
    try {
        $mesa = $_POST["num_mesa"];
        $qr_code = "http://localhost/serveja/client/client-index-mesa.php?code=$codigo_mesa";
        $codigo_mesa = get_rand_alphanumeric(5);
        $status = "Livre";
        header("location: /serveja/admin/admin-mesas.php");
        #check email before insert
        $sql = "SELECT num_mesa FROM mesa where num_mesa='$mesa'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            /* email does not exist - perform insert */
            $query = "INSERT INTO mesa (num_mesa, status, codigo) VALUES ('$mesa', '$status', '$codigo_mesa')";

            header("location: ?success=mesa");
            $query_run = mysqli_query($conn, $query);
            exit;
        } else {
            /* email does exist - tell user */
            $stmt->free_result();
            $stmt->close();
            exit(header('Location: ?error=mesa'));
        }
    } catch (mysqli_sql_exception $e) {
        exit($e->getMessage());
    }

    //Verifica se a query executou corretamente, caso não irá exibir o erro na tela.
    if (!$query_run) {
        $error = "Invalid query: " . $conn->error;
    }
}

if (isset($_POST['desocupar_mesa'])) {
    $id_mesa = $_POST["id_mesa"];
    $status = "Livre";
    $query = "UPDATE mesa SET status = '$status', nome_cliente = '' WHERE id=$id_mesa";

    $query_run = mysqli_query($conn, $query);
    header("location: ?sucesso=desocupar");


    //Verifica se a query executou corretamente, caso não irá exibir o erro na tela.
    if (!$query_run) {
        $error = "Invalid query: " . $conn->error;
    }
}

if (isset($_POST['del_mesa'])) {
    $id_mesa = $_POST["id_mesa"];
    $query = "DELETE FROM mesa WHERE id=$id_mesa";

    $query_run = mysqli_query($conn, $query);
    header("location: ?deletar=mesa");


    //Verifica se a query executou corretamente, caso não irá exibir o erro na tela.
    if (!$query_run) {
        $error = "Invalid query: " . $conn->error;
    }
}

?>

<?php
if (isset($_GET['error']) == "mesa") {
    $erro = "Número de mesa já cadastrado!";
    echo "
    <div class='container position-absolute top-1 start-50 w-25 alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Error: </strong> $erro
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
}

if (isset($_GET['deletar']) == "mesa") {
    $mesa = "Mesa deletada com sucesso!";
    echo "
    <div class='mensagem container position-absolute top-1 start-50 w-25 alert alert-success alert-dismissible fade show' role='alert'>
        <strong>$mesa</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
}

if (isset($_GET['sucesso']) == "desocupar") {
    $mesa = "Mesa descupada com sucesso!";
    echo "
    <div class='mensagem container position-absolute top-1 start-50 w-25 alert alert-success alert-dismissible fade show' role='alert'>
        <strong>$mesa</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
}

if (isset($_GET['success']) == "mesa") {
    $mesa = "Mesa cadastrada com sucesso!";
    echo "
    <div class='mensagem container position-absolute top-1 start-50 w-25 alert alert-success alert-dismissible fade show' role='alert'>
        <strong>$mesa</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
}
?>

<div class='modal fade' id='verModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-scrollable'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'><b>Criar Mesa:</b></h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body col-md-5'>
                <form method='POST'>
                    <label for="num_mesa" class="form-label">Número da mesa:</label>
                    <input required type="number" class="form-control input-sm" name="num_mesa">
            </div>
            <div class='modal-footer'>
                <button type='submit' name='add_mesa' class='btn btn-primary' data-bs-dismiss='modal'>Adicionar Mesa</button>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class='container d-flex justify-content-between'>
    <h2 class='h2'>Mesas:</h2>
    <button class='btn btn-success me-5' data-bs-toggle='modal' data-bs-target='#verModal' type='button'>Adicionar Mesa</button>
</div>

<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10">
            <div class="rounded">
                <div class="table-responsive table-borderless">
                    <table class="table" style="border-collapse: collapse;" border=1 frame=void rules=rows>
                        <thead>
                            <h2>Livres:</h2>
                            <tr>
                                <th>ID da Mesa</th>
                                <th>Número da Mesa</th>
                                <th>Ocupada Por</th>
                                <th>Código da Mesa</th>
                                <th>Ação</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php

                            $sql = "SELECT * FROM mesa WHERE status='Livre' ORDER BY num_mesa ASC";
                            $conn = new mysqli('localhost', 'root', '', 'serveja');
                            $livre = $conn->query($sql);

                            if (!$livre) {
                                die("Query inválida: " . $conn->error);
                            }

                            //Disponibilização do resultado da busca na tela

                            while ($row = $livre->fetch_assoc()) {
                                echo "

                                <tr class='cell-1' style='border: solid; border-width: 1px 0;'>
                                    <td>$row[id]</td>
                                    <td>$row[num_mesa]</td>
                                    <td><span class='badge bg-success'>$row[status]</span></td>
                                    <td>$row[codigo]</td>
                                    <td><form method='POST'><input type='hidden' name='id_mesa' value='$row[id]'><button type='submit' name='del_mesa' class='btn btn-sm btn-outline-secondary'><i class='fa fa-ellipsis-h text-black-50 bi bi-trash'></i></button></form></td>
                                    <td><button type='button' data-bs-toggle='modal' data-bs-target='#verQRCODE$row[id]' class='btn btn-sm btn-outline-secondary'><i class='fa fa-ellipsis-h text-black-50 bi bi-qr-code'></i></button></td>
                                </tr>

                                <div class='modal fade' id='verQRCODE$row[id]' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-dialog-scrollable'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='exampleModalLabel'><b>QR Code da mesa:</b> nº $row[num_mesa]</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body print-container'>
                                                <img src='https://api.qrserver.com/v1/create-qr-code/?data=http://localhost/serveja/client/client-index-mesa.php?code=$row[codigo]' class='img-responsive'>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-primary' onclick='window.print();'>Imprimir</button>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
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
                    <table class="table" style="border-collapse: collapse;" border=1 frame=void rules=rows>
                        <thead>
                            <h2>Ocupadas:</h2>
                            <tr>
                                <th>ID da Mesa</th>
                                <th>Número da Mesa</th>
                                <th>Ocupada Por</th>
                                <th>Código da Mesa</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php

                            $sql = "SELECT * FROM mesa WHERE status='Ocupado' ORDER BY num_mesa ASC";
                            $conn = new mysqli('localhost', 'root', '', 'serveja');
                            $ocupado = $conn->query($sql);

                            if (!$ocupado) {
                                die("Query inválida: " . $conn->error);
                            }

                            //Disponibilização do resultado da busca na tela

                            while ($row = $ocupado->fetch_assoc()) {
                                echo "

                                <tr class='cell-1' style='border: solid; border-width: 1px 0;'>
                                    <td>$row[id]</td>
                                    <td>$row[num_mesa]</td>
                                    <td>$row[nome_cliente]</td>
                                    <td>$row[codigo]</td>
                                    <td><form method='POST'><input type='hidden' name='id_mesa' value='$row[id]'><button type='submit' name='desocupar_mesa' class='btn btn-sm btn-outline-secondary'><i class='fa fa-ellipsis-h text-black-50 bi bi-arrow-left'></i></button></form></td>
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


<style>
    @import url('https://fonts.googleapis.com/css?family=Assistant');

    @media print{
        body * {
            visibility: hidden;
        }

        .print-container, .print-container * {
            visibility: visible;
        }
    }

    .start-50 {
        left: 38% !important;
    }

    .modal-body > .img-responsive {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

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