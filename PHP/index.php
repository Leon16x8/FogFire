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
        <link rel="shortcut icon type" type="image/x-icon" href="../Fotos/icon.ico"/>
        <!--Estilos Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <!-- Efeitos Personalizados -->
        <link rel="stylesheet" type="text/css" href="../CSS/efeitos.css" />

    </head>

    <header>

    </header>

    <body>

        <div id="fotoFundos">
            
            <form method="POST">

                <div class="forms">
                    <h1 class="titulo">Adicionar Produtos</h1>

                    <label>Produto: </label><br>
                    <input class="input" type="text" name="tProduto" placeholder="Nome do Produto" required /><br><br>

                    <label>Quantidade: </label><br>
                    <input class="input" type="number" name="tQuantidade" placeholder="Quantidade do Produto"
                        required /><br><br>

                    <label>Preço: </label><br>
                    <input id="inpuSmall" class="input" type="number" step=".01" name="tPreco" placeholder="Valor do Produto"
                        required /><br><br>

                    <button type="submit" name="enviar" value="Cadastrar">Cadastrar Produto</button>
                    
                    <?php
                    if(isset($_POST['enviar'])){
                        $conexao = new Conexao();
                        $cad = new Inserir();
                        echo $cad->cadastrar($conexao, "produtos", $_POST['tProduto'], $_POST['tQuantidade'], $_POST['tPreco']);
                    }
                 
                    ?>

                </div>

            </form>

            <!-- CONSULTA -->

            <form method="GET">
                <button type="submit" name="consultar" class="btn btn-dark">Consultar</button>
                <div class="container"> 
                    <div class="row">
                        <?php
                            if(isset($_GET['consultar'])){
                                $sql= "SELECT * FROM PRODUTOS";
                                if($res=mysqli_query($conn->conectar(), $sql)){
                                    $id = array();
                                    $nomeProduto = array();
                                    $estoqueProduto = array();
                                    $precoProduto = array();
                                    $i = 0;
                                    while($reg = mysqli_fetch_assoc($res)){
                                        $id[$i] = $reg['id'];
                                        $nomeProduto[$i] = $reg['nomeProduto'];
                                        $estoqueProduto[$i] = $reg['estoque'];
                                        $precoProduto[$i] = $reg['preco'];
                                        ?>
                                            
                                            <div class="col-sm-2 itensCadastrados text-center">
                                                <label><?php echo "<br>Descrição:   ".$nomeProduto[$i]."<br>ID:   ".$id[$i]."<br>Valor:   ".$precoProduto[$i]." R$<br>Quantidade:   ".$estoqueProduto[$i]; ?></label>
                                                <br>
                                                <div class="btn-group btn-group-sm" role="group" arial-label="Basic sample">
                                                    <a href="Atualizar.php?id=<?php echo $id[$i];?>" class="btn btn-primary">Editar</a>
                                                    <a href="DAO/Excluir.php?id=<?php echo $id[$i];?>" class="btn btn-danger">Excluir</a>
                                                    <a href="carrinho.php?acao=add&id=<?php echo $id[$i];?>" class="btn btn-secondary">Add Cart</a>
                                                </div>
                                            </div>
                                                
                                        <?php
                                        $i++;
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </form>
        </div><!--Fim da div para foto fundos-->
    </body>


</html>