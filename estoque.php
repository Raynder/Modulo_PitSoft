<?php
    require_once 'php/conexao.php';
    $sql = "SELECT * FROM produtos";
    $resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIT SOFT</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
    <link href="dist/css/styleEstoque.css" rel="stylesheet" type="text/css">
    <link href="dist/css/lightslider.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="dist/js/lightslider.js"></script>
    <script src="dist/js/js.js"></script>
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="defEstoque" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Definir Estoque <span id="nomeEstoque"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="">Estoque atual: <span id="valorEstoqueAtual"></span> </p>
        <p>Novo estoque: <input type="number" id="valorEstoque" name="valorEstoque"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
        <button type="button" onclick="mudarEstoqueConfirmar()" class="btn btn-primary">CONFIRMAR</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
    <div class="barra topo">
        <H1>PIT SOFT</H1>
    </div>

    <div class="menu">
        <?php
            while($dado = $resultado->fetch_array()){
                ?>
                <div onclick="mudarEstoque('<?=ucfirst($dado['nome']);?>', <?=$dado['estoque'];?>)" class="ingrediente" style="background-image: url('img/<?=($dado['nome']);?>.png');background-repeat: no-repeat; background-size: cover;">
                    <div class="nomeingrediente">
                        <p><?=ucfirst($dado['nome']);?></p>
                    </div>
                </div>

                <?
            }
        ?>
        
    </div>

    <div class="barra bottom">
        <div class="funcao">
            <a href="index.php"><p>PAINEL DE VENDAS</p></a>
        </div>
    </div>
</div>

<script>
    var item = "";
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })

    function mudarEstoque(nomeEstoque, valorEstoque) {
        item = nomeEstoque;
        $('#nomeEstoque').text(nomeEstoque);
        if(nomeEstoque == 'Pão' || nomeEstoque == 'Ovo'){
            $('#valorEstoqueAtual').text(valorEstoque + " Un");
        }else{
            $('#valorEstoqueAtual').text(valorEstoque+" g");
        }
        setTimeout(function(){
            $("#defEstoque").modal({
                show: true
            });
        }, 1000);
    }

    function mudarEstoqueConfirmar(){
        var valorEstoque = $('#valorEstoque').val();
        $.ajax({
            url: 'php/alterarEstoque.php',
            type: 'POST',
            data: {
                item: item,
                valor: valorEstoque
            },
            success: function(data){
                if(data == '1'){
                    alert('Estoque alterado com sucesso!');
                    location.reload();
                }else{
                    alert('Erro ao alterar estoque!');
                }
            }
        });
    }

</script>
    
</body>
</html>