<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
    $usuario->conectar("cadastrousuarioturma33","localhost","root", "");

    if (isset($_GET)) {

        $email = $_GET['email'];

        $oi = $usuario->getUsuario($email);

        if (isset($oi)) {

            print_r ($oi);  
        }
    }

    if (!empty($_POST['nome']))
    {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $id = $_POST['id'];

        $usuario->editarUsuario($nome, $email, $telefone, $id);
    }
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
    <input type="text" name="id" value="<?php echo $oi['id_usuario'];?>" ><br>
    
    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?php echo $oi['nome'];?>" ><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?php echo $oi['email'];?>"><br>

    <label>Telefone:</label><br>
    <input type="tel" name="telefone" value="<?php echo $oi['telefone'];?>"><br>

    <label>Senha:</label><br>
    <input type="text" name="senha" value="<?php echo $oi['senha'];?>"><br>

    <input type="submit" value="Salvar">
    </form>



</body>
</html>