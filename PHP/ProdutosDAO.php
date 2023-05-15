<?php

class Produtos {

    public function create (Produtos $Produtos) {
        $sql = 'INSERT INTO Produtos (nome, lote, QTD) VALUES (?,?,?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $Produtos->getNomeProdutos());
        $stmt->bindValue(2, $Produtos->getLotes());
        $stmt->bindValue(3, $Produtos->getQTD());

        $stmt->execute();
    }

    public function read(){
        $sql = 'SELECT * FROM Produtos';

        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        }else{
            return [];
        }
    }

    public function update(Produtos $Produtos) {
        $sql = 'UPDATE Produtos SET nome = ?, lote = ?, qtd = ? WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $Produtos->getNomeProdutos());
        $stmt->bindValue(2, $Produtos->getLotes());
        $stmt->bindValue(3, $Produtos->getQTD());

        $stmt->execute();
    }

    public function delete($id) {
        $sql = 'DELETE FROM Produtos WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();
    }
}