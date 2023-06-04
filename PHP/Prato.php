<?php

class Prato{
    protected string $id;
    protected string $nome_prato;
    protected string $descricao;
    protected string $valor;
    protected string $tempo;
    protected string $codigo;
    protected $image_url;

    function getId(){
        return $this->id;
    }
    function setId($id){
        $this->id = $id;
    }

    function getCodigo(){
        return $this->codigo;
    }
    function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    function getImage(){
        return $this->image_url;
    }
    function setImage($image_url){
        $this->image_url = $image_url;
    }

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

    function getTempo(){
        return $this->tempo;
    }
    function setTempo($tempo){
        $this->tempo = $tempo;
    }

}