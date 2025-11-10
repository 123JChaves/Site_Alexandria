<?php
    class ProdutoController {
        public function index($id, $img) {

        }

        public function detalhes($id, $img) {
            require_once "views/produto/detalhes.php";
        }
    }