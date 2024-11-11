<?php 

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

            // capturando dados do form e armazenando em suas respectivas variaveis
            // como o post retornado e um array e tratado como tal
            if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])){
                $id = $_POST['id'];
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
            } else {
                echo "vazio ";
                print_r($_POST);
            }

            $sql = "UPDATE pessoa SET nome = :nome, email = :email, senha = :senha WHERE id = :id";

            // stmt = statement
            // usando o metodo prepare para preparar os dados para serem enviados no para o DB
            $stmt = $pdo->prepare($sql);

            // metodo usado para escunder os parametros
            //convertendo a variavel para string, e depois conectando ela com o :nome
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);

            // execusao do insert depois de esconder os dados
            if ($stmt->execute()) {
                echo '<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario De Cadastro</title>
</head>
<body>
    <h2>cadastro atualizado com sucesso</h2>
    <hr>
    <button onclick="history.go(-1);">retornar</button>
</body>
</html>';
            } else 
            {
                echo '<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario De Cadastro</title>
</head>
<body>
    <h2>cadastro atualizado com sucesso</h2>
    <hr>
    <button onclick="history.go(-1);">retornar</button>
</body>
</html>';
            }
        } catch (PDOExeption $erro) // caso de erro ele pega e excecao e armezena na variavel $erro
        {
            echo "ERRO: ".$erro->getMessage(); // print do erro usando o metodo getMessage()
        }
    } else
    {
        echo "conexao nao estabelecida";
    }

?>