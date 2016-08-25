<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">
		
			<button type="button" style="margin-left: 5px" class="btn btn-info" onclick="location.href='index.php?pg=11'">
				Nova Pessoa
			</button>
			
			<form name="form_pesquisa" method="post" action="index.php?pg=10">
				<div id="example_filter" class="dataTables_filter" align="right">
					<label>Pesquisar <input type="search" class="" value="<?php echo $_REQUEST['nome']?>" name="nome" id="nome" placeholder="Digite algo para pesquisar"></label>
					<button type="submit" style="margin-left: 5px" class="btn btn-info">OK</button>
				</div>
			</form>
			
			<table class="table table-hover" id="example1">
				<thead>
					<tr>
						<th>#</th>
						<th>Foto</th>
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
					
					$tamanho_pagina = 30;
					$nome   = $_REQUEST['nome'];
					$pagina = $_REQUEST['pagina'];
					
					if (!$pagina)
						$pagina = 1;

					$offset = $tamanho_pagina * ($pagina-1);
					
					
					$sqlTotal = "select count(*)
								from pessoa p, funcao f, poder pp, vocativo v
								where p.funcao_id = f.id
								      and pp.id = f.poder_id
									  and p.vocativo_id = v.id
									  and p.ativo = '1' ";
					
					$sql = "select p.id, p.nome as nome_pessoa, p.foto, p.ordem, p.email, p.telefone_1, p.telefone_2, p.cargo,
								date_format(data_criacao,'%d/%m/%Y %T') as data_cadastro_formatada,
								p.funcao_id, 
								f.nome as nome_funcao, pp.nome as nome_poder, v.descricao as vocativo
								from pessoa p, funcao f, poder pp, vocativo v
								where p.funcao_id = f.id
								      and pp.id = f.poder_id 
									  and p.vocativo_id = v.id
									  and p.ativo = '1' ";
					$order = "order by CAST(p.ordem as SIGNED) ";
					
					if ($nome){
						$sql 	  .= "and p.nome like '%$nome%' ";
						$sqlTotal .= "and p.nome like '%$nome%' ";
					}
					#echo $sqlTotal;
					$rsTotal  = mysqli_query($conexao,$sqlTotal);
					if($linhaTotal = mysqli_fetch_array($rsTotal)){
						$total = $linhaTotal[0];
					}
					
					$total_de_paginas = (int)($total / $tamanho_pagina);
					
					if (($tota_de_paginas*$tamanho_pagina)<$total)
						$total_de_paginas++; 
					
					#Montando o corpo da paginacao
					$corpo_pagina = "<div align='center'> Páginas ";
					for ($x=1;$x<=$total_de_paginas;$x++){
						if ($pagina==$x)
							$nome_pagina = "<b style='background-color:#c9efc6'>$x</b>";
						else 
							$nome_pagina = "$x";
						$corpo_pagina .= " <a href='index.php?pg=10&pagina=$x&nome=$nome'>$nome_pagina</a> |";
					}
					$corpo_pagina .= " $total Registro(s) encontrado(s)</div>";
					
					echo $corpo_pagina;
					
					$limit = " LIMIT $tamanho_pagina OFFSET $offset ";
				
					$sql .= $order . $limit;
					
					$rs = mysqli_query($conexao, $sql);
					
					$num = $offset;
					#echo $sql;
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
						<td><?php 
								if ($linha['funcao_id']){
									$sqlFuncao = "select * from funcao where id = ".$linha['funcao_id'];
									$rsFuncao  = mysqli_query($conexao, $sqlFuncao);
									if($linha_funcao = mysqli_fetch_array($rsFuncao)){
										echo "<i><b>".$linha_funcao['nome']."&nbsp;</b></i>";
									}
								}
								if ($linha['cargo']) {
									echo $linha['vocativo']." ".$linha['nome_pessoa']."<br />(".$linha['cargo'].")"; 
								} else {
									echo $linha['vocativo']." ".$linha['nome_pessoa'];
								}
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
		<?php echo $corpo_pagina;?>
	</div>
</div>

<script>
	function pesquisar(){
		var nome = $('#nome').val();
		location.href="index.php?pg=10&pagina=0&nome="+nome;
	}
	function excluir(id){
		var pag = "pessoa/gravar-pessoa.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir esta pessoa?")){
			location.href = pag;
		}
	}
</script>

