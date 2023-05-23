<?php

class PratoDAO {

    public function create (Prato $Prato) {
        $sql = 'INSERT INTO prato (nome_prato, descricao, preco) VALUES (?,?,?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $Prato->getNome_Prato());
        $stmt->bindValue(2, $Prato->getDescricao());
        $stmt->bindValue(3, $Prato->getValor());

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
        $sql = 'UPDATE prato SET nome_prato = ?, descricao = ?, valor = ? WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $Prato->getNome_Prato());
        $stmt->bindValue(2, $Prato->getDescricao());
        $stmt->bindValue(3, $Prato->getValor());

        $stmt->execute();
    }

    public function delete($id) {
        $sql = 'DELETE FROM prato WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);

        $stmt->execute();
    }
}