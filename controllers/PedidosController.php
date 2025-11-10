<?php
    require "../config/Conexao.php";
    require "../models/Pedidos.php";

    class PedidosController {
        
        private $pedidos;

        public function __construct()
        {
            $db = new Conexao();
            $pdo = $db->conectar();
            $this->pedidos = new Pedidos($pdo);
        }

        public function index() {
            require "../views/pedidos/index.php";
        }

    }