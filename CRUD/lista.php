<?php
    $nome = $email = $senha = "";
    $nomenv = $emailnv = $senhanv = "";
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

        $sql = "SELECT * FROM pessoa";

        $stmt = $pdo->prepare($sql);

        $stmt->execute();

        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);


    } catch (PDOExeption $erro) // caso de erro ele pega e excecao e armezena na variavel $erro
    {
        echo "ERRO: ".$erro->getMessage(); // print do erro usando o metodo getMessage()
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Senha</th>
                <th>Editar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($row as $pessoa) { ?>
            <tr>
                <form method="POST">
                <td>
                    <label type="hidden" ><?php echo $pessoa['id'] ?></label>
                    <input type="hidden" name="id" value="<?php echo $pessoa['id'] ?>">
                </td>
                <td>
                    <label><?php echo $pessoa['nome'] ?></label>
                    <input type="hidden" name="nome" value="<?php echo $pessoa['nome'] ?>">
                </td>
                <td>
                    <label><?php echo $pessoa['email'] ?></label>
                    <input type="hidden" name="email" value="<?php echo $pessoa['email'] ?>">
                </td>
                <td>
                    <label><?php echo $pessoa['senha'] ?></label>
                    <input type="hidden" name="senha" value="<?php echo $pessoa['senha'] ?>">
                </td>
                <td>
                    <input type="submit" value="Editar">
                </td>
            </form>
            </tr>
            <?php } 
            
            if (isset($_POST['nome']))
            {

                $id = $_POST['id'];
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                if (!empty($nome)){
                ?>
                    <form method="POST">
                        <label>ID: <?php echo $id; ?></label><br>

                        <label>Nome:</label>
                        <input type="text" nome="nome" value="<?php echo $nome; ?>">
                        
                        <label>E-mail:</label>
                        <input type="email" nome="email" value="<?php echo $email; ?>">
                        
                        <label>Senha:</label>
                        <input type="password" nome="senha" value="<?php echo $senha; ?>">
                        
                        <input type="submit" value="Atualizar">
                    </form>
            <?php 
                if (isset($_POST['nome']))
                {
                    $id = $_POST['id'];
                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $senha = $_POST['senha'];

                    $sql = "UPDATE pessoa SET nome = :n, email = :e, senha = :s WHERE id = :i";

                    // stmt = statement
                    // usando o metodo prepare para preparar os dados para serem enviados no para o DB
                    $stmt = $pdo->prepare($sql);

                    // metodo usado para escunder os parametros
                    //convertendo a variavel para string, e depois conectando ela com o :nome
                    $stmt->bindValue(':i', $id);
                    $stmt->bindValue(':n', $nome);
                    $stmt->bindValue(':e', $email);
                    $stmt->bindValue(':s', $senha);

                    $stmt->execute();
                }
            }
                    
            }

            ?>
        </tbody>
    </table>
</body>
</html>