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
    <!--Estilos Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Efeitos Personalizados -->
    <link rel="stylesheet" type="text/css" href="../CSS/efeitos.css" />
</head>

<header>
    <section class="site">
        <h1>Fog Fire</h1>
        <nav>
            <a href="Index.php">Home</a>
            <a href="AdicionarProduto.php">Adicionar Produtos</a>
            <a href="transacoes.php">Transações</a>
            <a href="carrinho.php">Carrinho</a>
        </nav>
    </section>
</header>

<body>

    <h1 class="titulo">Transações</h1>
    <!-- CONSULTA -->

    <div>
        <form method="GET">
            <?php
            echo "<table class='table table-striped table-dark'>
                            <thead>
                            <tr>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Qtd</th>
                            <th>Valor</th>
                            <th>Pedido</th>
                            </tr>
                        </thead>";

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
                    <div class='table table-striped table-dark'>

                            <?php echo " 
                                <tbody>
                                    <tr>
                                        <td>$id[$i]</td>
                                        <td>$produto[$i]</td>
                                        <td>$qtd[$i]</td>
                                        <td>R$$valor[$i]</td>
                                        <td>$pedido[$i]</td>
                                    </tr>
                                </tbody";?>

                        <br>
                    </div>
                    <?php
                    $i++;
                }
            }

            ?>

        </form>
    </div> <!--Fim do Botão Consultar-->

</body>

</html>