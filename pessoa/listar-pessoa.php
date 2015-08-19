<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">

			<button type="button" class="btn btn-default btn-lg" onclick="location.href='index.php?pg=11'">
				Novo
			</button>

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
					require_once 'conexao/conn.php';
				
					$sql = "select p.id, p.nome as nome_pessoa, p.foto, p.ordem, p.email, p.telefone_1, p.telefone_2,
								date_format(data_criacao,'%d/%m/%Y %T') as data_cadastro_formatada,
								f.nome as nome_funcao, pp.nome as nome_poder
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
									echo "<img src='fotos/".$linha['foto']."' width='40' height='40'>";
								}else{
									echo "<img src='img/icone_perfil.fw.png' width='40' height='40'>";	
								}
			
							?>
						</td>
						<td><?php echo $linha['ordem'] ?></td>
						<td><?php 
								
								
								echo $linha['nome_pessoa'] 
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
							<button onclick="excluir(<?php echo $linha['id']?>)">Excluir</button>
							<button onclick="location.href='index.php?pg=11&acao=a&id=<?php echo $linha['id']?>'">Alterar</button>
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

<div class="col-md-12 text-center">
	<ul class="pagination" id="myPager"></ul>
</div>
<script src="js/paginacao.js"></script>
<script>
	function excluir(id){
		var pag = "pessoa/gravar-pessoa.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir esta pessoa?")){
			location.href = pag;
		}
	}

	$(document).ready(function(){
	    		
	  $('#myTable').pageMe(
	    {
		  pagerSelector:'#myPager',
		  showPrevNext:true,
		  hidePageNumbers:false,
		  perPage:5,
		  totalPages:5
		 }); 
	  
	  });
</script>

