<?php
namespace FogFireStore\FogFire\PHP;

require_once("DAO/Conexao.php");
require_once("DAO/Inserir.php");
require_once("DAO/Consultar.php");


use FogFireStore\FogFire\PHP\DAO\Conexao;
use FogFireStore\FogFire\PHP\DAO\Inserir;
use FogFireStore\FogFire\PHP\DAO\Consultar;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FogFire Store</title>
    <!--Estilos Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Efeitos Personalizados -->
    <link rel="stylesheet" type="text/css" href="../CSS/efeitos.css" />
    <!-- Tipografia -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Irish+Grover&display=swap" rel="stylesheet">
</head>

<header>

</header>

<body>
    <div id="fotoFundos">
        <form method="post">

            <div class="forms">
                <h1 class="titulo">Adicionar Produtos</h1>

                <label>Produto: </label><br>
                <input class="input" type="text" name="tProduto" placeholder="Nome do Produto" required /><br><br>

                <label>Quantidade: </label><br>
                <input class="input" type="number" name="tQuantidade" placeholder="Quantidade do Produto"
                    required /><br><br>

                <label>Preço: </label><br>
                <input id="inpuSmall" class="input" type="number" name="tPreco" placeholder="Valor do Produto"
                    required /><br><br>

                <button>Cadastrar Produto</button>

                <?php
                $conexao = new Conexao();
                $cad = new Inserir();
                echo $cad->cadastrar($conexao, "produtos", $_POST['tProduto'], $_POST['tQuantidade'], $_POST['tPreco']);
                ?>

            </div>

        </form>

        <div>
            <h1 id="Estoque">Estoque</h1>
            <main class="container">
                <div class="row">
                    <div class="col-md-3">
                        <form id="something">

                            <?php
                            $conexao = new Conexao();
                            $consul = new Consultar();
                            echo $consul->consultarTudo($conexao, "produtos");
                            ?>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>


</html>