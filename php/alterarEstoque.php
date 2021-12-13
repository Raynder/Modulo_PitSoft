<?php
    require_once 'conexao.php';

    $item = $_POST['item'];
    $valor = $_POST['valor'];

    $sql = "UPDATE produtos SET estoque = '$valor' WHERE nome = '$item'";
    if($conexao->query($sql)){
        echo "1";
    }else{
        echo "0";
    }
