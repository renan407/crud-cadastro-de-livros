<?php

# Dados para a conexão com o banco de dados
$servidor = 'localhost'; # Nome DNS ou IP do seu servidor HTTP
$usuario = 'root'; # Nome de usuário para acesso ao MySQL
$senha = ''; # Senha de acesso
$dbname = "db_livraria"; # Nome do banco de dado
$link = mysqli_connect( $servidor, $usuario, $senha, $dbname );

$html = '<table border=1>';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>Cód</th>';
$html .= '<th>Livro</th>';
$html .= '<th>Autor</th>';
$html .= '<th>Editora</th>';
$html .= '<th>Senha</th>';
$html .= '<th>Arquivo</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';


$result_trancaoes = "SELECT * FROM livros";
$result_trancaoes = mysqli_query( $link, $result_trancaoes );
while ( $row_trancaoes = mysqli_fetch_array( $result_trancaoes ) ) {
   
    $html .= '<tr><td>' . $row_trancaoes[ 'id' ] . ' </td>';
    $html .= '<td>' . $row_trancaoes[ 'livro' ] . ' </td>';
    $html .= '<td>' . $row_trancaoes[ 'autor' ] . ' </td>';
    $html .= '<td>' . $row_trancaoes[ 'editora' ] . ' </td>';
	$html .= '<td>' . $row_trancaoes[ 'senhaUser' ] . ' </td>';
    $html .= '<td>' . $row_trancaoes[ 'arquivo' ] . ' </td></tr>';
    
}

$html .= '</tbody>';
	$html .= '</table';




//referenciar o DomPDF com namespace
use Dompdf\ Dompdf;

// include autoloader
require_once( "dompdf/autoload.inc.php" );

//Criando a Instancia
$dompdf = new DOMPDF();

// Carrega seu HTML
$dompdf->load_html( '<h1 style="text-align: left;">Relatório de Registros</h1>' . $html . '' );


$dompdf->setPaper( 'A4', 'landscape' );

//Renderizar o html
$dompdf->render();


//Exibibir a página
$dompdf->stream(
    "relatorio.pdf",
    array(
        "Attachment" => false //Para realizar o download somente alterar para true
    )
);
?>
