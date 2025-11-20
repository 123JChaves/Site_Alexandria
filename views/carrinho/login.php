<div class="card shadow-lg border-0 rounded-4">
    <div class="card-header text-center rounded-top-4 py-3">
        <h3 class="mb-0">Entre ou Cadastre-se</h3>
    </div>

    <div class="card-body p-4">
        <div class="row">

            <div class="col-12 col-md-6 mt-4 mt-md-0">
                <h4>Faça o Login:</h4>

                <form name="formLogin" method="post" action="carrinho/logar" data-parsley-validate>

                    <div class="mb-3">
                        <label for="login_email" class="form-label">Seu email:</label>
                        <input type="email" name="email" id="login_email" class="form-control"
                               autocomplete="email"
                               required
                               data-parsley-required-message="Preencha o email"
                               data-parsley-type-message="Digite um email válido">
                    </div>

                    <div class="mb-3">
                        <label for="login_senha" class="form-label">Sua senha:</label>
                        <input type="password" name="senha" id="login_senha" class="form-control"
                               autocomplete="current-password"
                               required minlength="6"
                               data-parsley-required-message="Preencha a senha"
                               data-parsley-minlength-message="Digite no mínimo 6 caracteres">
                    </div>

                    <button type="submit" class="btn btn-success mt-2 border-0 rounded-4">Efetuar Login</button>
                </form>
            </div>

            <div class="col-12 col-md-6 mt-4 mt-md-0">
                <h4>Faça seu Cadastro:</h4>

                <form name="formCadastro" method="post" action="carrinho/cadastrar" data-parsley-validate>

                    <div class="mb-3">
                        <label for="cli_nome" class="form-label">Seu nome:</label>
                        <input type="text" name="nome" id="cli_nome" class="form-control"
                               required
                               data-parsley-required-message="Preencha o nome">
                    </div>

                    <div class="mb-3">
                        <label for="cli_email" class="form-label">Seu email:</label>
                        <input type="email" name="email" id="cli_email" class="form-control"
                               autocomplete="email"
                               required
                               data-parsley-required-message="Preencha o email"
                               data-parsley-type-message="Digite um email válido">
                    </div>

                    <div class="mb-3">
                        <label for="cli_senha" class="form-label">Sua senha:</label>
                        <input type="password" name="senha" id="cli_senha" class="form-control"
                               autocomplete="new-password"
                               required minlength="6"
                               data-parsley-required-message="Preencha a senha"
                               data-parsley-minlength-message="Digite no mínimo 6 caracteres">
                    </div>

                    <div class="mb-3">
                        <label for="cli_senhaRedigitada" class="form-label">Confirmar senha:</label>
                        <input type="password" name="senhaRedigitada" id="cli_senhaRedigitada"
                               class="form-control"
                               autocomplete="new-password"
                               required
                               data-parsley-required-message="Confirme a senha"
                               data-parsley-equalto="#cli_senha"
                               data-parsley-equalto-message="As senhas digitadas são diferentes">
                    </div>

                    <button type="submit" class="btn btn-success mt-2 border-0 rounded-4">Efetuar Cadastro</button>
                </form>
            </div>

        </div>
    </div>
</div>