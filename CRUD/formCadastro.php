<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario De Cadastro</title>
</head>
<body>
    <h1>Formulario De Cadastro</h1>
    <form action="cadastrar.php" method="post">
        <label>Nome:</label>
        <input type="text" name="nome" placeholder="Seu Nome" require><br>
        <label>E-mail:</label>
        <input type="email" name="email" placeholder="Seu E-mail" require><br>
        <label>Senha:</label>
        <input type="password" name="senha" placeholder="Sua Senha" require><br>
        <br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>