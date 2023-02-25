<?php
namespace FogFireStore\FogFire\PHP;

require_once("DAO/Conexao.php");
require_once("DAO/Inserir.php");

use FogFireStore\FogFire\PHP\DAO\Conexao;
use FogFireStore\FogFire\PHP\DAO\Inserir;


$conn = new Conexao;
$cadd = new Inserir;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Compras</title>
</head>

<body>
    <!-- CONSULTA -->

    <div class="caixaBloco">

        <form method="GET">

            <div class="container">
                <div class="row">
                    <?php

                    $sql = "SELECT * FROM vendasitens";
                    if ($res = mysqli_query($conn->conectar(), $sql)) {
                        $id = array();
                        $produto = array();
                        $qtd = array();
                        $valor = array();
                        $pedido = array();
                        $i = 0;
                        while ($reg = mysqli_fetch_assoc($res)) {
                            $id[$i] = $reg['id'];
                            $produto[$i] = $reg['produto'];
                            $qtd[$i] = $reg['qtd'];
                            $valor[$i] = $reg['valor'];
                            $pedido[$i] = $reg['pedido'];
                            ?>
                            <div class="col-sm-2 itensCadastrados text-center">
                                <label>
                                    <?php echo "<br>Id Produto:   " . $id[$i] . "<br>Nome do Produto:   " . $produto[$i] . "<br>Quantidade:   " . $quantidade[$i] . " R$<br>Quantidade:   " . $estoqueProduto[$i]; ?>
                                </label>
                                <br>
                            </div>
                            <?php
                            $i++;
                        }
                    }

                    ?>
                </div>
            </div>
        </form>
    </div> <!--Fim do Botão Consultar-->

</body>

</html>
