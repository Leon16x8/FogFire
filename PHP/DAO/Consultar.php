<?php

namespace FogFireStore\FogFire\PHP\DAO;

require_once("DAO/Conexao.php");

use FogFireStore\FogFire\PHP\DAO\Conexao;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href=".../CSS/efeitos.css" />
    <title>Document</title>
</head>

<body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

    <main class="container">
        <div class="row">
            <?php
            class Consultar
            {
                public function consultarIndividual(Conexao $conexao, string $nomeDaTabela, int $codigo)
                {
                    try {
                        $conn = $conexao->Conectar();
                        $sql = "select * from $nomeDaTabela where codigo = '$codigo'";
                        $result = mysqli_query($conn, $sql);

                        while ($dados = mysqli_fetch_array($result)) {
                            if ($dados['codigo'] == $codigo) {
                                echo " Codigo: " . $dados["codigo"] . " Nome Produto: " . $dados["nomeProduto"] . " Quantidade: " . $dados["quantidade"] . "Preço: R$" . $dados["preco"];
                                return;
                            }
                        }
                        echo "Código digitado não foi encontrado!";
                    } catch (Except $erro) {
                        echo $erro;
                    }
                } //Fim da função Consultar Individual
            
                public function consultarTudo(Conexao $conexao, string $nomeDaTabela)
                {

                    $conn = $conexao->Conectar();
                    $sql = "select * from $nomeDaTabela";
                    if ($result = mysqli_query($conn, $sql)) {
                        $nomeProduto = array();
                        $estoqueProduto = array();
                        $precoProduto = array();
                        $i = 0;

                        if ($_POST['tProduto'] == "" && $_POST['tQuantidade'] == "" && $_POST['tPreco'] == "") {
                            echo "Vazio";
                            return;
                        }
                        while ($reg = mysqli_fetch_assoc($result)) {
                            $nomeProduto[$i] = $reg['nomeProduto'];
                            $estoqueProduto[$i] = $reg['estoque'];
                            $precoProduto[$i] = $reg['preco'];
                            ?>

                            <div class="col-md-3">
                                <label>
                                    <?php echo $nomeProduto[$i]; ?>
                                </label>
                            </div>
                            <?php $i++;


                        }
                    }
                }
            } //fim da class consultar
            ?>
        </div>
    </main>
</body>

</html>