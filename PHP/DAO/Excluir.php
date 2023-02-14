<?php
    namespace FogFireStore\FogFire\PHP\DAO;

    require_once("Conexao.php");

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
                    echo "Excluído com sucesso!";
                    return;
                }
                echo "Deu erro!";

            } catch (Except $erro) {
                echo $erro;
            }
        }//Fim do método para excluir
    }//Fim da classe excluir

?>