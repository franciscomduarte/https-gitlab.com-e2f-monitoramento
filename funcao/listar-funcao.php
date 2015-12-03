
<div class="row row-offcanvas row-offcanvas-right">
	<div class="row">
		<div class="table-responsive">
			<button type="button" class="btn btn-info" style="margin-left: 10px" onclick="location.href='index.php?pg=4'">
				Nova Função
			</button>
			
			<button type="button" class="btn btn-info" onclick="chamaRelatorio();">
				PDF
			</button>
			
			<a href="#" class="btn btn-info" onclick="$('#example').tableExport({type:'csv',escape:'false'});">CSV</a>
			
				<table class="table table-hover" id="example">
					<thead>
						<tr>
							<th>Ordem</th>
							<th>Nome</th>
							<th>Poder</th>
							<th>Op&ccedil;&otilde;es</th>
						</tr>
					</thead>
					<tbody id="myTable">
						<?php 
	
						require_once 'conexao/conn.php';
	                    
						$sql = "select f.id, f.ordem, f.nome, p.nome as nome_poder
								from funcao f, poder p
								where 1=1 
									  and f.ativo = 1 
									  and f.poder_id = p.id
								order by ordem";
						$rs = mysqli_query($conexao, $sql);
						$num = 0;
	
						while ($linha = mysqli_fetch_array($rs)) {
				           	 $num++;
				           	 ?>
						<tr>
							<td><?php echo $linha['ordem']?></td>
							<td><?php echo $linha['nome']?></td>
							<td><?php echo $linha['nome_poder']?></td>
							<td>
								<button onclick="location.href='index.php?pg=4&acao=a&id=<?php echo $linha['id']?>'">
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
		var pag = "funcao/gravar-funcao.php?acao=e&id="+id;
		if (confirm("Tem certeza que deseja excluir esta função?")){
			location.href = pag;
		}
	}
	function chamaRelatorio(){
		pagina = '/scc_cerimonial/relatorios/encaminha.php';
		window.open(pagina,'_blank');
	}
</script>

