<?php
namespace FogFireStore\FogFire\PHP;
use FogFireStore\FogFire\PHP\DAO\Conexao;
require_once('DAO/Conexao.php');

session_start();
if(!isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = array();
}

// verifica a ação
if(isset($_GET['acao'])){
    // se é adiocionar produto
    if($_GET['acao'] == 'add'){
        $id = $_GET['id'];
        if(!isset($_SESSION['carrinho'] [$id])){
            $_SESSION['carrinho'][$id] = 1; // quantidade recebera 1
        }else{
            $_SESSION['carrinho'][$id] += 1;
        }
    }

    //REMOVER O PRODUTO DO ARRAY
    if ($_GET['acao'] == 'del')
    {
        $id = $_GET['id'];
        if (isset($_SESSION['carrinho'][$id]))
        {
            unset($_SESSION['carrinho'][$id]);
        }
    }
}
?>
<head>
    <!--Estilos Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Efeitos Personalizados -->
    <link rel="stylesheet" type="text/css" href="../CSS/efeitos.css" />
</head>
<body>
    <h1 class="titulo">Carrinho de Compras</h1>

    <form action="?acao=up" method="post">
        <p><input type="submit" class="btn btn-secondary" value="Atualizar"/></p>
        <a href="index.php" class="btn btn-secondary">Continuar comprando...</a>
    </form>

<?php
    if(count($_SESSION['carrinho'])==0 ){
        echo 'Não há produto no carrinho';
    }else{
        echo "<table border='1' width='50%'>
            <tr>
                <th width='40'>ID</th>
                <th width='244'>Produto</th>
                <th width='60'>Qtd</th>
                <th width='89'>Preço</th>
                <th width='100'>Subtotal</th>
                <th width='64'>Remover</th>
            </tr>";
            $conexao = new Conexao();
            $conn = $conexao->conectar();
        // percorre o array
        foreach ($_SESSION['carrinho'] as $id => $qtd){
            $sql = "SELECT id,nomeProduto,estoque,preco
                    FROM produtos WHERE ID = '$id'";
            $resultado = mysqli_query($conn,$sql) or die (mysqli_error());
            $linha = mysqli_fetch_array($resultado);

            $nomeProduto = $linha[1];
            $precoProduto = number_format($linha[2],2,',',',');
            $subtotal = number_format($linha[2] * $qtd,2,',','.');
       
            echo " 
            <tr>
                <th width='40'>$id</th>
                <th width='244'>$nomeProduto</th>
                <th width='60'>$qtd</th>
                <th width='89'>$precoProduto</th>
                <th width='100'>$subtotal</th>
                <th width='64'><a href='carrinho.php?acao=del&id=$id'>REMOVER</a></th>
            </tr>";
        }
        echo '</table>';
        echo '<br><a href="finalizarcompra.php" class="btn btn-secondary">Finalizar Pedido</a>';
    }
?>

</body>