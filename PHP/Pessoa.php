<?php

class Pessoa{
    protected string $nome;
    protected string $email;
    protected int $senha;
    protected string $cpf;

    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getEmail(){
        return $this->email;
    }
    public final function setEmail($email){
        $this->email = $email;
    }
    public function getSenha(){
        return $this->senha;
    }
    public final function setSenha($senha){
        $this->senha = $senha;
    }
    public function getCPF(){
        return $this->cpf;
    }
    public function setCPF($cpf){
        $this->cpf = $cpf;
    }
}

//Cliente
class Cliente extends Pessoa{

}

//Funcionario
class Funcionario extends Pessoa{
}

//ADM
class ADM extends Pessoa{

}