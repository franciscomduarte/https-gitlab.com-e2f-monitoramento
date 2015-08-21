<?php 
require_once 'conexao/conn.php';
session_start();
if ($_SESSION['evento'] != $_REQUEST['id'])
	$_SESSION['evento'] = $_REQUEST['id'];

#Pegar dados do Evento e colocar em cima da lista

?>
<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<fieldset legend="Pesquisar">
				<form method="post" action="index.php?pg=10" name="formulario" id="formulario_busca">
					<div class="row">
						<div class="col-lg-6">

							<span class="input-group-btn">
								Dados do Evento: <?php echo $_SESSION['evento']?>
							</span>

						</div>
						<!-- /.col-lg-6 -->
						<div class="col-lg-6">
							<div class="input-group">
								<input type="text" class="form-control" name="busca" value="<?php echo $_POST['busca']?>" 
									   onkeypress="javascript:chamaPesquisa();" placeholder="Digite sua pesquisa..."> 
								<span
									class="input-group-btn" >
									<button class="btn btn-default" type="button">Procurar</button>
								</span>
							</div>
							<!-- /input-group -->
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
						<th>Foto</th>
						<th>Ordem</th>
						<th>Nome</th>
						<th>Inclus&atilde;o</th>
						<th>E-mail</th>
						<th>Telefone(s)</th>
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
								 where c.evento_id='".$_SESSION['evento']."'
								 and c.pessoa_id = p.id) as total,
								(select count(*) from convidado c 
								 where c.evento_id='".$_SESSION['evento']."'
								 and c.pessoa_id = p.id and c.nominata is true) as total_nominata,
								(select count(*) from convidado c 
								 where c.evento_id='".$_SESSION['evento']."'
								 and c.pessoa_id = p.id and c.pre_nominata is true) as total_prenominata	
								from pessoa p, funcao f, poder pp
								where p.funcao_id = f.id
								and pp.id = f.poder_id ";
			
					if ($_REQUEST['busca'])
						$sql .= "and p.nome like '%".$_REQUEST['busca']."%' ";
					
					$sql.= "order by p.ordem";
					
					$rs = mysqli_query($conexao, $sql);
					$num = 0;
			
					while ($linha = mysqli_fetch_array($rs)) {
			                        $num++;
			                        ?>
					<tr>
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
						<td><?php echo $linha['ordem'] ?></td>
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
						<td><?php echo $linha['data_cadastro_formatada']?></td>
						<td><?php echo $linha['email'] ?></td>
						<td><?php 
								echo $linha['telefone_1'];
								if ($linha['telefone_2'])
									echo  "<br/>".$linha['telefone_2'];
							?>
						</td>
						
						<td>
							<button class="btn btn-default" onclick="location.href='convidado/gravar-convidado.php?acao=convidar&id=<?php echo $linha['id']?>'" <?php echo $linha['total'] > 0 ? "disabled":""?>>Convidar</button>
							<button class="btn btn-info" onclick="location.href='convidado/gravar-convidado.php?acao=prenominata&id=<?php echo $linha['id']?>'" <?php echo $linha['total_nominata'] > 0 ? "disabled":""?>>Pre-Nominata</button>
							<button class="btn btn-primary" onclick="location.href='convidado/gravar-convidado.php?acao=nominata&id=<?php echo $linha['id']?>'" <?php echo $linha['total_prenominata'] > 0 ? "disabled":""?>>Nominata</button>
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

	function chamaPesquisa(){
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

