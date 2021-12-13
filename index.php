<?php
    require_once 'php/conexao.php';

    $produtos = array(
        "misto" => 0,
        "S" => 0,
        "Especial" => 0,
        "Bacon" => 0
    );

    session_start();

    if(isset($_SESSION['preco']) && $_SESSION['preco'] != 0){
        $preco = $_SESSION['preco'];
    }
    else{
        $_SESSION['preco'] = 00;
        $preco = $_SESSION['preco'];
        $sql = "SELECT * FROM produtos";
        $resultado = mysqli_query($conexao, $sql);
        while($dado = $resultado->fetch_array()){
            $_SESSION[$dado['nome']] = $dado['estoque'];
        }
    }
    if($_SESSION['pao'] >= 100){
        if($_SESSION['queijo'] >= 100){
            if($_SESSION['presunto'] >= 100){
                $produtos['misto'] = 1;
                if($_SESSION['carne'] >= 100){
                    if($_SESSION['salada'] >= 100){
                        $produtos['S'] = 1;
                        if($_SESSION['ovo'] >= 100){
                            $produtos['Especial'] = 1;
                            if($_SESSION['bacon'] >= 100){
                                $produtos['Bacon'] = 1;
                            }
                        }
                    }
                }
            }
        }
    }
    // if($_SESSION['pao'] != 0 && $_SESSION['queijo'] != 0 && $_SESSION['presunto'] != 0){
    //     $produtos['misto'] = 1;
    // }
    // if($_SESSION['pao'] != 0 && $_SESSION['queijo'] != 0 && $_SESSION['presunto'] != 0 && $_SESSION['carne'] != 0 && $_SESSION['salada'] != 0){
    //     $produtos['s'] = 1;
    // }
    // if($_SESSION['pao'] != 0 && $_SESSION['queijo'] != 0 && $_SESSION['presunto'] != 0 && $_SESSION['carne'] != 0 && $_SESSION['ovo'] != 0 && $_SESSION['salada'] != 0){
    //     $produtos['especial'] = 1;
    // }
    // if($_SESSION['pao'] != 0 && $_SESSION['queijo'] != 0 && $_SESSION['presunto'] != 0 && $_SESSION['bacon'] != 0 && $_SESSION['carne'] != 0 && $_SESSION['ovo'] != 0 && $_SESSION['salada'] != 0){
    //     $produtos['bacon'] = 1;
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIT SOFT</title>
    
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    <link href="dist/css/lightslider.css" rel="stylesheet" type="text/css">

    <script src="dist/js/jquery.js"></script>
    <script src="dist/js/lightslider.js"></script>
    <script src="dist/js/js.js"></script>
</head>
<body>

<div class="container">
    <div class="barra topo">
        <H1>PIT SOFT</H1>
    </div>

    <ul id="autoWidth" class="cs-hidden">
        <li class="item-a">
            <div class="produto">
                <div class="item" <?=$produtos['misto'] != 1 ? "style='border: solid red 4px;'" : ""?>>
                <h1>Misto</h1>
                <div class="produto-imagem">
                        <img src="img/1.png" alt="" <?=$produtos['misto'] != 1 ? "onclick='pedir(0)'" : "onclick='pedir(\"misto\")'"?>>
                    </div>
                    <div class="produto-detalhes">
                        <p>Ingredientes</p>
                        <p>Pão, Queijo e Presunto</p>
                        <p>R$ 8,00</p>
                        
                    </div>
                </div>
            </div>
        </li>
        
        <li class="item-b">
            <div class="produto">
                <div class="item" <?=$produtos['bacon'] != 1 ? "style='border: solid red 4px;'" : ""?>>
                <h1>Bacon</h1>
                <div class="produto-imagem">
                        <img src="img/2.png" alt="" <?=$produtos['bacon'] != 1 ? "onclick='pedir(0)'" : "onclick='pedir(\"bacon\")'"?>>
                    </div>
                    <div class="produto-detalhes">
                        <p>Ingredientes</p>
                        <p>Pão, Queijo, Presunto, Carne, Salada, Ovo e Bacon</p>
                        <p>R$ 14,00</p>
                        
                    </div>
                </div>
            </div>
        </li>
        
        <li class="item-c">
            <div class="produto">
                <div class="item" <?=$produtos['s'] != 1 ? "style='border: solid red 4px;'" : ""?>>
                <h1>S</h1>
                <div class="produto-imagem">
                        <img src="img/3.png" alt="" <?=$produtos['misto'] != 1 ? "onclick='pedir(0)'" : "onclick='pedir(\"misto\")'"?>>
                    </div>
                    <div class="produto-detalhes">
                        <p>Ingredientes</p>
                        <p>Pão, Queijo, Presunto, Carne e Salada</p>
                        <p>R$ 10,00</p>
                        
                    </div>
                </div>
            </div>
        </li>
        
        <li class="item-d">
            <div class="produto">
                <div class="item" <?=$produtos['especial'] != 1 ? "style='border: solid red 4px;'" : ""?>>
                <h1>Especial</h1>
                <div class="produto-imagem">
                        <img src="img/4.png" alt="" <?=$produtos['misto'] != 1 ? "onclick='pedir(0)'" : "onclick='pedir(\"misto\")'"?>>
                    </div>
                    <div class="produto-detalhes">
                        <p>Ingredientes</p>
                        <p>Pão, Queijo, Presunto, Carne, Salada e Ovo</p>
                        <p>R$ 12,00</p>
                        
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <div class="barra bottom">
        <div class="funcao">
            <a href="estoque.php">
                <p>ESTOQUE</p>
            </a>
        </div>
        <div class="funcao">
            <p>R$<?=$preco?>,00</p>
        </div>
        <div onclick="cancelar()" class="funcao">
            <p>CANCELAR</p>
        </div>
        <div onclick="concluir()" class="funcao">
            <p>CONCLUIR</p>
        </div>
    </div>
</div>
    
<script>
    function pedir(produto){
        if(produto == 0){
            alert("Ingredientes insulficientes!");
        }else{
            $.ajax({
                url: "php/pedido.php",
                type: "POST",
                data: {produto: produto},
                success: function(data){
                    alert(data);
                    location.reload();
                }
            });
        }
    }
    function concluir(){
        $.ajax({
            url: "php/pedido.php",
            type: "POST",
            data: {concluir: 1},
            success: function(data){
                alert(data);
                location.reload();
            }
        });
    }
    function cancelar(){
        $.ajax({
            url: "php/pedido.php",
            type: "POST",
            data: {cancelar: 1},
            success: function(data){
                alert(data);
                location.reload();
            }
        })
    }
</script>
</body>
</html>