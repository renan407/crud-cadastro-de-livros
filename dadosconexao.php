<?php
# Dados para a conexão com o banco de dados
$servidor = 'localhost'; # Nome DNS ou IP do seu servidor HTTP
$usuario = 'root'; # Nome de usuário para acesso ao MySQL
$senha = ''; # Senha de acesso
$dbname = "db_livraria"; # Nome do banco de dado

$link = mysqli_connect( $servidor, $usuario, $senha, $dbname )
or die( 'Não foi possivel conectar: ' . mysqli_error( $link ) );
?>

