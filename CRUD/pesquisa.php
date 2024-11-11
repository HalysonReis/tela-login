<?php

    $nome = $email = $senha = "";

    if ($_SERVER["REQUEST_METHOD" ] == "POST") {
        
        //declarando variaveis que vao ser passadas como parametros para se cenectar com o DB
        $host = "localhost";
        $dbname = "dbcrud1";
        $user = "root";
        $pass = "";

        try { // ele tenta se conectar com o DB se nao conseguir vai par a excecao
            // criando um objeto que vai receber a classe PDO e passando os parametros para se conectar ao DB 
            $pdo = new PDO("mysql:host=$host; dbname=$dbname", $user, $pass); // medoto do PDO para se conectar com o DB

            // definindo tartamento de erro
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id = $_POST['id'];

            $sql = "SELECT * FROM pessoa WHERE id = :id";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row)
            {
                $nome = $row['nome'];
                $email = $row['email'];
                $senha = $row['senha'];
            }else
            {
                $nome = $email = $senha = "";
            }
        } catch (PDOExeption $erro) // caso de erro ele pega e excecao e armezena na variavel $erro
        {
            echo "ERRO: ".$erro->getMessage(); // print do erro usando o metodo getMessage()
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa e atualizacao</title>
</head>
<body>
    <h2>atualizar cadastro</h2>

    <!-- pesquisar usuario pelo id -->
    
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <p>
            ID: <input type="text" name="id">
            <input type="submit" value="pesquisar">
        </p>
    </form>

    <hr>
    <?php if (!empty($nome)) { ?>
    <!-- atualizar dados -->
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <br>
        <label>Nome:</label>
        <input type="text" nome="nome" value="<?php echo $nome; ?>">
        <br>
        <label>E-mail:</label>
        <input type="email" nome="email" value="<?php echo $email; ?>">
        <br>
        <label>Senha:</label>
        <input type="password" nome="senha" value="<?php echo $senha; ?>">
        <br>
        <input type="submit" value="Atualizar">
    </form>
    <?php } else { ?>
        <form method="post" action="">
        <input type="hidden" name="id" disabled>

        <label>Nome:</label> 
        <input type="text" nome="nome" placeholder="Nome" disabled>
        <br>
        <label>Email:</label> 
        <input type="email" nome="email" placeholder="E-mail" disabled>
        <br>
        <label>Senha:</label> 
        <input type="password" nome="senha" placeholder="Senha" disabled>
        <br>
        <input type="submit" value="atualizar" disabled>
    </form>
    <?php } ?>
</body>
</html>