<?php

    require "../PHP/Start.php";
    if (isset($_GET["id"])){
        $id = $_GET["id"];

        $sql = 'DELETE FROM prato WHERE id = ?';
        $bd = Conexao::getConn()->prepare($sql);
        $pratoDAO = new PratoDAO();
        $prato = new Prato();
        $prato->setId($id);
        $pratoDAO->delete($id);
    }

    header("location: /serveja/admin/admin-menu.php");
    exit;

?>