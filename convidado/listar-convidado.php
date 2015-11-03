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
				<form method="post" action="index.php?pg=16" name="formulario" id="formulario_busca">
					<input type="hidden" name="tipo" id="tipo">
					<div class="row">
						<!-- /.col-lg-6 -->
						<div class="panel panel-default col-lg-6">
						<div class="panel-heading"><b>Evento: <?php echo $nome ?></b></div>
						  <div class="panel-body">
						  	Local: <?php echo $local ?><br>
						 	Descri&ccedil;&atilde;o: <?php echo $descricao ?><br>
						    Data Inicio: <?php echo $data_inicio ?><br>
						    Data Fim: <?php echo $data_fim ?>
						  </div>
						</div>						
						
						<div class="col-lg-6">
								<span class="label label-default" style="cursor: pointer" onclick="javascript:chamaPesquisa(5);">Não Convidado</span>
								<span class="label label-default" style="cursor: pointer" onclick="javascript:chamaPesquisa(2);">Convidado</span>
								<span class="label label-info"  style="cursor: pointer" onclick="javascript:chamaPesquisa(3);">Pre-nominata</span>
								<span class="label label-primary"  style="cursor: pointer" onclick="javascript:chamaPesquisa(4);">Nominata</span>
								<span class="label label-warning"  style="cursor: pointer" onclick="javascript:chamaPesquisa(1);">Todos</span>
							<!-- /input-group -->
							<input type="hidden" name="id" value="<?php echo $evento_id?>">
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

			<button type="button" class="btn btn-info" onclick="teste()">
				Inserir selecionados
			</button>

			<button type="button" class="btn btn-info" onclick="$('#example').tableExport({type:'csv',escape:'false'});">
				Exportar para excel
			</button>
			
			<div class="input-group" style="margin: 5px">
							<div class="input-group">
                               <span class="input-group-addon">Poder:</span>
                               <select id="poderSelecionado" class="form-control" style="width:400px">
                                  	<option value=''>-- Escolha um poder --</option>
                                  	<?php 
                                  		$sqlPoder = "select * from poder order by id";
                                  		$rsPoder = mysqli_query($conexao, $sqlPoder);
                                  		while($linha=mysqli_fetch_array($rsPoder)){
											echo "<option value='".$linha['nome']."'>".$linha['nome']."</option>";
                                  		}	
                                  	?>
                                </select>
                            </div>
				</div>
			
	<div class="row">
		<div class="table-responsive">
			<table class="table table-hover" id="example">
				<thead>
					<tr>
						<th width="10%">Foto</th>
						<th width="10%">Ordem</th>
						<th width="20%">Nome</th>
						<th width="10%">Poder</th>
						<th width="10%">E-mail</th>
						<th width="10%">Telefone(s)</th>
						<th width="35%">Op&ccedil;&otilde;es</th>
					</tr>
				</thead>
				<tbody id="myTable">
					<?php
					
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
								and pp.id = f.poder_id ";
					
					if (isset($_REQUEST['busca']))
						$sql .= "and p.nome like '%".$_REQUEST['busca']."%' ";
					if(isset($_REQUEST['tipo'])){
						if ($_REQUEST['tipo'] == 2) {
							$sql .= "and (select count(*) from convidado c where c.pessoa_id = p.id and c.evento_id='".$evento_id."') > 0 ";
						}
						elseif($_REQUEST['tipo'] == 3) {
							$sql .= "and (select count(*) from convidado c where c.pessoa_id = p.id and c.pre_nominata = 1 and c.evento_id='".$evento_id."') > 0 ";
						}
						elseif($_REQUEST['tipo'] == 4) {
							$sql .= "and (select count(*) from convidado c where c.pessoa_id = p.id and c.nominata = 1 and c.evento_id='".$evento_id."') > 0 ";
						}
						elseif($_REQUEST['tipo'] == 5) {
							$sql .= " and p.id not in (select pessoa_id from convidado c where c.pessoa_id = p.id and c.evento_id='".$evento_id."') > 0 ";
						}
					}
					
					$sql.= "order by CAST(p.ordem as SIGNED)";
					#echo $sql;
					$rs = mysqli_query($conexao, $sql);
					$num = 0;
			
					while ($linha = mysqli_fetch_array($rs)) {
			                        $num++;
			                        ?>
					<tr>
						<td align="center">
						<input type="checkbox" id="<?php echo $linha['id']?>" <?php echo $linha['total'] > 0 ? "disabled":""?>>
						<span style="padding-right: 5px"></span>
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
								if ($linha['funcao_id']){
									$sqlFuncao = "select * from funcao where id = ".$linha['funcao_id'];
									$rsFuncao  = mysqli_query($conexao, $sqlFuncao);
									if($linha_funcao = mysqli_fetch_array($rsFuncao)){
										echo "<i><b>".$linha_funcao['nome']."&nbsp;</b></i>";
									}
								}
								echo $linha['nome_pessoa']."<br />(".$linha['nome_funcao'].")"; 
							?>
						</td>
						<td><?php 
								echo $linha['poder']; 
							?>
						</td>
						<td><?php echo $linha['email'] ?></td>
						<td><?php 
								echo $linha['telefone_1'];
								if ($linha['telefone_2'])
									echo  "<br/>".$linha['telefone_2'];
							?>
						</td>
						
						<td>
							<button class="btn btn-default btn-sm" onclick="location.href='convidado/gravar-convidado.php?acao=convidar&id=<?php echo $linha['id']?>&evento_id=<?php echo $evento_id ?>'" <?php echo $linha['total'] > 0 ? "disabled":""?>>Convidar</button>
							<button class="btn btn-info btn-sm" onclick="location.href='convidado/gravar-convidado.php?acao=prenominata&id=<?php echo $linha['id']?>&evento_id=<?php echo $evento_id ?>'" <?php echo $linha['total_prenominata'] > 0 ? "disabled":""?>>Pre-Nominata</button>
							<button class="btn btn-primary btn-sm" onclick="location.href='convidado/gravar-convidado.php?acao=nominata&id=<?php echo $linha['id']?>&evento_id=<?php echo  $evento_id ?>'" <?php echo $linha['total_nominata'] > 0 ? "disabled":""?>>Nominata</button>
							<button class="btn btn-danger btn-sm" onclick="location.href='convidado/gravar-convidado.php?acao=remover&id=<?php echo $linha['id']?>&evento_id=<?php echo  $evento_id ?>'" <?php 
									if (($linha['total_nominata']+$linha['total_prenominata']+$linha['total']<=0)) echo "disabled"?>>Remover</button>
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

<script>
	function excluir(id){
		var pag = "pessoa/gravar-convidado.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir esta pessoa?")){
			location.href = pag;
		}
	}

	function teste() {
		var data = new Array();
		$(':checkbox').each(function( index ) {
			if( $( this ).is(":checked")) {
				var id = $( this ).attr('id');
				data[index] = id;
			}
			//console.log( index + ": " + $( this ).is(":checked") );
		});
		var pag = "convidado/gravar-convidado.php?acao=e&id="+data.join(",")+"&evento_id="+<?php echo $evento_id ?>+"&acao=convidarVarios";
		location.href = pag;
	}

	function chamaPesquisa(tipo){
		document.getElementById('tipo').value = tipo;
		$('#formulario_busca').submit();
		//formulario.submit();
	}
</script>

