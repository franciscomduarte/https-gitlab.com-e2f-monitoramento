<?php
/* Carrega a classe DOMPdf */
//setando para 5 minutos
set_time_limit(300);

require_once("../libs/dompdf/dompdf_config.inc.php");
include '../conexao/conn.php';

session_start();

$evento_id = $_REQUEST['id'];
$sqlCabecalho = "select e.descricao, e.data_fim, e.data_inicio, e.nome, l.nome as local
		from evento e, local l
		where l.id = e.local_id
		and e.id = '".$evento_id."'";

$rsCabecalho = mysqli_query($conexao, $sqlCabecalho);

while ($linhaCab = mysqli_fetch_array($rsCabecalho)) {
	$data_inicio  = $linhaCab['data_inicio'];
	$data_fim     = $linhaCab['data_fim'];
	$nome         = $linhaCab['nome'];
	$descricao    = $linhaCab['descricao'];
	$local  	  = $linhaCab['local'];
}

$cabecalho = 
	"<div class='panel-heading'><b>Evento:".$nome."</b></div>
	  <div class='panel-body'>
	  	Local:".$local."<br>
	 	Descri&ccedil;&atilde;o:".$descricao."<br>
	    Data Inicio:".$data_inicio."<br>
	    Data Fim:".$data_fim."
	  </div>
	</div>	";



$sql = "select p.id, p.nome as nome_pessoa, p.foto, p.ordem, p.email, p.telefone_1, p.telefone_2,
			date_format(data_criacao,'%d/%m/%Y %T') as data_cadastro_formatada,
			p.funcao_id,
			f.nome as nome_funcao, pp.nome as poder,
			(select count(*) from convidado c 
			 where c.evento_id='".$evento_id."'
			 and c.pessoa_id = p.id) as total,
			(select count(*) from convidado c 
			 where c.evento_id='".$evento_id."'
			 and c.pessoa_id = p.id and c.nominata = 1) as total_nominata,
			(select count(*) from convidado c 
			 where c.evento_id='".$evento_id."'
			 and c.pessoa_id = p.id and c.pre_nominata = 1) as total_prenominata	
		from pessoa p, funcao f, poder pp
		where p.ativo = '1' 
	        and p.funcao_id = f.id
			and pp.id = f.poder_id 
 		order by CAST(p.ordem as SIGNED)";

$rs = mysqli_query($conexao, $sql);

$linhas = "";
while ($linha = mysqli_fetch_array($rs)) {
	
	$foto = "<img src='../img/icone_perfil.fw.png' width='40' height='40'>";
	if($linha['foto']){
		$arrayFoto 	  = explode(".",$linha['foto']);
		$foto_pequena = $arrayFoto[0]."_tumb".".".$arrayFoto[1];
		$foto = "<img src='../fotos/".$foto_pequena."' width='40' height='40'>";
	}
	

	$linhas .="
	<tr>
	<td>".$foto."</td>
	<td>".$linha['ordem']."</td>
	<td>".$linha['nome_pessoa']."-".$linha['nome_funcao']."</td>
	<td>".$linha['poder']."</td>
	<td>".$linha['email']."</td>
	<td>".$linha['telefone_1']."</td>
</tr>";
}
	
$html = $cabecalho;

$html .= "
<div class='row row-offcanvas row-offcanvas-right'>
	<div class='row'>
		<div class='table-responsive'>
				<table class='table table-hover' id='example'>
					<thead>
						<tr>
							<th>Foto</th>
							<th>Ordem</th>
							<th>Nome</th>
							<th>Poder</th>
							<th>Email</th>
							<th>Telefone</th>
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