
<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">
		
			<button type="button" class="btn btn-info" onclick="location.href='index.php?pg=11'">
				Nova Pessoa
			</button>
		
		
			<table class="table table-hover" id="example">
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
					require_once 'conexao/conn.php';
				
					$sql = "select p.id, p.nome as nome_pessoa, p.foto, p.ordem, p.email, p.telefone_1, p.telefone_2,
								date_format(data_criacao,'%d/%m/%Y %T') as data_cadastro_formatada,
								p.funcao_id, 
								f.nome as nome_funcao, pp.nome as nome_poder
								from pessoa p, funcao f, poder pp
								where 1 = 1
			                          and p.funcao_id = f.id
								      and pp.id = f.poder_id 
									  and p.ativo = '1' ";
			
					$sql.= "order by CAST(p.ordem as SIGNED)";
					
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
						<td><?php echo $linha['data_cadastro_formatada']?></td>
						<td><?php echo $linha['email'] ?></td>
						<td><?php 
								echo $linha['telefone_1'];
								if ($linha['telefone_2'])
									echo  "<br/>".$linha['telefone_2'];
							?>
						</td>
						
						<td>
							<button onclick="location.href='index.php?pg=11&acao=a&id=<?php echo $linha['id']?>'">
								<span class="glyphicon glyphicon-edit" title="Editar"></span>
							</button>
							
							<button onclick="excluir(<?php echo $linha['id']?>)">
								<span class="glyphicon glyphicon-trash" title="Excluir"></span>
							</button>
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
		var pag = "pessoa/gravar-pessoa.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir esta pessoa?")){
			location.href = pag;
		}
	}
</script>

