<?php

    require_once 'usuario.php';
    $usuario = new Usuario();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Cadastro</title>
</head>
<body>
    <h2>Tela Cadastro</h2>
    <br><br>
    <form action="" method="post">
        <label>Nome:</label>
        <input type="text" name="nome" id="" placeholder="Nome completo">
        <br>
        <label>Email:</label>
        <input type="email" name="email" id="" placeholder="email completo">
        <br>
        <label>Telefone:</label>
        <input type="tel" name="telefone" id="" placeholder="telefone completo">
        <br>
        <label>Senha:</label>
        <input type="password" name="senha" id="" placeholder="senha completo">
        <br>
        <label>Confirmar Senha:</label>
        <input type="password" name="confsenha" id="" placeholder="confirme sua senha">
        <br>
        <input type="submit" value="CADASTRAR">
        <br>
    </form>

    <?php

    if(isset($_POST['nome']))
    {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $senha = $_POST['senha'];
        $confsenha = addslashes($_POST['confsenha']);

        if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confsenha))
        {
            $usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");
            if($usuario->msgErro == "")
            {
                
                if($senha == $confsenha)
                {
                    if($usuario->cadastrar($nome, $telefone, $email, $senha))
                    {
                        ?>
                            <!-- bloco HTML -->

                            <div class="msg-sucesso">
                                <p>Cadastrado com sucesso</p>
                                <p>Clique <a href="login.php">aqui</a> para logar.</p>
                            </div>

                        <?php
                    }
                }

            }
            else
            {
                echo "tente outra vez".usuario->msgErro;
            }
        }

    }
    ?>

</body>
</html>