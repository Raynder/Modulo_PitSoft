<?php
    require_once 'conexao.php';
    session_start();

    if(isset($_POST['produto'])){
        $produto = $_POST['produto'];
        
        if($produto == 'misto'){
            $ingredientes = ['pao', 'queijo', 'presunto'];
            $preco = 8;
            echo("<h1>produto: Misto</h1>");
        }
        if($produto == 's'){
            $ingredientes = ['pao', 'queijo', 'presunto', 'carne', 'salada'];
            $preco = 10;
            echo("<h1>produto: S</h1>");
        }
        if($produto == 'especial'){
            $ingredientes = ['pao', 'queijo', 'presunto', 'carne', 'salada', 'ovo'];
            $preco = 12;
            echo("<h1>produto: Especial</h1>");
        }
        if($produto == 'bacon'){
            $ingredientes = ['pao', 'queijo', 'presunto', 'carne', 'salada', 'ovo', 'bacon'];
            $preco = 14;
            echo("<h1>produto: Bacon</h1>");
        }
        foreach($ingredientes as $ingrediente){
            $_SESSION[$ingrediente] = $_SESSION[$ingrediente] - 100;
        }
        $_SESSION['preco'] += $preco;
    }
    if(isset($_POST['concluir'])){
        $sql = "UPDATE produtos SET estoque = $_SESSION[pao] WHERE nome = 'pao';";
        $sql.= "UPDATE produtos SET estoque = $_SESSION[queijo] WHERE nome = 'queijo';";
        $sql.= "UPDATE produtos SET estoque = $_SESSION[presunto] WHERE nome = 'presunto';";
        $sql.= "UPDATE produtos SET estoque = $_SESSION[carne] WHERE nome = 'carne';";
        $sql.= "UPDATE produtos SET estoque = $_SESSION[salada] WHERE nome = 'salada';";
        $sql.= "UPDATE produtos SET estoque = $_SESSION[ovo] WHERE nome = 'ovo';";
        $sql.= "UPDATE produtos SET estoque = $_SESSION[bacon] WHERE nome = 'bacon';";

        $result = mysqli_multi_query($conexao, $sql);
        if($result){
            echo("<h1>Pedido concluido!</h1>");
            echo("<h1>Preço total: R$ $_SESSION[preco]</h1>");
            session_destroy();
        }
        else{
            echo("<h1>Erro ao concluir pedido!</h1>");
        }
    }
    if(isset($_POST['cancelar'])){
        session_destroy();
    }
