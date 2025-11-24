<div class="card">
    <div class="card-header">
        <h2>Produtos em Destaque</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <?php

                $urlProduto = "http://localhost/Livraria_Alexandria/public/apis/destaques.php";
                $dadosProduto = json_decode(file_get_contents($urlProduto));
                foreach($dadosProduto as $dados) {
                
            ?>
                <div class="col-12 col-md-3">
                    <div class="card text-center">
                        <img src="<?=$img?><?=$dados->imagem?>" class="mx-auto" width="180px" alt="<?=$dados->nome?>">
                        <p>
                            <strong><?=$dados->nome?></strong>
                        </p>
                        <p>
                            <a href="produto/detalhes/<?=$dados->id?>" class="btn btn-dark mt-2 border-0 rounded-4">
                                <i class="fas fa-search"></i> Detalhes do Produto
                            </a>
                        </p>
                    </div>
                </div>
                <?php
                }
            ?>
        </div>
        <p class="text-center">
            <a href="produtos/index" class="btn btn-dark mt-2 border-0 rounded-4 btn-lg">
                <i class="fa fas-search"></i> Ver todos os produtos
            </a>
        </p>
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