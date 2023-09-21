<?php

class PessoaDAO {

    public function create (Pessoa $Pessoa) {
        $sql = 'INSERT INTO pessoa (nome, email, senha) VALUES (?,?,?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $Pessoa->getNome());
        $stmt->bindValue(2, $Pessoa->getEmail());
        $stmt->bindValue(3, $Pessoa->getSenha());

        $stmt->execute();
    }

    public function read(){
        $sql = 'SELECT * FROM pessoa';

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
        $sql = 'UPDATE pessoa SET nome = ?, email = ?, senha = ? WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $Pessoa->getNome());
        $stmt->bindValue(2, $Pessoa->getEmail());
        $stmt->bindValue(3, $Pessoa->getSenha());

        $stmt->execute();
    }

    public function delete($id) {
        $sql = 'DELETE FROM pessoa WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();
    }
}