<?php
     namespace FogFireStore\FogFire\PHP\DAO;

    class Conexao{
        public function conectar(){
            try{
                $conn = mysqli_connect('localhost','root','','FogFire');
                if($conn){
                    echo "\nConectado com sucesso!";
                    return $conn;
                }
            }catch(Except $erro){
                echo $erro;
            }
        }//fim do metodo conectar
    }//fim da classe
?>