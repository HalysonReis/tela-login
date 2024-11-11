<?php
    // $_SERVER este medodo verifica qual o medoto do request(get ou post) e se for igual a post retorna TRUE
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
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            // variavel para inserir dados na tabela pessoa
            // os dois pontos server para reservar este ponto para depois inserir os valores serve para serguranca
            $sql = "INSERT INTO pessoa (nome, email, senha) VALUES (:nome, :email, :senha)";

            // stmt = statement
            // usando o metodo prepare para preparar os dados para serem enviados no para o DB
            $stmt = $pdo->prepare($sql);

            // metodo usado para escunder os parametros
            //convertendo a variavel para string, e depois conectando ela com o :nome
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);

            // execusao do insert depois de esconder os dados
            $stmt->execute();

            echo "usuario inserido com sucesso";

        } catch (PDOExeption $erro) // caso de erro ele pega e excecao e armezena na variavel $erro
        {
            echo "ERRO: ".$erro->getMessage(); // print do erro usando o metodo getMessage()
        }

    } else
    {
        echo "conexao nao estabelecida";
    }

?>