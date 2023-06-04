<?php
include "../PHP/Start.php";
include "../includes/boostrap.php";
include "navbar-client.php";

session_start();

$nome = $_SESSION['nome'];
$value = 0;
@$id_cliente = $_SESSION['id'];
@$email = $_SESSION['email'];
$db_handle = new DBController();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            $id = $_GET['code'];
            if (!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM prato WHERE id='$id'");
                $itemArray = array($productByCode[0]["id"] => array('name' => $productByCode[0]["nome_prato"], 'id' => $productByCode[0]["id"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["preco"], 'image' => $productByCode[0]["image_url"]));

                if (!empty($_SESSION["cart_item"])) {
                    if (in_array($productByCode[0]["id"], array_keys($_SESSION["cart_item"]))) {
                        foreach ($_SESSION["cart_item"] as $k => $v) {
                            if ($productByCode[0]["id"] == $k) {
                                if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                    header("location: /serveja/client/client-index-mesa1.php");
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                header("location: /serveja/client/client-index-mesa1.php");
                            }
                            header("location: /serveja/client/client-index-mesa1.php");
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                        header("location: /serveja/client/client-index-mesa1.php");
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                    header("location: /serveja/client/client-index-mesa1.php");
                }
            }
            break;
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                foreach ($_SESSION["cart_item"] as $k => $v) {
                    if ($_GET['code'] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    header("location: /serveja/client/client-index-mesa1.php");
                    if (empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                    header("location: /serveja/client/client-index-mesa1.php");
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            header("location: /serveja/client/client-index-mesa1.php");
            break;
        case "checkout":
            
    }
}

if (isset($_POST['checkout'])) {
    $pratos[] = $_POST["prato"];
    $quant[] = $_POST["quant"];
    $valor_total = $_POST["preco"];
    $status = "Aguardando";

    $conn = new mysqli('localhost', 'root', '', 'serveja');
    $query = "INSERT INTO pedido (pratos, valor_total, status) VALUES ('$pratos', '$valor_total', '$status')";

    $query_run = mysqli_query($conn, $query);
    header("location: /serveja/client/client-index-mesa1.php");


    //Verifica se a query executou corretamente, caso não irá exibir o erro na tela.
    if (!$query_run) {
        $error = "Invalid query: " . $conn->error;
    }
}

?>

<main>

    <section class="jumbotron text-center mt-5 mb-5">
        <div class="container text-center">
            <h2 class="jumbotron-heading ">Seja bem-vindo, <?php echo $nome; ?></h2>
            <h3>ao<h3>
                    <h1 class="logo text-danger">ServeJá</h1>
                    <p class="lead text-dark">Aproveite todos os pratos logo abaixo!</p>
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
                            <p class='card-text'>Nome: $row[nome_prato] | Valor: R$ $row[preco]</p>
                            <p class='card-text'>Descrição: $row[descricao]</p>
                            <div class='d-flex justify-content-between align-items-center'>
                                <div class='btn-group'>
                                    <button type='button' class='btn btn-sm btn-outline-secondary' data-bs-toggle='modal' data-bs-target='#verModal$row[id]''>Ver</button>
                                    <button type='button' class='btn btn-sm btn-outline-secondary' data-bs-toggle='modal' data-bs-target='#comprarPrato$row[id]''>Comprar</button>
                                </div>
                                <small class='text-muted'>Tempo de preparo: $row[tempo] mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                

                <div class='modal fade' id='verModal$row[id]' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-scrollable'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'>Prato: $row[nome_prato]</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <p class='card-text'>Nome: $row[nome_prato] | Valor: R$ $row[preco]</p>
                                <p>Descrição: $row[descricao]</p>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
                                <button type='button' class='btn btn-primary' data-bs-dismiss='modal' data-bs-toggle='modal' data-bs-target='#comprarPrato$row[id]''>Adicionar ao carrinho</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='modal fade' id='comprarPrato$row[id]' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-scrollable'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title' id='exampleModalLabel'>Prato: $row[nome_prato]</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                            <p class='card-text'>Nome: $row[nome_prato] | Valor: R$ $row[preco]</p>
                            <p>Descrição: $row[descricao]</p>

                            <hr>

                            <form method='POST' action='client-index-mesa1.php?action=add&code=$row[id]' autocomplete='OFF' class='row g-2'>
                            <div class='col-3'>
                                <input type='hidden' name='id_produto' id='id_produto' value='$row[id]'>
                                <label required for='quant' class='form-label'>Quantidade</label>
                                <input required name='quantity' type='number' class='form-control' id='quantity' placeholder='1' value='1'>
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
                            <button type='submit' class='btn btn-primary' value=''>Adicionar ao carrinho</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                ";
                }
                ?>
            </div>
        </div>

        <div class="modal fade" id="verCarrinho" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Carrinho de compras
                        </h5>
                        <a id="btnEmpty" href="client-index-mesa1.php?action=empty">Esvaziar carrinho</a>
                    </div>
                    <div class="modal-body">
                        <?php
                        if (isset($_SESSION["cart_item"])) {
                            $total_quantity = 0;
                            $total_price = 0;
                        ?>
                            <table class="table table-image">
                                <thead>
                                    <tr>
                                        <th scope="col">Pratos</th>
                                        <th scope="col">Preço Unitário</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Quantidade</th>
                                        <th scope="col">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($_SESSION["cart_item"] as $item) {
                                        $item_price = $item["quantity"] * $item["price"];
                                    ?>
                                        <tr>
                                            <td><?php echo $item["name"] ?></td>
                                            <td><?php echo "R$ " . $item["price"]; ?></td>
                                            <td><?php echo "R$ " . number_format($item_price, 2); ?></td>
                                            <td class="qty"><?php echo $item["quantity"]; ?></td>
                                            <td>
                                                <a href="client-index-mesa1.php?action=remove&code=<?php echo $item["id"]; ?>" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                        $total_quantity += $item["quantity"];
                                        $total_price += ($item["price"] * $item["quantity"]);
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="modal-footer d-flex justify-content-end">
                                <h5>Total: <span class="price text-success"><?php echo "R$ " . number_format($total_price, 2); ?></span></h5>
                            </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <form method="POST" action="">
                            <?php
                            foreach ($_SESSION["cart_item"] as $item) {
                                $item_price = $item["quantity"] * $item["price"];
                            ?>
                                <input type="hidden" name="quant" value="<?php echo $item["quantity"] ?>" />
                                <input type="hidden" name="prato" value="<?php echo $item["name"] ?>" />
                                <input type="hidden" name="preco" value="<?php echo $total_price ?>" />
                                <button type="submit" class="btn btn-success" name="checkout">Finalizar Compra</button>
                        </form>
                    </div>
                <?php
                            }
                        } else {
                ?>
                <hr>
                <div class="no-records">Seu carrinho está vazio.</div>
            <?php
                        }
            ?>
                </div>
            </div>
        </div>
        <style>
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

            .modal-footer {
                padding-top: 0rem;
            }
        </style>
</main>