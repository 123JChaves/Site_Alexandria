<style>
    a.btn-dark:hover {
        background-color: #085a05ff;
        color: #ffffffff;
        transition: background-color 0.3s ease;
    }
    button[type="submit"]:hover {
        background-color: #263055;
        transition: background-color 0.3s ease;
    }
    a.btn-danger:hover {
        background-color: #5f0202ff;
        color: #ffffffff;
        transition: background-color 0.3s ease;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="card">
    <div class="card-header">
        <h2>Carrinho de Compras</h2>
    </div>
    <div class="card-body">
        <?php if (isset($_SESSION["cliente"]["id"])) { ?>
            <p class='alert alert-success text-center p-2 m-2'>
                Olá <?= $_SESSION['cliente']['nome'] ?> - <a href='carrinho/sair'>Sair</a>
            </p>
            <br>
        <?php } ?>
        <?php if (isset($_SESSION['erro_estoque'])) { ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($_SESSION['erro_estoque'] as $produto) { ?>
                        <li>O produto <?= $produto['nome'] ?> está com estoque insuficiente (<?= $produto['quantidade'] ?> unidades solicitadas).</li>
                    <?php } ?>
                </ul>
            </div>
            <?php unset($_SESSION['erro_estoque']); ?>
        <?php } ?>
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
                if (!empty($_SESSION["carrinho"])) { 
                    foreach ($_SESSION["carrinho"] as $dados) { 
                    $total = $total + ($dados["qtde"] * $dados["valor"]); 
                
                ?>
                
                <tr>
                    <td><img src="<?= $img ?><?= $dados["imagem"] ?>" alt="<?= $dados["nome"] ?>" width="130px"></td>
                    <td><?= $dados["nome"] ?></td>
                    <td>
                        <input type="number" value="<?= $dados["qtde"] ?>" class="form-control" onblur="somarQuantidade(this.value, <?= $dados["id"] ?>)">
                    </td>
                    <td><?= number_format($dados["valor"], 2, ',', '.') ?></td>
                    <td><?= number_format($dados["qtde"] * $dados["valor"], 2, ',', '.') ?></td>
                    <td>
                        <a href="carrinho/excluir/<?= $dados["id"] ?>" class="btn btn-danger border-0 rounded-4">
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
        <div class="btn-group gap-3">
            <a href="carrinho/limpar" class="btn btn-danger border-0 rounded-4">
                Limpar Carrinho
            </a>
            <a href="#" class="btn btn-dark border-0 rounded-4" id="finalizar-compra">
                Finalizar Compra
            </a>
        </div>
        <p class="float-end valor">
            R$ <?= number_format($total, 2, ',', '.') ?>
        </p>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const response = await fetch('http://localhost/Livraria_Alexandria/public/apis/quantidadeEstoque.php');
        const data = await response.json();
        const produtosIndisponiveis = [];
    
        document.querySelectorAll('table tbody tr').forEach((row) => {
            const idProduto = row.querySelector('td:last-child a').href.split('/').pop();
            const quantidadeCarrinho = parseInt(row.querySelector('input[type="number"]').value);
            const produto = data.find((item) => item.id == idProduto);
    
            if (produto && produto.estoque < quantidadeCarrinho) {
                row.querySelector('td:nth-child(3)').innerHTML += ` <span class="text-danger"> (Estoque: ${produto.estoque})</span>`;
                row.querySelector('input[type="number"]').max = produto.estoque;
                produtosIndisponiveis.push(produto.nome);
            }
        });
        document.getElementById('finalizar-compra').addEventListener('click', (e) => {
            e.preventDefault();
            if (produtosIndisponiveis.length > 0) {
                let mensagem;
                if (produtosIndisponiveis.length === 1) {
                    mensagem = `O produto "${produtosIndisponiveis.join(', ')}"
                    está indisponível, ou a quantidade é maior que o estoque.`;
                } else {
                    mensagem = `Os seguintes produtos estão indisponíveis:
                    "${produtosIndisponiveis.join(', ')}", ou a quantidade é maior que o estoque.`;
                }
                if (produtosIndisponiveis.length === 1) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Produto Indisponível',
                        text: mensagem,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Produtos Indisponíveis',
                        text: mensagem,
                    });
                }
            } else {
                window.location.href = 'carrinho/finalizar';
            }
        });
    });
    somarQuantidade = function(qtde, id) {
        $.get("somar.php", { qtde: qtde, id: id }, function(dados) {
            if (dados == "") window.location.reload();
            else alert(dados);
        })
    }
    // document.addEventListener('DOMContentLoaded', async () => {
    //     const response = await fetch('http://localhost/Livraria_Alexandria/public/apis/quantidadeEstoque.php');
    //     const data = await response.json();
    //     const produtosIndisponiveis = [];
    //     document.querySelectorAll('table tbody tr').forEach((row) => {
    //         const idProduto = row.querySelector('td:last-child a').href.split('/').pop();
    //         const quantidadeCarrinho = parseInt(row.querySelector('input[type="number"]').value);
    //         const produto = data.find((item) => item.id == idProduto);
    //         if (produto && produto.estoque < quantidadeCarrinho) {
    //             row.querySelector('td:nth-child(3)').innerHTML += ` <span class="text-danger"> (Estoque: ${produto.estoque})</span>`;
    //             row.querySelector('input[type="number"]').max = produto.estoque;
    //             produtosIndisponiveis.push(produto.nome);
    //         }
    //     });
    //     document.getElementById('finalizar-compra').addEventListener('click', (e) => {
    //         e.preventDefault();
    //         window.location.href = 'carrinho/finalizar';
    //     });
    // });
</script>