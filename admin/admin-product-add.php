<?php

include "../includes/boostrap.php";
include "navbar-admin.php";
include "../PHP/Config.php";
include "../PHP/PratoDAO.php";
include "../PHP/Prato.php";

$sql = 'INSERT INTO prato (nome_prato, descricao, preco, tempo) VALUES (?,?,?,?)';
$pratoDAO = new PratoDAO();
$prato = new Prato();
$bd = Conexao::getConn()->prepare($sql);
$nome = '';
$valor = '';
$desc = '';
$tempo = '';


if (isset($_POST['voltar'])) {
    header("location: /projeto-serveja/admin/admin-menu.php");
    exit;
}

if (isset($_POST['adicionar_prato'])) {
    $nome = $_POST['nome'];
    $valor = $_POST['valor'];
    $desc = $_POST['desc'];
    $tempo = $_POST['tempo'];
    $tempo = explode(' ', $tempo);
    $tempo = implode($tempo);
    (int)$tempo;

    $img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];
    do{
    foreach ($_POST as $name => $value) {
        $value = trim($value);
        if (empty($value)) {
            header("location: /serveja/admin/index-adm.php");
            exit;
        }
        else {
            
                if ($error === 0) {
                    if ($img_size > 1250000) {
                        $em = "Sorry, your file is too large.";
                        header("Location: /serveja/admin/admin-menu.php?error=$em");
                    }else {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);
            
                        $allowed_exs = array("jpg", "jpeg", "png", "webp"); 
            
                        if (in_array($img_ex_lc, $allowed_exs)) {
                            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                            $img_upload_path = '../upload/'.$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
            
                            $prato->setNome_Prato($nome);
                            $prato->setvalor($valor);
                            $prato->setDescricao($desc);
                            $prato->setTempo($tempo);
                            $prato->setImage($new_img_name);
                                    
                            $pratoDAO->create($prato);
            
                            header("Location: /serveja/admin/admin-menu.php");
                            exit;
                        }
                    }
            
                }
        }
    }
} while (false);
            
            
header("location: /serveja/admin/admin-menu.php");
exit;
}

?>

<h2 class="h2 mb-3">Adicionar Prato</h2>
<div class="container">

    <div class="container d-flex justify-content-center">
        <form action="" method="POST" autocomplete="OFF" class="row g-2" enctype='multipart/form-data'>
            <!-- <div class="code col-sm-10 mb-1 disabled">
                <label for="codigo" disabled class="form-label">Código do Prato</label>
                <input type="text" disabled name="codigo" value="<?php $codigo = uniqid(); echo $codigo; ?>">
            </div> -->
            <div class="col-md-3">
                <label required for="nome" class="form-label">Nome do Prato</label>
                <input required name="nome" type="text" class="form-control" id="nome" placeholder="Hamburguer">
            </div>
            <div class="col-sm-2">
                <label required for="valor" class="form-label">Valor</label>
                <input required name="valor" type="number" class="form-control" id="valor" placeholder="Valor do Prato">
            </div>
            <div class="col-3">
                <label required for="tempo" class="form-label">Tempo de preparo</label>
                <input required name="tempo" type="text" class="form-control" id="tempo" placeholder="Inserir tempo em minutos...">
            </div>
            <div class="col-sm-8 mb-3">
                <label required for="desc" class="form-label">Descrição</label>
                <input required name="desc" type="text" class="form-control" id="desc" placeholder="Descrição do prato com ingredientes...">
            </div>
            <div class="col-sm-8 mb-3">
                <label required for="file" class="form-label">Foto do prato</label>
                <input required name="my_image" type="file" class="form-control">
            </div>

            <div class="col-12">
                <button name="adicionar_prato" type="submit" class="btn btn-primary">Cadastrar Produto</button>
                <button name="voltar" type="submit" class="btn btn-danger">Cancelar</button>
            </div>
        </form>
    </div>
</div>
<style>
    h2 {
        margin-left: 5.5rem;
    }
    .code {
        user-select: none;      
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        -o-user-select: none;
    }
</style>