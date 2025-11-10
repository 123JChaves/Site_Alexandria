<div class="card">
    <div class="card-header">
        <h1>Seus Pedidos</h1>
    </div>
    <div class="card-body">
        <?php
        $totalGeral = 0; // Variável para armazenar a soma total de todos os pedidos
        $dadosPedidos = $this->pedidos->getPedidos();
        foreach ($dadosPedidos as $dados) {
            $totalPedido = 0; // Variável para armazenar a soma total do pedido atual
        ?>
            <p>
                <strong>Pedido:<?= $dados->id ?></strong>Data:<?= $dados->dt ?>
            </p>
            <table class="table table-bordered table-striped">
                <?php
                $dadosProdutos = $this->pedidos->getItens($dados->id);
                foreach ($dadosProdutos as $produtos) {
                    $totalPedido = $totalPedido + ($produtos->qtde * $produtos->valor); // Incrementa a soma total do pedido atual
                ?>
                    <tr>
                        <td><?=$produtos->nome?></td>
                        <td><?=$produtos->qtde?></td>
                        <td><?=$produtos->valor?></td>
                        <td>
                            <input type="number" value="<?=$produtos->qtde?>" class="form-control" 
                            onblur="somarQuantidade(this.value,<?=$produtos->id?>)">
                        </td>
                        <td><?= number_format($produtos->valor,2,',','.')?></td>
                        <td><?= number_format($produtos->qtde * $produtos->valor,2,',','.')?></td>
                    </tr>
                <?php
                }
            ?>
            </table>
            <p>Total do Pedido: R$ <?=number_format($totalPedido,2,',','.')?></p>
            <hr>
        <?php
            $totalGeral = $totalGeral + $totalPedido; // Incrementa a soma total de todos os pedidos
        }
        ?>
        <p>Total Geral: R$ <?=number_format($totalGeral,2,',','.')?></p>
    </div>
</div>