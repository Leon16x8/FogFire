<?php 

    namespace FogFireStore\FogFire\PHP;

    session_start();

    require_once('DAO/Conexao.php');

    use FogFireStore\FogFire\PHP\DAO\Conexao;

    $conexao = new Conexao;

    $conn = $conexao -> conectar();

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT * FROM PRODUTOS WHERE ID = $id";
    $res = mysqli_query($conn , $sql);

    $reg = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="pt-Br">

<head>
	<title></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../CSS/style.css"/>
</head>

<body>
    <a href="index.php">Menu Principal</a><br>
    <h1>Editar Dados</h1>
    <?php 
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset ($_SESSION['msg']);
        }
    
    ?>

    <form method="POST" action="DAO/Update.php">

        <input type="hidden" name="tId" value="<?php echo $reg['id'] ?>" /><br><br>

		<label>Descrição: </label>
		<input type="text" name="tNomeProduto" placeholder="Informe seu nome" value="<?php echo $reg['nomeProduto'] ?>" required /><br><br>

		<label>Valor: </label>
		<input type="number" name="tPreco" placeholder="R$" step="0.01" value="<?php echo $reg['preco'] ?>" required /><br><br>

        <label>Estoque: </label>
		<input type="number" name="tEstoque" placeholder="Estoque" value="<?php echo $reg['estoque'] ?>" required /><br><br>

		<input type='submit' name='editar' class="btn btn-dark">
		
	</form>
    
</body>