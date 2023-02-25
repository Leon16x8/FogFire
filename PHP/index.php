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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FogFire Store</title>
    <link rel="shortcut icon type" type="image/x-icon" href="../Fotos/estrela.png" />
    <!--Estilos Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Efeitos Personalizados -->
    <link rel="stylesheet" type="text/css" href="../CSS/efeitos.css" />

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
        integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<header>

</header>

<body>

    <div id="fotoFundos">

        <form method="POST">
            <h1 class="titulo">Adicionar Produtos</h1>
            <div class="forms">

                <label>Produto: </label><br>
                <input class="input" type="text" name="tProduto" placeholder="Nome do Produto" required /><br><br>

                <label>Quantidade: </label><br>
                <input class="input" type="number" name="tQuantidade" placeholder="Quantidade do Produto"
                    required /><br><br>

                <label>Preço: </label><br>
                <input id="currency" class="input" type="text" name="tPreco" placeholder="Valor do Produto"
                    required /><br><br>

                <button class="btnCris" type="submit" name="enviar" value="Cadastrar">Cadastrar Produto</button>

                <?php
                if (isset($_POST['enviar'])) {
                    $conexao = new Conexao();
                    $cad = new Inserir();
                    echo $cad->cadastrar($conexao, "produtos", $_POST['tProduto'], $_POST['tQuantidade'], $_POST['tPreco']);
                }

                ?>

            </div>

        </form>

        <!-- CONSULTA -->

        <div class="caixaBloco">
            <form method="GET">

                <div class="container">
                    <div class="row">
                        <?php

                        $sql = "SELECT * FROM PRODUTOS";
                        if ($res = mysqli_query($conn->conectar(), $sql)) {
                            $nomeProduto = array();
                            $estoqueProduto = array();
                            $precoProduto = array();
                            $i = 0;
                            while ($reg = mysqli_fetch_assoc($res)) {
                                $id[$i] = $reg['id'];
                                $nomeProduto[$i] = $reg['nomeProduto'];
                                $estoqueProduto[$i] = $reg['estoque'];
                                $precoProduto[$i] = $reg['preco'];
                                ?>
                                <div class="col-sm-2 itensCadastrados text-center">
                                    <label>
                                        <?php echo "<br>Descrição:   " . $nomeProduto[$i] . "<br>ID:   " . $id[$i] . "<br>Valor:   " . $precoProduto[$i] . " R$<br>Quantidade:   " . $estoqueProduto[$i]; ?>
                                    </label>
                                    <br>
                                    <div>
                                        <div class="btn-group btn-group-sm" role="group" arial-label="Basic sample">
                                            <a href="Atualizar.php?id=<?php echo $id[$i]; ?>" class="btn btn-primary"><img
                                                    src='../Fotos/lapis.png' style='width:44px;height:36px;'>Editar</a>
                                            <a href="DAO/Excluir.php?id=<?php echo $id[$i]; ?>" class="btn btn-danger"><img
                                                    src='../Fotos/excluir.png' style='width:44px;height:36px;'>Excluir</a>
                                            <!--<buton>--><a href="carrinho.php?acao=add&id=<?php echo $id[$i]; ?>"
                                                class="btn btn-secondary"><img src='../Fotos/carrinho.png'
                                                    style='width:44px;height:36px;'><span id="tCard">Add
                                                    Cart</span></a><!--</buton>-->
                                        </div>
                                    </div>
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
    </div><!--Fim da div para foto fundos-->
</body>
<script>$(function () { $('#currency').maskMoney(); })</script>

</html>