<?php
namespace FogFireStore\FogFire\PHP\DAO;

class Conexao
{
    public function conectar()
    {
        try {
            $conn = mysqli_connect('localhost', 'root', '', 'FogFire');
            if ($conn) {
                return $conn;
            }
        } catch (Except $erro) {
            echo $erro;
        }
    } //fim do metodo conectar
} //fim da classe
?>