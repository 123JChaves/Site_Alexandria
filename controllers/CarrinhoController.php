<?php

require "../config/Conexao.php";
require "../models/Carrinho.php";
class CarrinhoController
{

    private $carrinho;

    public function __construct()
    {
        $db = new Conexao();
        $pdo = $db->conectar();
        $this->carrinho = new Carrinho($pdo);
    }

    public function index($id, $img)
    {
        require "../views/carrinho/index.php";
    }

    public function adicionar($id, $img)
    {
        require "../views/carrinho/adicionar.php";
    }

    public function excluir($id, $img)
    {
        unset($_SESSION['carrinho'][$id]);
        require "../views/carrinho/index.php";
    }

    public function limpar()
    {
        unset($_SESSION['carrinho']);
        require "../views/carrinho/index.php";
    }

    public function finalizar() {
    if (isset($_SESSION["cliente"]["id"])) {
        $resultado = $this->carrinho->salvarPedido('');
        if ($resultado == 0 && isset($_SESSION['erro_estoque'])) {
            require "../views/carrinho/erro_estoque.php";
        } else {
            require "../views/carrinho/finalizar.php";
        }
    } else {
        require "../views/carrinho/login.php";
    }
}

    public function cadastrar()
    {
        require "../views/carrinho/cadastrar.php";
    }

    public function logar()
    {
        require "../views/carrinho/logar.php";
    }

    public function sair($id, $img)
    {
        unset($_SESSION["cliente"]);
        require "../views/carrinho/index.php";
    }

}
