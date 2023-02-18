<head>
    <!--Estilos Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Efeitos Personalizados -->
    <link rel="stylesheet" type="text/css" href="../CSS/efeitos.css" />
</head>
<body>
<h1 class="titulo">Finalizar Compra</h1>
</body>

<?php
use FogFireStore\FogFire\PHP\DAO\Conexao;
require_once('DAO/Conexao.php');

session_start();

$conexao = new Conexao();
$conn = $conexao->conectar();

foreach($_SESSION['dados'] as $produtos){
    $sql = "INSERT INTO vendas () VALUES (null,?,?,?,?)";
    $sql->bindParam(1, $produtos['id']);
    $sql->bindParam(2, $produtos['quantidade']);
    $sql->bindParam(3, $produtos['preco']);
    $sql->bindParam(4, $produtos['total']);
    $sql->execute();
}
?>