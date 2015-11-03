<?php
/* Carrega a classe DOMPdf */
//setando para 5 minutos
set_time_limit(300);
require_once("../libs/dompdf/dompdf_config.inc.php");
include '../conexao/conn.php';

session_start();

$sql = "select f.id, f.ordem, f.nome, p.nome as nome_poder
								from funcao f, poder p
								where f.poder_id = p.id
								order by ordem";
$rs = mysqli_query($conexao, $sql);

$linhas = "";
while ($linha = mysqli_fetch_array($rs)) {
	$linhas .=
	"<tr>
		<td>".$linha['ordem']."</td>
		<td>".$linha['nome']."</td>
		<td>".$linha['nome_poder']."</td>
	</tr>";
}
	

$html = "
<div class='row row-offcanvas row-offcanvas-right'>
	<div class='row'>
		<div class='table-responsive'>
				<table class='table table-hover' id='example'>
					<thead>
						<tr>
							<th>Ordem</th>
							<th>Nome</th>
							<th>Poder</th>
						</tr>
					</thead>
					<tbody id='myTable'>".$linhas."
					</tbody>
				</table>
		</div>
	</div>
</div>";

/* Cria a instância */
$dompdf = new DOMPDF();

/* Carrega seu HTML */
$dompdf->load_html($html);

/* Renderiza */
$dompdf->render();

/* Exibe */
$dompdf->stream(
    "saida.pdf", /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);
?>