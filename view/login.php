<?php if (isset($_SESSION['alerta_sucesso'])): ?>
    <script>
        alert("<?php echo $_SESSION['alerta_sucesso']; ?>");
    </script>
    <?php unset($_SESSION['alerta_sucesso']); ?>
<?php endif; ?>
<section class="auth-section">
    <div class="auth-container">
        <div class="logo logo-center">
            <div class="logo-icon">🤘</div>
            <div>
                <h1 style="color: white; margin: 0;">PARTYPAL</h1>
            </div>
        </div>

        <div class="auth-card" id="card-cadastro">
            <h2>Criar sua conta</h2>
            <form action="index.php?p=cadastrar" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Seu nome completo" required>
                </div>
                
                <div class="form-group">
                    <label for="email_cadastro">E-mail</label>
                    <input type="email" id="email_cadastro" name="email" placeholder="seu@email.com" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                    </div>
                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" class="input-date" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="senha_cadastro">Senha</label>
                    <input type="password" id="senha_cadastro" name="senha" placeholder="Crie uma senha forte" required>
                </div>

                <div class="form-group">
                    <label for="senha_cadastro_confirma">Confirmar Senha</label>
                    <input type="password" id="senha_cadastro_confirma" name="senha_confirma" placeholder="Repita a senha criada" required>
                </div>

                <button type="submit" class="auth-btn-primary full-width">Cadastrar</button>
                <p class="auth-link">Já tem uma conta? <a href="#" onclick="alternarFormulario('login')">Faça login</a></p>
            </form>
        </div>

        <div class="auth-card" id="card-login" style="display: none;">
            <h2>Acessar Conta</h2>
            <form action="index.php?p=logar" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <div class="form-group">
                    <label for="email_login">E-mail</label>
                    <input type="email" id="email_login" name="email" placeholder="seu@email.com" value="<?php echo isset($_COOKIE['email_salvo']) ? htmlspecialchars($_COOKIE['email_salvo']) : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="senha_login">Senha</label>
                    <input type="password" id="senha_login" name="senha" placeholder="Sua senha" required>
                </div>

                <button type="submit" class="auth-btn-primary full-width">Entrar</button>
                
                <p class="auth-link" style="margin-bottom: 5px;">
                    <a href="#" onclick="alternarFormulario('recuperar')" style="color: #bdbdbd; font-weight: 400; font-size: 13px;">Esqueceu sua senha?</a>
                </p>
                <p class="auth-link">Não tem conta? <a href="#" onclick="alternarFormulario('cadastro')">Cadastre-se</a></p>
            </form>
        </div>

        <div class="auth-card" id="card-recuperar" style="display: none;">
            <h2>Recuperar Senha</h2>
            <p style="text-align: center; color: #bdbdbd; font-size: 14px; margin-bottom: 20px;">
                Valide seus dados obrigatórios para redefinir sua senha.
            </p>
            <form action="index.php?p=recuperarSenha" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <div class="form-group">
                    <label for="email_recuperar">E-mail</label>
                    <input type="email" id="email_recuperar" name="email" placeholder="seu@email.com" required>
                </div>

                <div class="form-group">
                    <label for="cpf_recuperar">CPF</label>
                    <input type="text" id="cpf_recuperar" name="cpf" placeholder="000.000.000-00" required>
                </div>
                
                <div class="form-group">
                    <label for="data_nascimento_recuperar">Data de Nascimento</label>
                    <input type="date" id="data_nascimento_recuperar" name="data_nascimento" class="input-date" required>
                </div>

                <div class="form-group">
                    <label for="nova_senha">Nova Senha</label>
                    <input type="password" id="nova_senha" name="nova_senha" placeholder="Digite a nova senha" required>
                </div>

                <div class="form-group">
                    <label for="nova_senha_confirma">Confirmar Nova Senha</label>
                    <input type="password" id="nova_senha_confirma" name="nova_senha_confirma" placeholder="Repita a nova senha" required>
                </div>

                <button type="submit" class="auth-btn-primary full-width">Redefinir Senha</button>
                <p class="auth-link">Lembrou a senha? <a href="#" onclick="alternarFormulario('login')">Voltar para o Login</a></p>
            </form>
        </div>
    </div>

    <script>
        function alternarFormulario(tela) {
            document.getElementById('card-cadastro').style.display = 'none';
            document.getElementById('card-login').style.display = 'none';
            document.getElementById('card-recuperar').style.display = 'none';

            if (tela === 'cadastro') {
                document.getElementById('card-cadastro').style.display = 'block';
            } else if (tela === 'login') {
                document.getElementById('card-login').style.display = 'block';
            } else if (tela === 'recuperar') {
                document.getElementById('card-recuperar').style.display = 'block';
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const action = urlParams.get('action');
            
            if (action === 'cadastro') {
                alternarFormulario('cadastro');
            } else if (action === 'login') {
                alternarFormulario('login');
            }
        });
    </script>
</section>