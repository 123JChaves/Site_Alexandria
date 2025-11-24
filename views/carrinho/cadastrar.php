<?php
    $email = $_POST["email"] ?? NULL;
    $nome = $_POST["nome"] ?? NULL;

    if(empty($nome)) {
        echo "<script>alert('Digite um nome');history.back()</script>";
    }
    
    $msg = $this->carrinho->salvar($_POST);

    if($msg == 1) {
        ?>
        <p class="alert alert-success text-center">
            <strong>Pronto!</strong> Seu cadastro foi realizado com sucesso!<br>
            <a href="carrinho/finalizar">Clique aqui e faça seu login</a>
        </p>
        <?php
    } else if($msg == 0) {
        ?>
        <p class="text-center alert alert-danger">
            Ops! Erro ao cadastrar! Verifique seus dados e tente novamente!<br>
            <a href="javascript:history.back()">Voltar à tela de cadastro</a>
        </p>
        <?php
    } else {
        ?>
        <p class="text-center alert alert-danger">
            Este email <?=$email?> já está cadastrado<br>
            <a href="javascript:history.back()">Voltar à tela de cadastro</a>
        </p>
        <?php
    }
