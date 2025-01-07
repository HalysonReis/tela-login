<?php

Class Database
{
    private $pdo;

    private function conecting()
    {
        global $pdo;

        try
        {
            $nome = "client_crud_php";
            $usuario = "root";
            $senha = "";

            $pdo = new PDO("mysql:dbname=".$nome, $usuario, $senha);

            return TRUE;
        }
        catch (PDOexception $erro)
        {
            return $erro->getMessage();
        }
    }

    private function close_conection()
    {
        $pdo = NULL;
    }

    
}

$c = new Client;

?>
