<?php 
    namespace FogFireStore\FogFire\PHP\DAO;

    session_start();

    require_once('Conexao.php');

    use FogFireStore\FogFire\PHP\DAO\Conexao;
    
    $conexao = new Conexao;
    $conn = $conexao -> conectar();

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $sql = "DELETE FROM PRODUTOS WHERE ID = $id";
    $res = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn)){
        $_SESSION['msg'] = "<p style='color:green;'> Usuario apagado com sucesso</p>";
        header("Location:../Index.php");
    }else{
        $_SESSION['msg'] = "<p style='color:red;'> Erro ! Usuario nao deletado </p>";
        header("Location:../Index.php");
    } 
?>