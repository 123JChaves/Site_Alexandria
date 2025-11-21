<?php
    class Conexao {
        private static $host = "localhost";
        private static $usuario = "root";
<<<<<<< HEAD
        private static $senha = "";
=======
        private static $senha = "123456";
>>>>>>> c30b3b0ea35f83b9feaefeb8950ceed33f3bb370
        private static $banco = "alexandria";

        public static function conectar() {
            try {

                return new PDO("mysql:host=".self::$host.";dbname=".self::$banco.";charset=utf8",
                self::$usuario, self::$senha);

            } catch (PDOException $e) {
                die("Erro ao conectar com banco de dados: {$e->getMessage()}");
            }
        }
    }
