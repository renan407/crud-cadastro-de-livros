<?php

# Dados para a conexão com o banco de dados
include( 'dadosconexao.php' );

#Executa a conexão com o Mysql
/*$link = mysqli_connect( $servidor, $usuario, $senha, $dbname )or die( "Nao foi possível conectar: " . mysqli_error() );*/

#Cria  a expressão SQL de consulta aos registros
$sql = "SELECT * FROM LIVROS";


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>LISTA DE REGISTROS</title>
<link href="css/lista_estilo.css" rel="stylesheet" type="text/css">
</head>
<h1>LISTA DE REGISTROS</h1>
<body>
<section>
  <form>
    <fieldset>
      <legend><b>LIVROS CADASTRADOS</b></legend>
      <table border=1>
        <tr>
          <td><h2>Cód</h2></td>
          <td><h2>Livro</h2></td>
          <td><h2>Autor</h2></td>
          <td><h2>Editora</h2></td>
          <td><h2>Senha</h2></td>
          <td><h2>Arquivo</h2></td>
        </tr>
        <?php


        # Exibe os resultados de novidade e notícias
        $result = mysqli_query( $link, $sql );

        while ( $tbl = mysqli_fetch_array( $result ) ) {
            $Codigo = $tbl[ "id" ];
            $Livro = $tbl[ "livro" ];
            $Autor = $tbl[ "autor" ];
            $Editora = $tbl[ "editora" ];
            $senhaUser = $tbl[ "senhaUser" ];
            $arquivo = $tbl[ "arquivo" ];


            #colocando os dados dentro da tabela

            echo "<tr>";
            # 1 alteraçao para editar
            echo "<td>$Codigo<br> ";
            echo "<a href=\"inserir.php?acao=editar&buscacodigo=$Codigo\">";
            echo "(Editar)</a><br>";
            # Excluir
			echo "<a href=\"gerencia_registro.php?acao=excluir&buscacodigo=$Codigo\">";
            echo "(Excluir)</a></td>";
            echo "<td>$Livro</td>";
            echo "<td>$Autor</td>";
            echo "<td>$Editora</td>";
            echo "<td>$senhaUser</td>";
            echo "<td><img src='foto/" . $tbl[ "arquivo" ] . "' 
	  width='50px' 'height='50px' alt='Foto de exibição'/></td>";
            echo "</tr>";
        }
        ?>
		  
      </table>
    </fieldset>
  </form>
  <br>
  <a href="inserir.php">
  <button class="personalizado">Clique aqui para inserir um novo registro.</button></a>
	  <a href="imprimir.php">
  <button class="personalizado2">Clique para gerar PDF do registro.</button>
  </a> </section>
</body>
</html>