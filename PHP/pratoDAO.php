<?php

class Prato {

    public function create (Prato $Prato) {
        $sql = 'INSERT INTO Prato (nome, descricao, preco) VALUES (?,?,?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $Prato->getNome_Prato());
        $stmt->bindValue(2, $Prato->getDescricao());
        $stmt->bindValue(3, $Prato->getpreco());

        $stmt->execute();
    }

    public function read(){
        $sql = 'SELECT * FROM Prato';

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        }else{
            return [];
        }
    }

    public function update(Prato $Prato) {
        $sql = 'UPDATE Prato SET nome = ?, descricao = ?, preco = ? WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $Prato->getNome_Prato());
        $stmt->bindValue(2, $Prato->getDescricao());
        $stmt->bindValue(3, $Prato->getpreco());

        $stmt->execute();
    }

    public function delete($id) {
        $sql = 'DELETE FROM Prato WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();
    }
}