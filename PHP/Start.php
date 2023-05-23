<?php
@include('PHP/Config.php');
@include('PHP/PratoDAO.php');
@include('PHP/Prato.php');
@include('PHP/Pessoa.php');
@include('PHP/PessoaDAO.php');
@include('PHP/Produtos.php');
@include('PHP/ProdutosDAO.php');
$prato = new Prato();
$pratoDAO = new PratoDAO();
$pessoa = new Pessoa();
$pessoaDAO = new PessoaDAO();
$produtos = new Produtos();
$produtosDAO = new ProdutosDAO();
?>