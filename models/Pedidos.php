<?php

    class Pedidos {

        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function getPedidos() {

            $sqlPedidos = "select *, date_format(data, '%d/%m/%Y %Hh%i') dt
            from pedido where cliente_id = :cliente_id order by data";
            $consulta = $this->pdo->prepare($sqlPedidos);
            $consulta->bindParam(':cliente_id', $_SESSION["cliente"]["id"]);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }

        public function getItens($pedidos) {
            $sqlItem = "select p.nome, i.valor, i.qtde from item i
            inner join produto p on (p.id = i.produto_id) where i.pedido_id
            = :pedido_id order by p.nome";
            $consulta = $this->pdo->prepare($sqlItem);
            $consulta->bindParam(':pedido_id', $pedidos);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_OBJ);
        }

    }