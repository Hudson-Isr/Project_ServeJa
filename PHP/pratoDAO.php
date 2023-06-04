<?php

class PratoDAO {

    public function create (Prato $Prato) {
        $sql = 'INSERT INTO prato (nome_prato, descricao, preco, tempo, image_url) VALUES (?,?,?,?,?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $Prato->getNome_Prato());
        $stmt->bindValue(2, $Prato->getDescricao());
        $stmt->bindValue(3, $Prato->getValor());
        $stmt->bindValue(4, $Prato->getTempo());
        $stmt->bindValue(5, $Prato->getImage());

        $stmt->execute();
    }

    public function read(){
        $sql = 'SELECT * FROM prato';

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
        $sql = 'UPDATE prato SET nome_prato = ?, descricao = ?, preco = ?, tempo = ? WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $Prato->getNome_Prato());
        $stmt->bindValue(2, $Prato->getDescricao());
        $stmt->bindValue(3, $Prato->getValor());
        $stmt->bindValue(4, $Prato->getTempo());
        $stmt->bindValue(5, $Prato->getId());

        $stmt->execute();
    }

    public function updateImg($image_url, $id) {
        $sql = 'UPDATE prato SET image_url = ? WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $image_url);
        $stmt->bindValue(2, $id);

        $stmt->execute();
    }

    public function delete($id) {
        $sql = 'DELETE FROM prato WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();
    }
}