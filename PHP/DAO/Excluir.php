<?php
namespace FogFireStore\FogFire\PHP\DAO;

require_once("DAO/Conexao.php");

use FogFireStore\FogFire\PHP\DAO\Conexao;

class Excluir
{
    public function excluir(Conexao $conexao, string $nomeDaTabela, int $codigo)
    {
        try {
            $conn = $conexao->Conectar();
            $sql = "delete from $nomeDaTabela where codigo = '$codigo'";
            $result = mysqli_query($conn, $sql);

            mysqli_close($conn);

            if ($result) {
                return;
            }

        } catch (Except $erro) {
            echo $erro;
        }
    }
}

?>