<?php

class Prato{
    protected string $nome_prato;
    protected string $descricao;
    protected string $valor;

    function getNome_Prato(){
        return $this->nome_prato;
    }
    function setNome_Prato($nome_prato){
        $this->nome_prato = $nome_prato;
    }

    function getDescricao(){
        return $this->descricao;
    }
    function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    function getvalor(){
        return $this->valor;
    }
    function setvalor($valor){
        $this->valor = $valor;
    }
}