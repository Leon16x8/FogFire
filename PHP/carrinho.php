<?php
namespace FogFireStore\FogFire\PHP;

    require_once("DAO/Conexao.php");

    use FogFireStore\FogFire\PHP\DAO\Conexao;
session_start();
if(!isset($_SESSION['itens'])){
    $_SESSION['itens'] = array();
}

if(isset($_GET['add']) && $_GET['add'] == "carrinho"){
    /*Adiciona ao Carrinho*/
    $idProduto = $_GET['id'];
    if(!isset($_SESSION['itens'][$idProduto])){
        $_SESSION['itens'][$idProduto] = 1;
        
    }else{
        $_SESSION['itens'][$idProduto] += 1;
    }
}
/*Exibe o carrinho*/
if(count($_SESSION['itens']) == 0){
    echo 'Carrinho Vazio<br><a href="index.php">Adicionar Produtos</a>';
}
?>