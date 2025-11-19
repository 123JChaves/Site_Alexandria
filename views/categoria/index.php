<?php

$urlProduto = "http://localhost/Livraria_Alexandria/public/apis/produto.php?categoria={$id}";
$dadosProduto = json_decode(file_get_contents($urlProduto));

//var_dump($dadosProduto)

?>

<div class="card">
    <div class="card-header">
        <h2>Produtos da Categoria</h2>
    </div>
    <div class="card-body">
        <?php
        
        foreach ($dadosProduto as $produto) {
            
        ?>
            <div class="row">
                <div class="col-12 col-md-4">
                    <img src="<?= $img ?><?= $produto->imagem ?>" class="w-100" alt="<?= $produto->nome ?>">
                </div>
                <div class="col-12 col-md-8">
                    <p><strong><?= $produto->nome ?></strong></p>
                    <p><?= $produto->descricao ?></p>
                    <p class="float-start valor"> R$ <?= number_format($produto->valor, 2, ",", ".") ?> </p>
                    <p class="float-end">
                        <a href="carrinho/adicionar/<?= $produto->id ?>" class="btn btn-success">
                            <i class="fas fa-plus"></i>Adicionar ao Carrinho
                        </a>
                    </p>
                </div>
            </div>
            <hr>

        <?php

        }

        ?>

    </div>
</div>
