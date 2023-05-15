<?php

class Pessoa {

    public function create (Pessoa $Pessoa) {
        $sql = 'INSERT INTO Pessoa (nome, email, senha, CPF) VALUES (?,?,?,?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $Pessoa->getNome());
        $stmt->bindValue(2, $Pessoa->getEmail());
        $stmt->bindValue(3, $Pessoa->getSenha());
        $stmt->bindValue(4, $Pessoa->getCPF());

        $stmt->execute();
    }

    public function read(){
        $sql = 'SELECT * FROM Pessoa';

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        }else{
            return [];
        }
    }

    public function update(Pessoa $Pessoa) {
        $sql = 'UPDATE Pessoa SET nome = ?, email = ?, senha = ?, CPF =  ? WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $Pessoa->getNome());
        $stmt->bindValue(2, $Pessoa->getEmail());
        $stmt->bindValue(3, $Pessoa->getSenha());
        $stmt->bindValue(4, $Pessoa->getCPF());

        $stmt->execute();
    }

    public function delete($id) {
        $sql = 'DELETE FROM Pessoa WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();
    }
}