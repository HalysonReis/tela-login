<?php
    Class Usuario
    {
        private $pdo;

        public $msgErro = "";

        public function conectar($nome, $host, $usuario, $senha)
        {
            global $pdo;

            try
            {
                $pdo = new PDO("mysql:dbname=".$nome, $usuario, $senha);
            }
            catch(PDOexception $erro)
            {
                $msgErro = $erro->getMessage();
            }
        }

        public function cadastrar($nome, $telefone, $email, $senha)
        {

            global $pdo;
            
            //verificar se o email já está cadastrado
            $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :m");
            // :m siginfica que colocamos um apelido na variável email do PHP
            $sql->bindValue(":m",$email);
            $sql->execute();

            //verificar se existe o email cadastrado
            if($sql->rowCount() > 0)
            {
                return false;
            }
            else
            {
                //cadastrar usuário
                $sql = $pdo->prepare("INSERT INTO usuario (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
                $sql->bindValue(":n", $nome); 
                $sql->bindValue(":t", $telefone);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s",md5($senha));
                $sql->execute();
                return true;
            }

        }

        public function logar($email,$senha)
        {
            global $pdo;

            $verificarEmail = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e AND senha =:s");
            $verificarEmail->bindValue(":e", $email);
            $verificarEmail->bindValue(":s", md5($senha));
            $verificarEmail->execute();

            if($verificarEmail->rowCount()>0)
            {
                //posso logar no sistema, pois o email e senha existe no banco de dados e estão de acordo.
                $dados = $verificarEmail->fetch();
                session_start();
                $_SESSION['id_usuario'] = $dados['id_usuario'];
                return true;
            }

            else
            {
                return false;
            }

        }
        public function listarUsuarios()
        {
            global $pdo;

            $sqlListar = $pdo->prepare("SELECT * FROM usuario");
            $sqlListar->execute();
            if($sqlListar->rowCount()>0)
            {
                $dados = $sqlListar->fetchAll(PDO::FETCH_ASSOC);
                return $dados;
            }
            else
            {
                return false;
            }
        }

        public function getUsuario($email)
        {
            global $pdo;


            $sqlEditar = $pdo->prepare("SELECT * FROM usuario WHERE email = :m");
            $sqlEditar->bindValue(":m", $email);
            $sqlEditar->execute();
            if($sqlEditar->rowCount()>0)
            {
                $dados = $sqlEditar->fetch();
                return $dados;
            }
            else
            {
                return false;
            }
        }

        public function editarUsuario($nome, $email, $telefone, $id)
        {
            global $pdo;

            $sqlEditar = $pdo->prepare("UPDATE usuario set nome = :n, email = :e, telefone = :t WHERE id_usuario = :i");
            $sqlEditar->bindValue(":n", $nome);
            $sqlEditar->bindValue(":e", $email);
            $sqlEditar->bindValue(":t", $telefone);
            $sqlEditar->bindValue(":i", $id);
            $sqlEditar->execute();
        }

        public function deletarUsuario($id)
        {
            global $pdo;

            $sqlDeletar = $pdo->prepare("DELETE FROM usuario WHERE id_usuario = :i");
            $sqlDeletar->bindValue(":i", $id);
            $sqlDeletar->execute();
        }

    }


?>