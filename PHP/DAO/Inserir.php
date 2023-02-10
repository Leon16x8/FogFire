<?php
      namespace FogFireStore\FogFire\PHP\DAO;

      require_once("DAO/Conexao.php");

      use FogFireStore\FogFire\PHP\DAO\Conexao;
    
    class Inserir{
        public function Cadastrar(Conexao $conexao, string $nomeDaTabela, string $nomeProduto, int $estoque, float $preco){
            try{
                $conn = $conexao->Conectar();//Abrindo conexao com banco
                $sql = "insert into $nomeDaTabela (codigo, nomeProduto, estoque, preco) values ('', '$nomeProduto', '$estoque', '$preco')";//Escrevi o script
                $result = mysqli_query($conn, $sql);//Executa a ação do script no banco

                mysqli_close($conn);//fechando a conexão com sucesso!

                if($result){
                    return "<br><br>|-----------Inserido com Sucesso-----------|";
                }
                return "<br><br>Não Inserido!";
            }catch(Except $erro){
                echo $erro;
            }
        }//fim do cad
    }//fim da class
?>

