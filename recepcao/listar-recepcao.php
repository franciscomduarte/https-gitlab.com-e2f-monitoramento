<?php 
require_once 'conexao/conn.php';

$evento_id = $_REQUEST['id'];

$sql = "select e.descricao, e.data_fim, e.data_inicio, e.nome, l.nome as local
		from evento e, local l
		where l.id = e.local_id
		and e.id = '".$evento_id."'";

$rs = mysqli_query($conexao, $sql);

while ($linha = mysqli_fetch_array($rs)) {
		
	$data_inicio  = $linha['data_inicio'];
	$data_fim     = $linha['data_fim'];
	$nome         = $linha['nome'];
	$descricao    = $linha['descricao'];
	$local  	  = $linha['local'];
		
}

?>
<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div>
			<fieldset legend="Pesquisar">
				<form method="post" action="index.php?pg=21" name="formulario" id="formulario_busca">
					<input type="hidden" name="tipo" id="tipo">
					<div class="row">
						<!-- /.col-lg-6 -->
						<div class="panel panel-default col-lg-12">
						<div class="panel-heading"><b>Evento:</b> <?php echo $nome.'-'.$local ?>-<?php echo $descricao ?></div>
						  <div class="panel-body">
								<span class="label label-default" style="cursor: pointer" onclick="javascript:chamaPesquisa(2);">Convidado</span>
								<span class="label label-info"  style="cursor: pointer" onclick="javascript:chamaPesquisa(3);">Pre-nominata</span>
								<span class="label label-primary"  style="cursor: pointer" onclick="javascript:chamaPesquisa(4);">Nominata</span>
								<span class="label label-warning"  style="cursor: pointer" onclick="javascript:chamaPesquisa(1);">Todos</span>
							<div class="input-group" style="padding-top: 5px">
								<input type="text" class="form-control input-lg" name="busca" value="<?php echo isset($_POST['busca']) ? $_POST['busca'] : "" ?>" 
									   placeholder="Digite sua pesquisa..."> 
								<span
									class="input-group-btn" >
									<button class="btn btn-default btn-lg" type="submit">Procurar</button>
									<input type="hidden" name="id" value="<?php echo $evento_id?>">
								</span>
							</div>
							<!-- /input-group -->
						  </div>
						</div>						
						
						
						<!-- /.col-lg-6 -->
					</div>
					<!-- /.row -->
				</form>

			</fieldset>


		</div>
	</div>
</div>
<div class="row row-offcanvas row-offcanvas-right">

	<div class="row">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th width="12%" colspan="2">Foto</th>
						<th width="60%">Nome</th>
						<th width="15%">Data</th>
						<th>Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php
					
					$sql = "select p.id, p.nome as nome_pessoa, p.foto, p.ordem, p.email, p.telefone_1, p.telefone_2,
								date_format(data_criacao,'%d/%m/%Y %T') as data_cadastro_formatada,
								p.posto_graduacao_id, 
								f.nome as nome_funcao, pp.nome as nome_poder,
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
								where p.funcao_id = f.id
								and pp.id = f.poder_id 
								and p.id in (select pessoa_id from convidado where evento_id = '".$evento_id."') ";
					
					if (isset($_REQUEST['busca']))
						$sql .= "and p.nome like '%".$_REQUEST['busca']."%' ";
					if(isset($_REQUEST['tipo'])){
					if ($_REQUEST['tipo'] == 2)
						$sql .= "and (select count(*) from convidado c where c.pessoa_id = p.id and c.evento_id='".$evento_id."') > 0 ";
					elseif($_REQUEST['tipo'] == 3)
						$sql .= "and (select count(*) from convidado c where c.pessoa_id = p.id and c.pre_nominata = 1 and c.evento_id='".$evento_id."') > 0 ";
					elseif($_REQUEST['tipo'] == 4){
						$sql .= "and (select count(*) from convidado c where c.pessoa_id = p.id and c.nominata = 1 and c.evento_id='".$evento_id."') > 0 ";
					}
					}
					
					$sql.= "order by CAST(p.ordem as SIGNED)";
					#echo $sql;
					$rs = mysqli_query($conexao, $sql);
					$num = 0;
			
					while ($linha = mysqli_fetch_array($rs)) {
			                        $num++;
			                        
			                        $id_pessoa = $linha['id'];
			                        $sqlConvidado = "select c.id, 
			                        				date_format(c.data_hora_chegada,'%d/%m/%Y %T') as data_hora_chegada 
			                        				from convidado c 
			                        				where pessoa_id = '$id_pessoa' 
			                        				and evento_id = '$evento_id'";
			                        $rsConvidado  = mysqli_query($conexao, $sqlConvidado);
			                        $linha_convidado = mysqli_fetch_array($rsConvidado);
			                        $data_convidado = $linha_convidado['data_hora_chegada'];
			                        
			                        ?>
					<tr <?php echo $data_convidado ? " style='background:#D8F1DA'" : ""?>>
						<td><?php echo $num ?></td>
						<td>
							<?php 
								if ($linha['foto']){
									$arrayFoto 	  = explode(".",$linha['foto']);
									$foto_pequena = $arrayFoto[0]."_tumb".".".$arrayFoto[1];
									echo "<img src='fotos/".$foto_pequena."' width='40' height='40'>";
								}else{
									echo "<img src='img/icone_perfil.fw.png' width='40' height='40'>";	
								}
			
							?>
						</td>
						<td>
							<?php 
								if ($linha['total_nominata'] > 0)
									echo "<span class='glyphicon glyphicon-th-list' title='Presente na Nominata'></span>";
								elseif ($linha['total_prenominata'] > 0)
									echo "<span class='glyphicon glyphicon-list-alt' title='Presente na Pr&eacute; Nominata'></span>";
								else
									echo "&nbsp;";
							?>
						
						</td>
						<td><?php 
								if ($linha['posto_graduacao_id']){
									$sqlPosto = "select * from posto_graduacao where id = ".$linha['posto_graduacao_id'];
									$rsPosto  = mysqli_query($conexao, $sqlPosto);
									if($linha_posto = mysqli_fetch_array($rsPosto)){
										echo "<i><b>".$linha_posto['nome']."&nbsp;</b></i>";
									}
								}
								echo $linha['nome_pessoa']."<br />(".$linha['nome_funcao'].")"; 
							?>
						</td>
						<td>
							<?php echo $data_convidado ?>
						</td>
						<td>
							<?php 
								  if (!$data_convidado) {?>
							<button class="btn btn-success btn-lg" onclick="location.href='recepcao/gravar-recepcao.php?acao=confirmar&id=<?php echo $linha['id']?>&evento_id=<?php echo $evento_id ?>'">Confirmar</button>
							<?php } else { ?>
									<button class="btn btn-danger btn-lg" onclick="location.href='recepcao/gravar-recepcao.php?acao=desconfirmar&id=<?php echo $linha['id']?>&evento_id=<?php echo $evento_id ?>'">Desconfirmar</button>
							<?php } ?>
						</td>
			
					</tr>
			
					<?php
			           }
			        ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<?php echo mysqli_num_rows($rs)?> Registros encontrados
	<div class="col-md-12 text-center">
		<ul class="pagination" id="myPager"></ul>
	</div>
</div>
<script src="js/paginacao.js"></script>
<script>
	function excluir(id){
		var pag = "pessoa/gravar-pessoa.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir esta pessoa?")){
			location.href = pag;
		}
	}

	function chamaPesquisa(tipo){
		document.getElementById('tipo').value = tipo;
		
		$('#formulario_busca').submit();
		//formulario.submit();
	}
	
	$(document).ready(function(){
	    		
	  $('#myTable').pageMe(
	    {
		  pagerSelector:'#myPager',
		  showPrevNext:true,
		  hidePageNumbers:false,
		  perPage:10,
		  totalPages:5
		 }); 
	  
	  });
</script>

