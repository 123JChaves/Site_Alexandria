<div class="card shadow-lg border-0 rounded-4">
    <div class="card-header text-center rounded-top-4 py-2">
        <h3>Carrinho de Compras</h3>
    </div>
    <div class="card-body">
        <?php
            if(isset($_SESSION["cliente"]["id"])) {
                echo"<p class='alert alert-success text-center p-2 m-2'>
                    Olá {$_SESSION['cliente']['nome']}
                    -
                    <a href='carrinho/sair'>Sair</a>
                    </p>
                    <br>";
            }
        ?>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>Imagem</td>
                    <td>Nome do Produto</td>
                    <td>Quantidade</td>
                    <td>Unitários</td>
                    <td>Total</td>
                    <td>Excluir</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                if(!empty($_SESSION["carrinho"])) {
                    foreach($_SESSION["carrinho"] as $dados) {
                        $total = $total + ($dados["qtde"] * $dados["valor"]);
                        ?>
                            <tr>
                                <td><img src="<?=$img?><?=$dados["imagem"]?>" alt="<?=$dados["nome"]?>" width="130px"></td>
                                <td><?=$dados["nome"]?></td>
                                <td>
                                    <input type="number" value="<?=$dados["qtde"]?>" class="form-control" 
                                    onblur="somarQuantidade(this.value, <?=$dados["id"]?>)">
                                </td>
                                <td><?=number_format($dados["valor"],2, ',', '.')?></td>
                                <td><?=number_format($dados["qtde"] * $dados["valor"],2, ',', '.')?></td>
                                <td>
                                    <a href="carrinho/excluir/<?=$dados["id"]?>" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                    }
                }
                ?>
            </tbody>
        </table>
            <p class="float-start">
                <a href="carrinho/limpar" class="btn btn-warning mt-2 me-2 border-0 rounded-4">
                 Limpar Carrinho
                </a>
             <a href="carrinho/finalizar" class="btn btn-success mt-2 border-0 rounded-4">
                Finalizar Compra
                </a>
            </p>

         <p class="float-end valor mt-5">
            R$ <?=number_format($total,2, ',', '.')?>
        </p>
    </div>
</div>
<script>
    somarQuantidade = function(qtde, id) {
        $.get("somar.php",{qtde:qtde, id:id}, function(dados){
            if(dados == "") window.location.reload();
            else alert(dados);
        })
    }
</script>