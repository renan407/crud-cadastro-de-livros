<?php
# 2 alteraçao para editar
include( 'dadosconexao.php' );



if ( isset( $_REQUEST[ "acao" ] ) && $_REQUEST[ "acao" ] == "editar" ) {
    $sql = "SELECT * FROM LIVROS WHERE ID = " . $_REQUEST[ 'buscacodigo' ];

    $result = mysqli_query( $link, $sql );

    # Valida se o registro existe no banco de dados
    if ( $tbl = mysqli_fetch_array( $result ) ) {
        # Armazena os dados para preencher no formulário a seguir
        $Codigo = $tbl[ "id" ];
        $Livro = $tbl[ "livro" ];
        $Autor = $tbl[ "autor" ];
        $Editora = $tbl[ "editora" ];
        $senhaUser = $tbl[ "senhaUser" ];
        $arquivo = $tbl[ "arquivo" ];
    } else {
        echo "Registro não encontrado.";
    }
}
# fim da 2 alteraçao para editar
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Crud PHP</title>
<link href="css/estilo_2.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Preencha os campos abaixo:</h1>
	
<?php
# 3 alteraçao para editar
if ( isset( $_REQUEST[ "acao" ] ) && $_REQUEST[ "acao" ] == "editar" ) {
    $AcaoForm = "alterar";
} else {
    $AcaoForm = "adicionar";
    $Codigo = "";
    $Livro = "";
    $Autor = "";
    $Editora = "";
    $senhaUser = "";
    $arquivo = "";

}
# fim da 3 alteraçao para editar
?>
	
<section> 
  <!-- action = fazendo coneção com pagina-->
  <form id="cadastro" enctype="multipart/form-data" name="cadastro" method="post" action="gerencia_registro.php?acao=<?php echo $AcaoForm; ?>">
    <!--4 alteraçao para editar-->
    <input type="hidden" name="Codigo" value="<?php echo $Codigo; ?>">
    <fieldset>
      <legend><b>CADASTRO DE LIVROS</b></legend>
      <!--fim da 4 alteraçao para editar-->
      <p>
      <div class="input-container">
        <input name="livro" type="text" required="required" id="livro" autocomplete="on"  maxlength="50" pattern=".+" value="<?php echo $Livro; ?>">
        <label for="livro">Livro:</label>
      </div>
      </p>
      <p>
      <div class="input-container">
        <input name="autor" type="text" required="required" id="autor" autocomplete="on"  maxlength="50" pattern=".+" value="<?php echo $Autor; ?>">
        <label for="autor">Autor:</label>
      </div>
      </p>
      <p>
      <div class="input-container">
        <input name="editora" type="text" required="required" id="editora" maxlength="50" pattern=".+" value="<?php echo $Editora; ?>">
        <label for="editora">Editora:</label>
      </div>
      </p>
      <p>
      <div class="input-container">
        <input name="senhaUser" type="password" required="required" id="senhaUser" maxlength="8" pattern=".+" value="<?php echo $senhaUser; ?>">
        <label for="senhaUser">Senha:</label>
      </div>
      </p>
      <p> 
        <!--Input da imagem-->
        <label for="arquivo"></label>
        <input type="file" name="arquivo" class="form-control" required >
      </p>
	
      <?php
      # 5 alteraçao para editar
      if ( isset( $_REQUEST[ "acao" ] ) && $_REQUEST[ "acao" ] == "editar" ) {
          $NomeBotao = "Alterar";
      } else {
          $NomeBotao = "Cadastrar";
      }
      # Fim da 5 alteraçao para editar
      ?>
      
      <!--BOTÕES-->
      <input type="submit" value="<?php echo $NomeBotao; ?>"class="personalizado">
      <p> 
        <!--  <input class="personalizado" type="submit" name="enviar" id="enviar" value="Cadastrar">--> 
      </p>
      <input type="reset" name"limpar" value="Limpar" id="limpar" style="background: #ff8c00; border-radius: 6px; padding: 15px; cursor: pointer; color: #fff; border: none; font-size: 16px;">
      </div>
    </fieldset>
  </form>
  <a href="lista.php">
  <button class="personalizadoCinza">Visualizar Lista De Registros</button>
  </a> </section>
</body>
</html>