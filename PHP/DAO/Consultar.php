<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
      namespace FogFireStore\FogFire\PHP\DAO;

      require_once("DAO/Conexao.php");

      use FogFireStore\FogFire\PHP\DAO\Conexao;

    class Consultar{
        public function consultarIndividual(Conexao $conexao, string $nomeDaTabela, int $codigo){
            try{
                $conn = $conexao->Conectar();
                $sql = "select * from $nomeDaTabela where codigo = '$codigo'";
                $result = mysqli_query($conn,$sql);

                while($dados = mysqli_fetch_array($result)){
                    if($dados['codigo'] == $codigo){
                        echo " Codigo: " . $dados["codigo"] . " Nome Produto: " . $dados["nomeProduto"] . " Quantidade: " . $dados["quantidade"]."Preço: R$".$dados["preco"];
                        return;
                    }
                }
                echo "Código digitado não foi encontrado!";
            }catch(Except $erro){
                echo $erro;
            }
        }//Fim da função Consultar Individual

        public function consultarTudo(Conexao $conexao, string $nomeDaTabela){
            try{
                $conn = $conexao->Conectar();
                $sql = "select * from $nomeDaTabela";
                if($result = mysqli_query($conn,$sql)){
                    $nomeProduto = array();
                    $estoqueProduto = array();
                    $precoProduto = array();
                    $i = 0;
                    while ($reg=mysqli_fetch_assoc($result)){
                        $nomeProduto[$i] = $reg['nomeProduto'];
                        $estoqueProduto[$i] = $reg['estoque'];
                        $precoProduto[$i] = $reg['preco'];
                    }

                }
            }catch(Except $erro){
                echo $erro;
            }
        }
    }//fim da class consultar
?>
</body>
</html>




