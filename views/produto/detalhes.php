<?php

    $urlProduto = "http://localhost/Livraria_Alexandria/public/apis/produto.php?id={$id}";
    $dadosProduto = json_decode(file_get_contents($urlProduto));

    //print_r($dadosProduto);

?>

<div class="card">
    <div class="card-header">

        <?php
        if(empty($dadosProduto->id)) {
            echo "<h2>Produto inválido!</h2>";
        } else {
            echo "<h2>{$dadosProduto->nome}</h2>"; 
        }
        ?>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-4">
                <img src="<?=$img?><?=$dadosProduto->imagem?>" width="180px" alt="<?=$dadosProduto->nome?>">
            </div>
            <div class="col-12 col-md-8">
                <p><strong>Dados do Produto:</strong></p>
                <?=$dadosProduto->descricao?>
                <p class="float-start valor">
                R$ <?=number_format($dadosProduto->valor, 2, ",",".")?>
                </p>
                <p class="float-end">
                    <a href="carrinho/adicionar/<?=$dadosProduto->id?>" class="btn btn-dark mt-2 border-0 rounded-4">
                        <i class="fas fa-plus"></i>Adicionar ao Carrinho
                    </a>
                </p>
            </div>
        </div>
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