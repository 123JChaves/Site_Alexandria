<?php
    if(!isset($_SESSION["carrinho"])) {
        echo"<script>alert('Carrinho vazio!')history.back()</script>";
    } else if(!isset($_SESSION["cliente"])) {
        echo"<script>alert('Cliente não logado!')history.back()</script>";
    }

    $token = "";

    require 'vendor/autoload.php';

    MercadoPago\SDK::setAccessToken($token);

    $preference = new MercadoPago\Preference();
    use MercadoPago\Payer;

    $payer = new Payer();
    $payer->name = $_SESSION["cliente"]["nome"];
    $payer->email = $_SESSION["cliente"]["email"];

    $preference->payer = $payer;

    $itens = [];

    foreach($_SESSION["carrinho"] as $produto) {

        $itens[] = array(
            "title" => $produto["nome"],
            "quantity" => (int)$produto["qtde"],
            "currency_id" => "BRL",
            "unit_price" => (float)$produto["valor"]
        );
    }

    $preference->items = $itens;

    // URL de retorno após o pagamento
    $preference->back_urls = array(
        "success" => "https://www.Livraria-Alexandria.com.br/meli/sucesso.php",
        "failure" => "https://www.Livraria-Alexandria.com.br/meli/falha.php",
        "pending" => "https://www.sLivraria-Alexandria.com.br/meli/pendente.php"
    );

    $preference->notification_url = "https://www.Livraria-Alexandria.com.br/meli/notificacao.php";
    
    $preference->auto_return = "approved"; // Retorno automático quando aprovado

    $preference->save();

    $msg = $this->carrinho->salvarPedido($preference->id);

    if($msg == 0) {
        echo"<script>alert('Erro ao cadastrar pedido');history.back();</script>";
    }

?>

<div class="card">
    <div class="card-header text-center">
        <img src="images/mercado-pago-logo.png" alt="Mercado Pago" width="350px">
    </div>
    <div class="card-body">
        <p class="text-center">
            <script src="https://www.mercadopago.com.br/integrations/v1/web-payment-checkout.js"
                data-preference-id="<?php echo $preference->id; ?>"
                data-button-label="Pagar com Mercado Pago (Boleto, Cartão de Crédito ou Débito)">
            </script>
        </p>
    </div>
</div>