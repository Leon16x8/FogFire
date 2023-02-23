<?php 
   namespace FogFireStore\FogFire\PHP\DAO;

   session_start();
    
    require_once('Conexao.php');

    use FogFireStore\FogFire\PHP\DAO\Conexao;

    $conexao = new Conexao;
    $con = $conexao -> conectar();

    $id = filter_input(INPUT_POST, 'tId', FILTER_SANITIZE_NUMBER_INT);
    $nomeProduto = filter_input(INPUT_POST, 'tNomeProduto', FILTER_SANITIZE_STRING);
    $preco = filter_input(INPUT_POST, 'tPreco', FILTER_SANITIZE_NUMBER_INT);
    $estoque = filter_input(INPUT_POST, 'tEstoque', FILTER_SANITIZE_NUMBER_INT);

    $sql  = "UPDATE PRODUTOS SET NOMEPRODUTO='$nomeProduto', PRECO='$preco', ESTOQUE ='$estoque' WHERE ID ='$id'";

    $res = mysqli_query($con, $sql);

    if(mysqli_affected_rows($con)){
        $_SESSION['msg'] = "<p style='color:green;'>Usuário editado com sucesso</p>";
        header("Location: ../Index.php");
    }else{
        $_SESSION['msg'] = "<p style='color:red;'>Usuário não foi editado com sucesso</p>";
        header("Location: ../Editar.php?cod=$id");
    }

?>