<?php
    class ProdutoController {
        public function index($id, $img) {

        }

        public function detalhes($id, $img) {
            require "../views/produto/detalhes.php";
        }

        public function todosOsProdutos($id, $img) {
            require "../views/produto/todosOsProdutos.php";
        }

    }
