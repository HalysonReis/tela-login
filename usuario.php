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
            catch (PDOException $erro)
            {
                $msgErro = $erro-> getMenssage();
            }
        }

        public function cadastrar($nome, $telefone, $email, $senha)
        {
            global $pdo;

            //verificar se o email ja esta cadastrado
            $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :maria");
            $sql->bindValue(":maria",$email);
            $sql->execute();

            //verifica email cadastrado
            if($sql->rowCount() > 0)
            {
                return false;
            }

            //cadastro usuario
            else
            {
                $sql = $pdo->prepare("INSERT INTO usuario (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":t",$telefone);
                $sql->bindValue(":e",$email);
                $sql->bindValue(":s",$senha);
                $sql->execute();
                
                return true;
            }
        }

    }

?>