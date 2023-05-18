<?php
class Conexao {
    private static $instance;

    public static function getConn(){

        if (!isset(self::$instance)){
            self::$instance = new \PDO('mysql:localhost,dbname=serve_ja', 'root', '');
        }
        return self::$instance;
    }
}
/*
$usuario = 'root';
$senha = '';
$database = 'serve_ja';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}
*/