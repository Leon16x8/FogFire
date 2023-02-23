<?php

    namespace FogFireStore\FogFire\PHP;
    use FogFireStore\FogFire\PHP\DAO\Conexao;
    require_once('DAO/Conexao.php');

    session_start();
    //verifica se não existe a sessão responsavel por guardar valores
    if(!isset($_SESSION['carrinho'])){
        $_SESSION['carrinho'] = array();
}

// verifica a ação
if(isset($_GET['acao'])){
    //Adiocionar produto
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
            //limpa o produto do carrinho
            unset($_SESSION['carrinho'][$id]);
        }
    }
    
    //ATUALIZAR CARRINHO DE COMPRAS
    if ($_GET['acao'] == 'up'){
        if (is_array($_POST['prod'])){
            foreach($_POST['prod'] as $id => $qtd){
                $id = intval($id);
                $qtd = intval($qtd);
                if (!empty($qtd) || $qtd <> 0){
                    $_SESSION['carrinho.php'][$id] = $qtd;
                }else{
                    unset($_SESSION['carrinho.php'][$id]);//limpa o conteudo
                }
            }
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
        <a href="index.php" class="btn btn-secondary">Continuar comprando...</a>

<?php
    if(count($_SESSION['carrinho'])==0 ){
        echo 'Não há produto no carrinho';
    }else{
        echo "<table border='1' width='50%'>
        <thead>
            <tr>
                <th width='40'>ID</th>
                <th width='244'>Produto</th>
                <th width='60'>Qtd</th>
                <th width='89'>Preço</th>
                <th width='100'>Subtotal</th>
                <th width='64'>Remover</th>
            </tr>
        </thead>";
            $conexao = new Conexao();
            $conn = $conexao->conectar();

        $_SESSION['dados'] = array();

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
            <tbody>
                <tr>
                    <td class='tzen' width='40'>$id</td>
                    <td width='244'>$nomeProduto</td>
                    <td width='60'>$qtd</td>
                    <td width='89'>R$$precoProduto</td>
                    <td width='100'>R$$subtotal</td>
                    <td width='64'><a href='carrinho.php?acao=del&id=$id'>REMOVER</a></th>
                </tr>
            </tbody";

            array_push($_SESSION['dados'],
            array('$id' => $id,
            'quantidade' => $qtd,
            'preco' => $precoProduto,
            'total' => $subtotal
            )
            );//ArrayPush
        
        }
        echo '</table>';
        echo '<br><a href="finalizarcompra.php" class="btn btn-secondary">Finalizar Pedido</a>';
    }
?>
    <p><input type="submit" value="Atualizar"/></p>
    </form>
<?php
    if ( count($_SESSION['carrinho.php'])<>0){
        echo "<form action='' method='get'>
            <p><input type='submit' name='finalizar' value='Finalizar Pedido'/></p>
            </form>";
    }

    if (isset($_GET['finalizar'])){
        $sqlvendas = 'INSERT INTO vendas (DATAHORA, TOTAL) values (CURRENT_TIMESTAMP, 0)';
        mysqli_query($conn, $sqlvendas) ;

        //consulta para pegar o ultimo pedido
        $x = 'select max(codigo) as maiorcodigo from vendasitens';
        $queryconsulta = mysqli_query($conn, $x) or die (mysqli_error());
        $linha = mysqli_fetch_assoc($queryconsulta);
        $ultpedido = 0;
        $ultpedido = $linha('maiorcodigo');
        echo '<b><i>ULTIMO PEDIDO: </i></b>'. $ultpedido;
        
        //percorrer a array
        foreach ($_SESSION('carrinho.php') as $id => $qtd){
            //Pegando preço do produto
            $sql = "select id, nomeProduto, preco from  produtos where id = '$id'";
            $resultado = mysqli_query($conn, $sql) or die (mysqli_error());
            $registro = mysqli_fetch_array($resultado);
            $valor = $registro[2]*$qtd;
            $inspeditem = "insert into vendasitens (produto, qtd, valor, pedido) values ($id, $qtd, $valor, $ultpedido)";
            mysqli_query($conn, $inspeditem) or die (mysqli_error());
        }
        echo "<br/><br/>Pedido finalizado com sucesso !</form>";

        echo "<form action='' method='get''>
                <p><input type='submit' name='sair' value='Clique para sair'</p>
              </form>";  

        if(!isset($_GET['sair'])){
            //remover varaveis de sessão
            session_unset();
            //destroir sessão
            session_destroy();
        }
    }


?>

</body>