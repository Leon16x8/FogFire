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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FogFire Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <form method="post">
    <div>
        <h1>Adicionar Produtos</h1>

        <label>Produto: </label>
        <input type="text" name="tProduto" placeholder="Nome do Produto" required/><br><br>

        <label>Quantidade: </label>
        <input type="number" name="tQuantidade" placeholder="Quantidade do Produto" required/><br><br>

        <label>Preço: </label>
        <input type="number" name="tPreco" placeholder="Valor do Produto" required/><br><br>

        <button>Cadastrar Produto</button>

        <?php
            $conexao = new Conexao();
            $cad     = new Inserir();
            echo $cad->cadastrar($conexao, "produtos" ,$_POST['tProduto'],$_POST['tQuantidade'],$_POST['tPreco']);
        ?>
    
    </div>
        
    </form>
    <div>
    <form>
        <h1>Consultar</h1> 

        <?php
            $conexao = new Conexao();
            $consul  = new Consultar();
            echo $consul->consultarTudo($conexao, "produtos");
        ?>


    </form>
    </div>
</body>
</html>