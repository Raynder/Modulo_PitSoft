<?php

    $host = "sql205.epizy.com";
    $user = "epiz_30573666";
    $pass = "LS1fGaNPGezBPzS";
    $banco = "epiz_30573666_base";

    $conexao = mysqli_connect($host, $user, $pass, $banco);

    if(!$conexao){
        echo "Erro ao conectar com o banco de dados!";
    }