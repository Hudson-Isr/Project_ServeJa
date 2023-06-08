<?php

@include "navbar-admin.php";
@include '../PHP/Start.php';

// FAZER GRÁFICO 
$id = '';
$nome = '';
$valor = '';
$descricao = '';
$tempo = '';

$error = '';
$certo = '';

if (isset($_POST['alterar_prato'])) {
    do {

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $descricao = $_POST['descricao'];
        $tempo = $_POST['tempo'];
        $codigo = uniqid();   

        $img_name = $_FILES['my_image']['name'];
        $teste = trim($img_name);

        $sql = 'UPDATE prato SET nome_prato = ?, descricao = ?, valor = ?, tempo = ? WHERE id = $id';
        $pratoDAO = new PratoDAO();
        $prato = new Prato();
        $bd = Conexao::getConn()->prepare($sql);

        $prato->setNome_Prato($nome);
        $prato->setvalor($valor);
        $prato->setDescricao($descricao);
        $prato->setTempo($tempo);
        $prato->setId($id);

        if (!empty($teste)) {
            $img_size = $_FILES['my_image']['size'];
            $tmp_name = $_FILES['my_image']['tmp_name'];
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $image_url = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = '../upload/' . $image_url;
            move_uploaded_file($tmp_name, $img_upload_path);

            $pratoDAO->updateImg($image_url, $id);
        } else {
            $pratoDAO->update($prato);
            header('location: /serveja/admin/admin-menu.php');
            exit;
        }
    } while (false);
}

//Função do botão 'Voltar';
if (isset($_POST['voltar'])) {
    header('location: /serveja/admin/admin-menu.php');
    exit;
}

?>


<div class='d-flex justify-content-between'>
    <?php
    if (!empty($error)) {
        echo "
                        <div class='erros position-absolute alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$error</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div
                        ";
        header('Refresh:3; url=admin-menu.php');
    }
    ?>
    <h2 class='h2'>Pratos:</h2>
    <button href='<?php $caminho ?>admin-product-add.php' class='btn btn-success me-5' type='button'><a class='add' href='<?php $caminho ?>admin-product-add.php'>Adicionar Prato</a></button>
</div>
<div class='album py-5 bg-light'>
    <div class='container'>
        <div class='row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3'>
            <?php
            //Leitura de todas as colunas da tabela
            $sql = 'SELECT * FROM prato';
            $conn = new mysqli('localhost', 'root', '', 'serveja');
            $result = $conn->query($sql);

            if (mysqli_num_rows($result) == 0) {
                echo "
                <div class='vazio container text-center d-flex justify-content-center'>
                    <div class='row g-3'>
                        <h3 class='col col-lg-3'>Parece que não tem nenhum prato cadastrado...</h3>
                        <img class='col-md-auto ' src='/serveja/images/deconstructed-food-amico.svg'>
                        <h3 class='col'>Que tal adicionar algum?</h3>
                    </div>
                </div>
                ";
            }

            if (!$result) {
                die('Query inválida: ' . $conn->error);
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
                                    <button type='button' class='btn btn-sm btn-outline-secondary' data-bs-toggle='modal' data-bs-target='#verModal$row[id]''>Editar</button>
                                    <button type='submit' class='btn btn-sm btn-outline-secondary'><a class='del' href='/serveja/admin/delete-prato.php?id=$row[id]'>Excluir</a></button>
                                </div>
                                <small class='text-muted'>Tempo de preparo:<b> $row[tempo] mins </b></small>
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
                                <p class='card-text'><b>Nome atual:</b> $row[nome_prato] | <b>Valor atual:</b> R$ $row[preco]</p>
                                <p><b>Descrição:</b> $row[descricao]</p>
                            </div>
                            <hr>
                            <div class='container'>
                                <form class='row' action='' method='POST' autocomplete='OFF' class='column' enctype='multipart/form-data'>
                                    <input type='hidden' name='id' value='$row[id]'>
                                    <div class='col-sm-4'>
                                        <label for='nome' class='form-label'><b>Novo Nome</b></label>
                                        <input required onchange='this.value = this.value.trim()' name='nome' type='text' class='form-control' id='nome' value='$row[nome_prato]' placeholder='Hamburgão'>
                                    </div>
                                    <div class='col-sm-4'>
                                        <label for='valor' class='form-label'><b>Novo Valor</b></label>
                                        <input required onchange='this.value = this.value.trim()' name='valor' type='number' class='form-control' id='valor' value='$row[preco]' placeholder='16'>
                                    </div>
                                    <div class='col-sm-4'>
                                        <label for='tempo' class='form-label'><b>Novo Tempo</b></label>
                                        <input required onchange='this.value = this.value.trim()' name='tempo' type='number' class='form-control' value='$row[tempo]' id='tempo'>
                                    </div>
                                    <div class='col mb-3 mt-3'>
                                        <label for='descricao' class='form-label'><b>Nova Descrição</b></label>
                                        <textarea required onchange='this.value = this.value.trim()' style='resize: none;' name='descricao' class='form-control' id='descricao' rows='5'></textarea>
                                    </div>
                                    <div class='col mb-3 mt-3'>
                                        <label for='file' class='form-label'><b>Foto do prato</b></label>
                                        <input name='my_image' type='file' class='form-control'>
                                    </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
                                    <button type='submit' name='alterar_prato' class='btn btn-primary'>Salvar Alterações</button>
                                </div>
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
    <style>
        .vazio img {
            width: 250px !important;
            margin-top: 3.5rem !important;
        }

        .vazio {
            white-space: nowrap;
        }

        h2 {
            margin-left: 5.5rem;
        }

        .add {
            text-decoration: none;
            color: #fff;
        }

        .del {
            text-decoration: none;
            color: #6c757d;
        }

        .del:hover {
            color: #fff;
        }

        .card-text {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
    </style>