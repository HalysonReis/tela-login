<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
    $usuario->conectar("cadastrousuarioturma33","localhost","root", "");
    $dados = $usuario->listarUsuarios();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Dados</title>
</head>
<body>
    <h1>LISTAR USUÁRIO</h1>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($dados))
                {
                    foreach ($dados as $pessoa):
            ?>
                <tr>

                    <form action="editar.php" method="get">
                        <td><input type="text" name="nome"  value="<?php echo $pessoa['nome'];?>" disabled></td>
                        <td><input type="text" name="email" value="<?php echo $pessoa['email'];?>" ></td>
                        <td><input type="text" name="telefone" value="<?php echo $pessoa['telefone'];?>" disabled></td>
                        <td><input type="submit" value="editar"></a></td>
                    </form>
                </tr>
            <?php 
                endforeach;
                }
                else
                {
                    echo "Nenhum Usuário Cadastrado.";
                }

            ?>
        </tbody>
    </table>
</body>
</html>