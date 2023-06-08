<?php
@include('Config.php');
@include('PratoDAO.php');
@include('Prato.php');
@include('Pessoa.php');
@include('PessoaDAO.php');
@include('Codigo.php');
@include('../includes/boostrap.php');
$prato = new Prato();
$pratoDAO = new PratoDAO();
$pessoa = new Pessoa();
$pessoaDAO = new PessoaDAO();
?>