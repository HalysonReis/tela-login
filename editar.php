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
    <title>Editar</title>
</head>
<body>
    <h2>Edição DE USUÁRIO</h2><br>
    <form action="" method="post">

    <label>Nome:</label><br>
    <input type="text" name="nome" id="" placeholder="Nome Completo"><br>

    <label>Email:</label><br>
    <input type="email" name="email" id="" placeholder="Digite o Email"><br>

    <label>Telefone:</label><br>
    <input type="tel" name="telefone" id="" placeholder="Telefone Completo"><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" id="" placeholder="Digite sua Senha"><br>

    <input type="submit" value="EDITAR">
    </form>



</body>
</html>