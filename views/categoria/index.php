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
                    <img src="<?= $img ?><?= $produto->imagem ?>" width="200px" alt="<?= $produto->nome ?>">
                </div>
                <div class="col-12 col-md-8">
                    <p><strong><?= $produto->nome ?></strong></p>
                    <p><?= $produto->descricao ?></p>
                    <p class="float-start valor"> R$ <?= number_format($produto->valor, 2, ",", ".") ?> </p>
                    <p class="float-end">
                        <a href="carrinho/adicionar/<?= $produto->id ?>" class="btn btn-dark mt-2 border-0 rounded-4">
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
<style>
a.btn-dark:hover {
        background-color: #263055;
        color: #fff;
        transition: background-color 0.3s ease;
    }

button[type="submit"]:hover {
        background-color: #263055;
        transition: background-color 0.3s ease;
}
a.btn-danger:hover {
        background-color: #ffffffff;
        color: #ff1c1cff;
        transition: background-color 0.3s ease;
}
</style>
