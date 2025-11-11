<?php

    class Carrinho {

        private $pdo;

        public function __construct($pdo)
        {
            $this->pdo = $pdo;

        }

        public function salvar($dados) {

            $sqlVerificar = "select id from cliente where email = :email limit 1";
            $consultaVerificar = $this->pdo->prepare($sqlVerificar);
            $consultaVerificar->bindParam(':email', $dados['email']);
            $consultaVerificar->execute();

            $dadosVerificar = $consultaVerificar->fetch(PDO::FETCH_OBJ);

            if(empty($dadosVerificar->id)) {

                $senha = password_hash($dados["senha"], PASSWORD_BCRYPT);

                $sqlCliente = "insert into cliente values(NULL, :nome, :email, :senha)";
                $consultaCliente = $this->pdo->prepare($sqlCliente);
                $consultaCliente->bindParam(':nome', $dados['nome']);
                $consultaCliente->bindParam(':email', $dados['email']);
                $consultaCliente->bindParam(':senha', $senha);
                
                return $consultaCliente->execute();

            } else {
                return 2; //Já existe email cadastrado

            }

        }

        public function logar($email) {
            $sql ="select * from cliente where email = :email limit 1";
            $consuta = $this->pdo->prepare($sql);
            $consuta->bindParam(':email', $email);
            $consuta->execute();
            
            return $consuta->fetch(PDO::FETCH_OBJ);
            
        }

        public function salvarPedido($preference_id) {

            $sqlPedido = "insert into pedido values (NULL, :cliente_id, NOW(), :preference_id)";
            $consulta = $this->pdo->prepare($sqlPedido);
            $consulta->bindParam(":cliente_id", $_SESSION["cliente"]["id"]);
            $consulta->bindParam(":preference_id", $preference_id);
            
            if($consulta->execute()) {

                $pedido_id = $this->pdo->lastInsertId();

                foreach($_SESSION["carrinho"] as $dados) {

                    $sqlItem = "insert into item values (:pedido_id, :produto_id, :qtde, :valor)";
                    $consultaItem = $this->pdo->prepare($sqlItem);
                    $consultaItem->bindParam(':pedido_id', $pedido_id);
                    $consultaItem->bindParam(':produto_id', $dados['id']);
                    $consultaItem->bindParam(':qtde', $dados['qtde']);
                    $consultaItem->bindParam(':valor', $dados['valor']);
                    
                    if(!$consultaItem->execute()) return 0;
                }

            } else {
                return 0;
            }

            unset($_SESSION["carrinho"]);
            return 1;

        }
            

    }