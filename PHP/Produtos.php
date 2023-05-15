<?php

class Produtos{
    protected string $nome_produtos;
    protected string $lotes;
    protected string $QTD;

    //Nome do produto
    public function getNomeProdutos(){
        return $this->nome_produtos;
    }
    public function setNomeProdutos($nome_produtos){
        $this->nome_produtos = $nome_produtos;
    }

    //Codigo do lote
    public function getLotes(){
        return $this->lotes;
    }
    public function setLotes($lotes){
        $this->lotes = $lotes;
    }

    //QTD de alimentos
    public function getQTD(){
        return $this->QTD;
    }
    public function setQTD($QTD){
        $this->QTD = $QTD;
    }
}