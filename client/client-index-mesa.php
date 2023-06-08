<?php
include "../PHP/Start.php";
include "../includes/boostrap.php";
include "navbar-client.php";
$conn = new mysqli('localhost', 'root', '', 'serveja');

session_start();

$nome = $_SESSION['nome'];
$id_cliente = $_SESSION['id'];
$email = $_SESSION['email'];
$mesa = $_GET['code'];
$sql = "SELECT num_mesa FROM mesa where codigo='$mesa'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $num_mesa= $row["num_mesa"];
}

if (isset($_POST['checkout'])) {
    $id_prato = $_POST["prato"];
    $obs = $_POST['obs'];
    $quant = $_POST['quant'];
    $status = 'Aguardando';
    $busca = "SELECT * FROM prato WHERE id='$id_prato'";
    $conn = new mysqli('localhost', 'root', '', 'serveja');
    $result = $conn->query($busca);
    while ($row = $result->fetch_assoc()) {
        $pratos = $row["nome_prato"];
        $valor = $row["preco"];
    }

    $valor_total = $valor * $quant;

    $status = "Aguardando";
    $query = "INSERT INTO pedido (id_cliente, pratos, valor_total, observacao, quant, status, nome_cliente, id_prato, id_mesa) VALUES ('$id_cliente', '$pratos', '$valor_total', '$obs', '$quant', '$status', '$nome', '$id_prato', '$num_mesa')";

    $query_run = mysqli_query($conn, $query);
    exit(header("location: ?success=pedido&code=$mesa&pedido=false"));


    //Verifica se a query executou corretamente, caso não irá exibir o erro na tela.
    if (!$query_run) {
        $error = "Invalid query: " . $conn->error;
    }
}

?>

<main>
    <?php
    if (isset($_GET['success']) == "pedido") {
        $pedido = "Pedido realizado com sucesso!";
        echo "
    <div class='mensagem container position-absolute top-1 start-50 w-25 alert alert-success alert-dismissible fade show' role='alert'>
        <strong>$pedido</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>
    ";
    }
    ?>

    <section class="jumbotron text-center mt-5 mb-5">
        <div class="container text-center">
            <h2 class="jumbotron-heading ">Seja bem-vindo, <?php echo $nome; ?>.</h2>
            <h3>ao<h3>
            <h1 class="logo text-danger">ServeJá</h1>
            <p class="lead text-dark">Aproveite todos os pratos logo abaixo!</p>
            <p>Mesa Nº: <b><?php echo $num_mesa ?></b></p>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <h2 class="pratos mb-3">Pratos</h2>
        <hr>
        <div class="container">
            <div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3'>
                <?php
                //Leitura de todas as colunas da tabela
                $sql = "SELECT * FROM prato";
                $conn = new mysqli('localhost', 'root', '', 'serveja');
                $result = $conn->query($sql);

                if (mysqli_num_rows($result) == 0) {
                    echo "
                    <div class='vazio mt-4 container text-center d-flex justify-content-center'>
                        <div class='row g-3'>
                            <h3 class='col col-lg-3'>Parece que não tem nenhum prato cadastrado...</h3>
                            <img class='col-md-auto ' src='/projeto-serveja/images/deconstructed-food-amico.svg'>
                        </div>
                    </div>
                    ";
                }

                if (!$result) {
                    die("Query inválida: " . $conn->error);
                }

                //Disponibilização do resultado da busca na tela

                while ($row = $result->fetch_assoc()) {
                    echo "
                <div class='col'>
                    <div class='card shadow-sm'>
                        <img class='bd-placeholder-img card-img-top' width='100%' height='225' xmlns='http://www.w3.org/2000/svg' src='../upload/$row[image_url]' focusable='false'>

                        <div class='card-body'>
                            <p class='card-text'><b>Nome:</b> $row[nome_prato] | <b>Valor:</b> R$ $row[preco]</p>
                            <p class='card-text'><b>Descrição:</b> $row[descricao]</p>
                            <div class='d-flex justify-content-between align-items-center'>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-sm btn-outline-secondary' data-bs-toggle='modal' data-bs-target='#verModal$row[id]''>Ver</button>
                                    <button type='button' data-bs-toggle='modal' data-bs-target='#comprarModal$row[id]'class='btn btn-sm btn-outline-secondary'>Comprar</button>
                                </div>
                                <small class='text-muted'>Tempo de preparo: $row[tempo] mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class='modal fade' id='comprarModal$row[id]' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-scrollable'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'><b>Prato:</b> $row[nome_prato] | <b>Valor:</b> R$ $row[preco]</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <form method='POST' autocomplete='OFF'>
                            <div class='modal-body'>
                                    <input type='hidden' class='position-absolute' name='prato' value='$row[id]'/>
                                    <div class='col-sm-2'>
                                        <label for='quant' class='form-label'><b>Quantidade:</b> </label>
                                        <input required type='number' min='1' name='quant' class='form-control' value='1'></input>
                                    </div>
                                    <label for='obs' class='form-label mt-3'><b>Observação:</b> (Opcional)</label>
                                    <textarea class='form-control' name='obs' placeholder='Não adicionar maionese, etc...'></textarea>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
                                <button type='submit' name='checkout' class='btn btn-primary'>Comprar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class='modal fade'  id='verModal$row[id]' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-scrollable'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'><b>Prato:</b> $row[nome_prato]</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <p class='card-text'><b>Nome:</b> $row[nome_prato] | <b>Valor:</b> R$ $row[preco]</p>
                                <p><b>Descrição:</b> $row[descricao]</p>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

                ";
                }
                ?>
            </div>
        </div>


        <style>
            .start-50 {
                left: 38% !important;
            }

            textarea {
                resize: none;
                width: 250px;
                height: 100px;
            }

            .vazio img {
                width: 250px !important;
                margin-top: 3.5rem !important;
            }

            .vazio {
                white-space: nowrap;
            }

            .pratos {
                margin-left: 5.5rem;
            }

            a {
                text-decoration: none;
                color: white;
            }

            .card-text {
                text-overflow: ellipsis;
                white-space: nowrap;
                overflow: hidden;
            }

            .table-image td {
                vertical-align: baseline;
                text-align: left;
                border: 0;
                color: #666;
                font-size: 0.8rem;
            }

            .table-image qty {
                max-width: 2rem;
            }

            .price {
                margin-left: 1rem;
            }

            form {
                margin: 0;
            }
        </style>
</main>