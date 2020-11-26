<?php
include( 'dadosconexao.php' );

/*#Criar a conexão mysqli_connect() e atribuir para uma variavel $link
$link = mysqli_connect( $servidor, $usuario, $senha, $dbname )or die( "Nao foi possível conectar: " . mysqli_error() );*/


# Verifica se o arquivo foi chamado a partir de um formulário
if ( isset( $_REQUEST[ "acao" ] ) && $_REQUEST[ "acao" ] == "adicionar" ) {

    #Código imagem
    if ( isset( $_FILES[ 'arquivo' ] ) )

    {
        #Define o fuso horário padrão
        date_default_timezone_set( "Brazil/East" );

        #Pega extensão do arquivo/minúscula
        $ext = strtolower( substr( $_FILES[ 'arquivo' ][ 'name' ], -4 ) );

        #Definindo um novo nome para o arquivo
        $new_name = date( "Y.m.d-H.i.s" ) . $ext;

        #Diretorio criado na pasta do site
        $dir = 'foto/';

        #Faz o upload do aquivo
        move_uploaded_file( $_FILES[ 'arquivo' ][ 'tmp_name' ], $dir . $new_name );
    }
	
	#Código imagem TERMINA AQUI

    $livro = filter_input( INPUT_POST, 'livro', FILTER_SANITIZE_STRING );
    $autor = filter_input( INPUT_POST, 'autor', FILTER_SANITIZE_STRING );
    $editora = filter_input( INPUT_POST, 'editora', FILTER_SANITIZE_STRING );
    $senhaUser = filter_input( INPUT_POST, 'senhaUser', FILTER_SANITIZE_STRING );
    $Codigo = filter_input( INPUT_POST, 'Codigo', FILTER_SANITIZE_NUMBER_INT );

    # Recebe o nome do arquivo
    $img = $new_name;


    # cria a expressao do SQL de inserção
    $sql = "insert into livros (id,livro,autor,editora,senhaUser,arquivo,created)
values('$Codigo','$livro','$autor','$editora','$senhaUser','$img',now())";


    $result = mysqli_query( $link, $sql );


    # Verifica o sucesso da operação
    if ( !$result ) {
        die( 'Erro: ' . mysqli_error( $link ) );
    }

    # Se a operação foi realizada com sucesso, informa na tela
    else {
        echo '<h1>A operação foi realizada com sucesso.</h1>';
    }
}


			/*****UPADATE*****/
else if ( isset( $_REQUEST[ "acao" ] ) && $_REQUEST[ "acao" ] == "alterar" ) {


    $id = $_POST[ "Codigo" ];
    $livro = $_POST[ "livro" ];
    $autor = $_POST[ "autor" ];
    $editora = $_POST[ "editora" ];
    $senhaUser = $_POST[ "senhaUser" ];
    $arquivo = $_FILES[ 'arquivo' ][ 'name' ];


    #Atualizar
    /* $sql = "UPDATE livros SET";
     $sql .= "livro = '".$_REQUEST['livro']."', ";
     $sql .= "autor = '".$_REQUEST['autor']."', ";
     $sql .= "editora = '".$_REQUEST['editora']."', ";
     $sql .= "senhaUser = '".$_REQUEST['senhaUser']."', ";
     $sql .= "arquivo = '".$_FILES['arquivo']['name']."'";
     $sql .= "WHERE ID = ".$_REQUEST['Codigo'];*/
	
	
	

    if ( isset( $_FILES[ 'arquivo' ] ) ) {
        #Define o fuso horário padrão
        date_default_timezone_set( "Brazil/East" );

        #Pega extensão do arquivo/minúscula
        $ext = strtolower( substr( $_FILES[ 'arquivo' ][ 'name' ], -4 ) );

        #Definindo um novo nome para o arquivo
        $new_name = date( "Y.m.d-H.i.s" ) . $ext;

        #Diretorio criado na pasta do site
        $dir = 'foto/';

        #Faz o upload do aquivo
        move_uploaded_file( $_FILES[ 'arquivo' ][ 'tmp_name' ], $dir . $new_name );

    }
    $img = $new_name;

	
	

    $sql = ( "UPDATE livros SET livro ='$livro', autor = '$autor', editora = '$editora',
	senhaUser = '$senhaUser', arquivo = '$img' WHERE id='$id'" );


    $result = mysqli_query( $link, $sql );

    if ( !$result ) {
        echo( 'erro aqui:' . mysqli_error() );
    } else {
        echo "<h1>Operação realizada com sucesso.</h1>";
    }


}
			/*****DELETE*****/
else if ( isset( $_REQUEST[ "acao" ] ) && $_REQUEST[ "acao" ] == "excluir" ) {
	
	$sql = "DELETE FROM livros WHERE id=". $_REQUEST[ 'buscacodigo' ];
	
	$result = mysqli_query( $link, $sql );
	
	if ( !$result ) {
        echo( 'erro aqui:' . mysqli_error() );
    } else {
        echo "<h1>Operação realizada com sucesso.</h1>";
    }
	
	mysqli_close($link);
	
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Gerência registro</title>
<link href="css/estilo_gerencia.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Direcionamento:</h1>
<!--Criando o link para os registros-->
<section>
  <fieldset>
    <legend><b>INSERIR || VISUALIZAR</b></legend>
    <p> <a href="inserir.php">
      <button class="personalizado">Clique aqui para INSERIR um novo registro</button>
      </a></p>
    <br>
    <a href="lista.php">
    <button class="personalizado2" >Clique aqui para VISUALIZAR os registros</button>
    </a>
  </fieldset>
</section>
</body>
</html>